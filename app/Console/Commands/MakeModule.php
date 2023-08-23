<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        if (!File::exists(base_path('modules'))) {
            File::makeDirectory(base_path('modules'), 0755, true, true);
            $this->info("Folder /modules created.");
        }

        if (File::exists(base_path('modules'.DIRECTORY_SEPARATOR.$name))) {
            
            $this->error("Module $name already existed !");
            
        } else {

            // create Module
            File::makeDirectory(base_path('modules'.DIRECTORY_SEPARATOR.$name), 0755, true, true);

            // configs
            $configPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'configs');
            if (!File::exists($configPath)) {
                File::makeDirectory($configPath, 0755, true, true);

                // file config.php
                if (!File::exists($configPath.DIRECTORY_SEPARATOR.'config.php')) {
                    File::put($configPath.DIRECTORY_SEPARATOR.'config.php', "<?php \n\nreturn [ \n \n];");
                }
            }                       

            // helpers
            $helpersPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'helpers');
            if (!File::exists($helpersPath)) {
                File::makeDirectory($helpersPath, 0755, true, true);
            }

            // migrations
            $migrationsPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'migrations');
            if (!File::exists($migrationsPath)) {
                File::makeDirectory($migrationsPath, 0755, true, true);
            }
            
            // resources
            $resourcesPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'resources');
            if (!File::exists($resourcesPath)) {
                File::makeDirectory($resourcesPath, 0755, true, true);

                // language
                File::makeDirectory($resourcesPath.DIRECTORY_SEPARATOR.'lang', 0755, true, true);

                // views
                File::makeDirectory($resourcesPath.DIRECTORY_SEPARATOR.'views', 0755, true, true);
            }           

            // routes
            $routesPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'routes');
            if (!File::exists($routesPath)) {
                File::makeDirectory($routesPath, 0755, true, true);

                // file routes.php
                if (!File::exists($routesPath.DIRECTORY_SEPARATOR.'routes.php')) {
                    File::put($routesPath.DIRECTORY_SEPARATOR.'routes.php', "<?php \nuse Illuminate\Support\Facades\Route;\n");
                }
            }

            // src
            $sourcePath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'src');
            if (!File::exists($sourcePath)) {
                
                // src
                File::makeDirectory($sourcePath, 0755, true, true);

                // commands
                File::makeDirectory($sourcePath.DIRECTORY_SEPARATOR.'Commands', 0755, true, true);

                // Http
                File::makeDirectory($sourcePath.DIRECTORY_SEPARATOR.'Http', 0755, true, true);

                // Controllers
                File::makeDirectory($sourcePath.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Controllers', 0755, true, true);

                // Middlewares
                File::makeDirectory($sourcePath.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'Middlewares', 0755, true, true);

                // Models
                File::makeDirectory($sourcePath.DIRECTORY_SEPARATOR.'Models', 0755, true, true);
            }

            // Repositories
            $repositoryPath = base_path('modules'.DIRECTORY_SEPARATOR.$name.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Repositories');

            if (!File::exists($repositoryPath)) {

                // Repositories
                File::makeDirectory($repositoryPath, 0755, true, true);

                // {module}repository.php
                $fileContent = file_get_contents(app_path('Console'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'ModuleRepository.txt'));
                $fileContent = str_replace('{module}', $name, $fileContent);
                File::put($repositoryPath.DIRECTORY_SEPARATOR."{$name}Repository.php", $fileContent);
                
                // {module}repositoryInterface.php
                $fileContent = file_get_contents(app_path('Console'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR.'ModuleRepositoryInterface.txt'));
                $fileContent = str_replace('{module}', $name, $fileContent);
                File::put($repositoryPath.DIRECTORY_SEPARATOR."{$name}RepositoryInterface.php", $fileContent);

            }

            $this->info("Module $name created successfully");
        }


        // BaseRepository and RepositoryInterface
        $repositoryPath = app_path('Repositories');

            // create folder Repositories
        if (!File::exists($repositoryPath)) {
            File::makeDirectory($repositoryPath, 0755, true, true);
            $this->info("Folder app/Repositories created.");
        }
            // create file BaseRepository.php
        if (!File::exists($repositoryPath.DIRECTORY_SEPARATOR.'BaseRepository.php')) {
            $fileContent = file_get_contents(app_path('Console'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'BaseRepository.txt'));
            File::put($repositoryPath.DIRECTORY_SEPARATOR.'BaseRepository.php', $fileContent);
            $this->info("File BaseRepository.php created.");
        }
            // // create file RepositoryInterface.php
        if (!File::exists($repositoryPath.DIRECTORY_SEPARATOR.'RepositoryInterface.php')) {
            $fileContent = file_get_contents(app_path('Console'.DIRECTORY_SEPARATOR.'Commands'.DIRECTORY_SEPARATOR.'Templates'.DIRECTORY_SEPARATOR.'RepositoryInterface.txt'));
            File::put($repositoryPath.DIRECTORY_SEPARATOR.'RepositoryInterface.php', $fileContent);
            $this->info("File RepositoryInterface.php created.");
        }
    }
}
