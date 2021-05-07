<?php
namespace mmerlijn\bladeComponents;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
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
        Blade::component(\mmerlijn\bladeComponents\View\Components\Badge::class,'badge',config('blade-components.prefix'));
        Blade::component(\mmerlijn\bladeComponents\View\Components\Panel::class,'panel',config('blade-components.prefix'));
    }

    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function (BladeCompiler $blade) {
            //$this->registerComponent('panel');
            $this->registerComponent('button');
            $this->registerComponent('flash');
            $this->registerComponent('modal');
            $this->registerComponent('alert-danger');
            $this->registerComponent('alert-notice');
            $this->registerComponent('alert-success');
            $this->registerComponent('alert-warning');
            $this->registerComponent('input');
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

    }
}