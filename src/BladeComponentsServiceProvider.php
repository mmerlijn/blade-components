<?php
namespace mmerlijn\bladeComponents;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;

class BladeComponentsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-components.php', 'blade-components');
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bladeComponents');
//       $this->loadViewComponentsAs(config('blade-components.prefix'), [
//           \mmerlijn\bladeComponents\View\Components\Badge::class
//           //   Alert::class,
//           //   Button::class,
//       ]);

        $this->configurePublishing();
        $this->configureComponents();
        $this->configureCommands();
        //Blade::component(\mmerlijn\bladeComponents\View\Components\Badge::class,'badge',config('blade-components.prefix'));
    }

    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            foreach (scandir(__DIR__."/../resources/views/components") as $file) {
                if (!in_array($file, [".", ".."])) {
                    $this->registerComponent(Str::before($file,"."));
                }
            }
        });
    }
    protected function registerComponent(string $component)
    {
        Blade::component('bladeComponents::components.'.$component, config('blade-components.prefix').'-'.$component);
    }

    protected function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/blade-components.php' => config_path('blade-components.php'),
        ], 'blade-components-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/blade-components'),
        ], 'blade-components-views');

        $this->publishes([__DIR__.'/../resources/js' => resource_path('js/blade-components')],'blade-components-js');

    }
    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }
}