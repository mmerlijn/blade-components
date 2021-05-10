<?php
namespace mmerlijn\bladeComponents\tests\Feature;



use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
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

    public function test_all_components_are_loaded()
    {
        foreach (scandir(__DIR__."/../../resources/views/components") as $file){
            if(!in_array($file, [".",".."])){
                $this->assertTrue(View::exists('bladeComponents::components.'.Str::before($file,".")));
            }
        }
    }
    public function test_various_components(){
        $view = $this->blade('<x-'.config('blade-components.prefix').'-th>hallo</x-'.config('blade-components.prefix').'-th>',[]);
        $view->assertSee('hallo');

        $view = $this->blade('<x-'.config('blade-components.prefix').'-panel title="See me" color="red">This is text</x-'.config('blade-components.prefix').'-panel>');
        $view->assertSee('See me')
         ->assertSee('bg-red-100');


    }
    public function test_checkbox_component()
    {
        $label_text = 'Accept agreement';
        $view = $this->blade('<x-'.config('blade-components.prefix').'-checkbox :name="$name" label="Accept agreement"/>',['name'=>$label_text]);
        $view->assertSee($label_text);
    }
    public function test_input_with_and_without_errors()
    {
        $view = $this->withViewErrors(['email_address'=>'required'])
            ->blade('<x-'.config('blade-components.prefix').'-input :name="$name" type="email"/>',['name'=>'email_address']);
        $view->assertSee("email_address")
            ->assertSee("border-red-600")
            ->assertDontSee("border-gray-300");

        $view = $this->withViewErrors(['lastname'=>'required'])
            ->blade('<x-'.config('blade-components.prefix').'-input :name="$name" type="email"/>',['name'=>'email_address']);
        $view->assertSee("email_address")
            ->assertSee("border-gray-300")
            ->assertDontSee("border-red-600");
    }
}
