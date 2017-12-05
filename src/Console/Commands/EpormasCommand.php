<?php namespace Bantenprov\DashboardEpormas\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use File;

/**
 * The EpormasCommand class.
 *
 * @package Bantenprov\DashboardEpormas
 * @author  Esza Herdi <unme.loved@gmail.com>
 */
class EpormasCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:epormas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controllers, Models, seeds, and Routes command for DashboardEpormas package';

    /**
     * The console command variable.
     *
     * @var string
     */
    protected $stubsController = [
       'controllers' => [
           'DashboardEpormasController.stub',
           'EpormasCategoryController.stub',
           'EpormasCityController.stub',
           'EpormasCounterController.stub'
       ]
    ];

    protected $stubsModel = [
       'models' => [
           'EpormasCategory.stub',
           'EpormasCity.stub',
           'EpormasCounter.stub'
       ]
    ];

    protected $stubsSeeds = [
       'seeds' => [
           'EpormasCategoryTableSeeder.stub',
           'EpormasCityTableSeeder.stub',
           'EpormasCounterTableSeeder.stub'
       ]
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function controllerViewCreate()
    {
        foreach($this->stubsController['controllers'] as $stub)
        {
            File::put(base_path('app/Http/Controllers/').str_replace('stub','php',$stub),File::get(__DIR__.'/../../stubs/Controllers/'.$stub));
        }
    }

    protected function modelViewCreate()
    {
        foreach($this->stubsModel['models'] as $stub)
        {
            File::put(base_path('app/').str_replace('stub','php',$stub),File::get(__DIR__.'/../../stubs/Models/'.$stub));
        }
    }

    protected function routeViewCreate()
    {
        File::append(base_path('routes/web.php'),File::get(__DIR__.'/../../stubs/routesweb.stub'));
        File::append(base_path('routes/api.php'),File::get(__DIR__.'/../../stubs/routesapi.stub'));
    }

    protected function seedsViewCreate()
    {
        foreach($this->stubsSeeds['seeds'] as $stub)
        {
            File::put(base_path('database/seeds/').str_replace('stub','php',$stub),File::get(__DIR__.'/../../stubs/seeds/'.$stub));
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->controllerViewCreate();
        $this->modelViewCreate();
        $this->routeViewCreate();
        $this->seedsViewCreate();
        $this->info('Create Controllers, Models, seeds, and Routes for DashboardEpormas package success');
    }
}
