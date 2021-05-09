<?php


namespace mmerlijn\bladeComponents\Console;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;


class InstallCommand extends \Illuminate\Console\Command
{

    protected $signature = "blade-components:install";

    protected $description="Install blade-components resources";

    public function handle()
    {
        $this->callSilent('vendor:publish',['--tag'=>'blade-components-js','--force'=>true]);
        $this->callSilent('vendor:publish',['--tag'=>'blade-components-config','--force'=>true]);

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return ['alpinejs' => '^2.7.3',
                    'postcss-import' => '^14.0.1',
                    'tailwindcss' => '^2.0.1',
                ] + $packages;
        });

        if (! Str::contains(file_get_contents(resource_path('js/app.php')), "'blade-components/flash'")) {
            (new Filesystem)->append(resource_path('js/app.js'), PHP_EOL."require('blade-components/flash');");
        }
        $this->comment('Please execute "npm install && npm run dev" to build your assets.');
    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
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
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
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
     * @param  string  $search
     * @param  string  $replace
     * @param  string  $path
     * @return void
     */
    protected function replaceInFile($search, $replace, $path)
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}