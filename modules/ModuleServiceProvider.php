<?php

namespace Modules;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{
    
    // Declare all middlewares
    private $middlewares = [
        // 'demo'      => \Modules\User\src\Http\Middlewares\DemoMiddleware::class,
        // 'user'      => \Modules\User\src\Http\Middlewares\UserMiddleware::class,
    ];

    // Declare all commands
    private $commands = [
        // \Modules\User\src\Commands\TestCommand::class,
    ];


    public function boot() 
    {
        $modules = $this->getModules();

        if (!empty($modules)) {
            foreach ($modules as $moduleName) {
                $this->registerModule($moduleName);
            }
        }
    }


    public function register()
    {
        // Configs
        $modules = $this->getModules();
        if (!empty($modules)) {
            foreach ($modules as $moduleName) {
                $this->registerConfig($moduleName);
            }
        }

        // Middlewares
        $this->registerMiddleware();

        // Commands
        $this->commands($this->commands);

        // Register the repositories
        // $this->app->singleton(
        //     // UserRepositoryInterface::class,
        //     // UserRepository::class
        // );
    }


    // get all directory modules in the folder "modules"
    private function getModules()
    {
        return array_map('basename', File::directories(__DIR__));
    }


    // register 1 config
    private function registerConfig($moduleName)
    {
        $configPath = __DIR__.DIRECTORY_SEPARATOR.$moduleName.DIRECTORY_SEPARATOR.'configs';
                
        if (File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles($configPath));
            
            if (!empty($configFiles)) {
                foreach ($configFiles as $file) {
                    
                    $alias = basename($file, '.php');
                    $this->mergeConfigFrom($configPath.DIRECTORY_SEPARATOR.$file, $alias);
                    
                }
            }
        }
    }


    // Register middlewares
    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }


    // Register all functions of 1 module
    private function registerModule($moduleName)
    {
        $modulePath = __DIR__.DIRECTORY_SEPARATOR.$moduleName.DIRECTORY_SEPARATOR;
        
        // Routes
        if (File::exists($modulePath.'routes'.DIRECTORY_SEPARATOR.'routes.php')) {
            $this->loadRoutesFrom($modulePath.'routes'.DIRECTORY_SEPARATOR.'routes.php');
        }

        // migration
        if (File::exists($modulePath. DIRECTORY_SEPARATOR. 'migrations')) {
            $this->loadMigrationsFrom($modulePath. 'migrations');
        }

        // languages
        if (File::exists($modulePath . 'resources' . DIRECTORY_SEPARATOR . 'lang')) {
            $this->loadTranslationsFrom($modulePath . 'resources' . DIRECTORY_SEPARATOR . 'lang', $moduleName);

            $this->loadJsonTranslationsFrom($modulePath . 'resources' . DIRECTORY_SEPARATOR . 'lang');
        }

        // views
        if (File::exists($modulePath . 'resources' . DIRECTORY_SEPARATOR . 'views')) {
            $this->loadViewsFrom($modulePath . 'resources' . DIRECTORY_SEPARATOR . 'views', $moduleName);
        }

        // Helpers
        if (File::exists($modulePath. 'helpers')) {
            $helperList = File::allFiles($modulePath. 'helpers');

            if (!empty($helperList)) {
                foreach ($helperList as $helperFile) {
                    $helperPath = $helperFile->getPathName();
                    require $helperPath;
                }
            }
        }
    } 
}