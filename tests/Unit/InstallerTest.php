<?php

namespace Tests\Unit;

use Faveo\Installer\FaveoInstallerServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use \Illuminate\Container\Container as Container;
use \Illuminate\Support\Facades\Facade as Facade;

class InstallerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {

//        $app = new Container();
//        $app->singleton('app', 'Illuminate\Container\Container');
//
//        /**
//         * Set $app as FacadeApplication handler
//         */
//        Facade::setFacadeApplication($app);
//

        //use this to find out which plugin is running and activate that plugin
        $childClassNamespace = get_class($this);

        $addOnName = explode("\\", $childClassNamespace)[1];

        $providerRoot = '\App';

        $providerClassName = $addOnName.'ServiceProvider';

        /*
         * @todo Define a concrete and single structure for writing ServiceProviders for
         * custom modules and Plugins so that the code snippet here can be simplified.
         */
        if(strpos($childClassNamespace, 'Plugin')){
            $addOnName = explode("\\", $childClassNamespace)[2];
            $providerRoot = '\App\Plugins';
            $providerClassName = 'ServiceProvider';
        }

        //resetting routes because of conflicts between vue routes. It must be removed once that is sorted
        Route::setRoutes(new RouteCollection);

        //registering plugin routes before web routes
        App::register($providerRoot.'\\'.$addOnName.'\\'.$providerClassName);

        Route::group(['middleware' => 'web','namespace' => '\App\Http\Controllers'], function ($router) {
            require base_path('routes/web.php');
        });
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_server_requirements()
    {
        $this->withoutExceptionHandling();
        $this->call('GET', 'install')
            ->assertViewIs('vendor.layouts.server-requirement')
            ->assertViewHas('permissionBlock', 'requisites');
    }

}
