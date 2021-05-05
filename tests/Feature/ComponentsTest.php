<?php
namespace mmerlijn\bladeComponents\tests\Feature;



use Illuminate\Support\Facades\View;
use mmerlijn\bladeComponents\tests\TestCase;

class ComponentsTest extends TestCase
{

    public function test_components_are_loaded()
    {
        //$this->assertTrue(View::exists('mm-panel'));
        $this->assertTrue(View::exists('x-mm-panel'));
    }
    public function test_panel_component(){
        $view = $this->blade(
            '<x-mm-panel :title="$title">Test panel</x-mm-panel>',
            ['title'=>'Panel']
        );
        $view->assertSee('Test panel');
        $view->assertSee('Panel');
    }
}
