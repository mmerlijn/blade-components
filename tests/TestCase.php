<?php
namespace mmerlijn\bladeComponents\tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use mmerlijn\bladeComponents\BladeComponentsServiceProvider;


class TestCase extends \Orchestra\Testbench\TestCase
{
    //use RefreshDatabase;
    //protected $loadEnvironmentVariables = true;


    public function setUp(): void
    {
        // Code before application created.

        parent::setUp();

        // Code after application created.
    }

    protected function getPackageProviders($app)
    {
        return [
            BladeComponentsServiceProvider::class
        ];

    }
    protected function getEnvironmentSetUp($app)
    {

    }
    protected function getApplicationTimezone($app)
    {
        return "Europe/Amsterdam";
    }



}