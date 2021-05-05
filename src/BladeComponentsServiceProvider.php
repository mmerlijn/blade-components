<?php
namespace mmerlijn\bladeComponents;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class BladeComponentsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'bladeComponents');
        $this->loadViewComponentsAs('mm', [

            //   Alert::class,
            //   Button::class,
        ]);
    }
    public function register()
    {
        //$this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'blade-components');
    }
    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('panel');
            $this->registerComponent('button');
            $this->registerComponent('flash');
            $this->registerComponent('modal');
            $this->registerComponent('alert-danger');
            $this->registerComponent('alert-notice');
            $this->registerComponent('alert-success');
            $this->registerComponent('alert-warning');
        });
    }
    protected function registerComponent(string $component)
    {
        Blade::component('bladeComponents::components.'.$component, 'mm-'.$component,);
    }
}