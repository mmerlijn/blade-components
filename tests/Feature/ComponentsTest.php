<?php
namespace mmerlijn\bladeComponents\tests\Feature;



use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\View\Component;
use mmerlijn\bladeComponents\BladeComponentsServiceProvider;
use mmerlijn\bladeComponents\helpers\BladeTheme;
use mmerlijn\bladeComponents\tests\TestCase;

class ComponentsTest extends TestCase
{
    use InteractsWithViews;
    protected function getPackageProviders($app)
    {
        return [BladeComponentsServiceProvider::class];
    }

    public function test_components_are_loaded()
    {
        //$this->assertTrue(View::exists('mm-panel'));
        //$this->assertTrue(View::exists('x-bladeComponents::panel'));
        //$this->assertTrue(View::exists('panel'));
        $this->assertTrue(View::exists('bladeComponents::components.panel'));
        $this->assertTrue(View::exists('bladeComponents::components.badge'));
        $this->assertTrue(View::exists('bladeComponents::components.table'));

    }
    public function test_themes(){
        $this->assertSame('bg-red-100', BladeTheme::getThemeBackground('red'));
        $this->assertSame('text-red-800', BladeTheme::getThemeText('red'));
    }
    public function test_various_components(){
        $view = $this->blade('<x-bc-th>hallo</x-bc-th>',[]);
        $view->assertSee('hallo');

        $view = $this->blade('<x-bc-panel title="See me" theme="red">This is text</x-bc-panel>');
        $view->assertSee('See me')
         ->assertSee('bg-red-100');


    }
    public function test_input_with_and_without_errors()
    {
        $view = $this->withViewErrors(['email_address'=>'required'])
            ->blade('<x-bc-input :name="$name" type="email"/>',['name'=>'email_address']);
        $view->assertSee("email_address")
            ->assertSee("border-red-600")
            ->assertDontSee("border-gray-300");

        $view = $this->withViewErrors(['lastname'=>'required'])
            ->blade('<x-bc-input :name="$name" type="email"/>',['name'=>'email_address']);
        $view->assertSee("email_address")
            ->assertSee("border-gray-300")
            ->assertDontSee("border-red-600");
    }
}
