<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name : The name CRUD Module}
        {--route : with Routing}
        {--route-acl : with Routing ACL}
        {--view : with View Template}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD Operation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $name = $this->argument('name');
        $this->controller($name);
        if ($this->option('route')) {
            $this->route($name);
        }
        if ($this->option('route-acl')) {
            $this->routeACL($name);
        }
        if ($this->option('view')) {
            $this->views($name);
        }
    }

    protected function getStub($type)
    {
        return file_get_contents(base_path("stubs/crud.$type.stub"));
    }

    protected function controller($name){
        $controllerTemplate = str_replace([
            '{{ class }}',
            '{{ model }}',
            '{{ modelPlural }}',
            '{{ modelSingular }}',
            '{{ viewPath }}',
            '{{ routePath }}',
        ],
        [
            $name,
            $name,
            strtolower(\Str::snake(\Str::plural($name))),
            strtolower(\Str::snake(\Str::singular($name))),
            strtolower(\Str::snake(\Str::singular($name))),
            strtolower(\Str::snake(\Str::singular($name))),
        ],
        $this->getStub('controller'));

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function route($name){
        $path = strtolower($name);

        $route = "
        Route::prefix('".$path."')->group(function(){
            Route::get('/', '".$name."Controller@index')->name('".$path."');
            Route::post('/', '".$name."Controller@getData');
            Route::get('add/', '".$name."Controller@form')->name('".$path.".add');
            Route::post('add/', '".$name."Controller@save');
            Route::get('edit/{id}', '".$name."Controller@form')->name('".$path.".edit');
            Route::post('edit/{id}', '".$name."Controller@save');
            Route::delete('delete/{id}', '".$name."Controller@destroy')->name('".$path.".delete');
        });
        ";

        \File::append(base_path('routes/web.php'),$route);
    }

    protected function routeACL($name){
        $path = strtolower($name);

        $route = "
        Route::prefix('".$path."')->group(function(){
            Route::middleware('can:".$path."')->group(function(){
                Route::get('/', '".$name."Controller@index')->name('".$path."');
                Route::post('/', '".$name."Controller@getData');
            });
            Route::middleware('can:".$path.".add')->group(function(){
                Route::get('add/', '".$name."Controller@form')->name('".$path.".add');
                Route::post('add/', '".$name."Controller@save');
            });
            Route::middleware('can:".$path.".edit')->group(function(){
                Route::get('edit/{id}', '".$name."Controller@form')->name('".$path.".edit');
                Route::post('edit/{id}', '".$name."Controller@save');
            });
            Route::delete('delete/{id}', '".$name."Controller@destroy')->name('".$path.".delete')->middleware('can:".$path.".delete');
        });
        ";

        \File::append(base_path('routes/web.php'),$route);
    }

    protected function views($name){
        $path = "views/".strtolower(\Str::snake(\Str::singular($name)));
        if(!is_dir(resource_path($path))) {
            mkdir(resource_path($path),0777,true);
        }

        $search = [
            '{{ class }}',
            '{{ model }}',
            '{{ modelPlural }}',
            '{{ modelSingular }}',
            '{{ viewPath }}',
            '{{ routePath }}',
        ];

        $replace = [
            $name,
            $name,
            strtolower(\Str::snake(\Str::plural($name))),
            strtolower(\Str::snake(\Str::singular($name))),
            strtolower(\Str::snake(\Str::singular($name))),
            strtolower(\Str::snake(\Str::singular($name))),
        ];

        $formTemplate = str_replace($search,$replace,$this->getStub('view.form'));
        file_put_contents(resource_path($path."/form.blade.php"), $formTemplate);

        $homeTemplate = str_replace($search,$replace,$this->getStub('view.home'));
        file_put_contents(resource_path($path."/home.blade.php"), $homeTemplate);
    }
}
