<?php


namespace mmerlijn\bladeComponents\Console;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;


class InstallCommand extends \Illuminate\Console\Command
{

    protected $signature = "blade-components:install {--renew=?: replace all existing files}
    {--composer=global : Absolute path to the Composer binary which should be used to install packages}";

    protected $description = "Install blade-components resources";

    public function handle()
    {
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

        $this->info('Add flash.js to app.js');
        if (!Str::contains(file_get_contents(resource_path('js/app.js')), "'./blade-components/flash'")) {
            (new Filesystem)->append(resource_path('js/app.js'), PHP_EOL . "require('./blade-components/flash');");
        }

        $this->info('Add or update tailwind.config.js');
        if (!file_exists(base_path("/tailwind.config.js")) or $this->option("renew")) {
            copy(__DIR__ . '/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
        } else {
            //add blade components to purge
            $this->replaceInFile("'./resources/views/**/*.blade.php',", "'./resources/views/**/*.blade.php'," . PHP_EOL . "'./vendor/mmerlijn/blade-components/**/*.blade.php',", $path);
        }
        $this->info('Add if not exists webpack.mix.js');
        if (!file_exists(base_path("/webpack.mix.js")) or $this->option('renew')) {
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