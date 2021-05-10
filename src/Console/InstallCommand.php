<?php


namespace mmerlijn\bladeComponents\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;


class InstallCommand extends \Illuminate\Console\Command
{

    protected $signature = "blade-components:install {--renew}
    {--composer=global : Absolute path to the Composer binary which should be used to install packages}";

    protected $description = "Install blade-components resources";

    public function handle()
    {
        $this->info("renew option is: ".$this->option("renew"));
        $this->info('Installing Blade-components package...');

        $this->info('Publishing javascripts and configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'blade-components-js', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'blade-components-config', '--force' => true]);


        $this->info('Update node package.json');
        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return ['@tailwindcss/forms' => '^0.3.1',
                    '@tailwindcss/typography' => '^0.4.0',
                    'alpinejs' => '^2.7.3',
                    'postcss-import' => '^14.0.1',
                    'tailwindcss' => '^2.0.1',
                ] + $packages;
        });

        if (!Str::contains(file_get_contents(resource_path('js/app.js')), "require('alpinejs');")) {
            $this->info('Add alpinejs to app.js');
            (new Filesystem)->append(resource_path('js/app.js'), PHP_EOL . "require('alpinejs');");
        }
        if (!Str::contains(file_get_contents(resource_path('js/app.js')), "'./blade-components/flash'")) {
            $this->info('Add flash.js to app.js');
            (new Filesystem)->append(resource_path('js/app.js'), PHP_EOL . "require('./blade-components/flash');");
        }

        if(is_dir(resource_path('view/layouts/'))){
            foreach (scandir(resource_path('view/layouts')) as $layout){
                if($layout!="." or $layout!=".."){
                    if (!Str::contains(file_get_contents(resource_path('view/layouts/'.$layout)), "<x-bc-flash")) {
                        $this->info('Add flash components to layout: '.$layout);
                        $this->replaceInFile("</body>", "<x-bc-flash/>" . PHP_EOL . "</body>", resource_path('view/layouts/'.$layout));
                    }
                }
            }
        }else{
            $this->info('No layout directory found: add manually <x-bc-flash/> just before </body>');
        }


        if (!file_exists(base_path("/tailwind.config.js")) or $this->option("renew")) {
            $this->info('Add tailwind.config.js');
            copy(__DIR__ . '/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        } else {
            $this->info('Update tailwind.config.js');
            $this->replaceInFile("'./resources/views/**/*.blade.php',", "'./resources/views/**/*.blade.php'," . PHP_EOL . "'./vendor/mmerlijn/blade-components/**/*.blade.php',", base_path('tailwind.config.js'));
        }

        if (!file_exists(base_path("/webpack.mix.js")) or $this->option('renew') ) {
            $this->info('Add if not exists webpack.mix.js');
            copy(__DIR__ . '/../../stubs/webpack.mix.js', base_path('webpack.mix.js'));
        }

        $this->comment('Installation completed');
        $this->comment('Please execute "npm install && npm run dev" to build your assets.');
    }

    /**
     * Update the "package.json" file.
     *
     * @param callable $callback
     * @param bool $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (!file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     *
     * @param string $search
     * @param string $replace
     * @param string $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}