<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class zamb extends Command
{

    protected $resourceName;
    protected $all;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'zamb:generateresource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Zamb admin resource.';

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
     * @return mixed
     */
    public function fire()
    {
        $this->resourceName = $this->argument('name');
        $this->all = $this->option('all');

        $generator = new Zamb\Generator\Generator($this->resourceName);
        if (!empty($this->all)) {
            $generator->generateZambCrudController();
            $generator->generateZambModel();
            $generator->generateZambRepository();
            $generator->generateZambViews();
            $generator->printZambRoutes();
        } else {

            if ($this->confirm('Do you wish to generate CRUD controller? [yes|no]')) {
                $generator->generateZambCrudController();
            }

            if ($this->confirm('Do you wish to generate model? [yes|no]')) {
                $generator->generateZambModel();
            }

            if ($this->confirm('Do you wish to generate migration? [yes|no]')) {
                $migrationName = $this->getMigrationName($generator->templateData['resource']);

                $this->call('generate:migration', [
                    'migrationName' => $migrationName
                ]);
            }

            if ($this->confirm('Do you wish to generate seed? [yes|no]')) {
                $tableName = $generator->templateData['collection'];
                $this->call('generate:seed', compact('tableName'));
            }

            if ($this->confirm('Do you wish to generate repository? [yes|no]')) {
                $generator->generateZambRepository();
            }

            if ($this->confirm('Do you wish to generate CRUD views? [yes|no]')) {
                $generator->generateZambViews();
            }
            
            if ($this->confirm('Do you wish to see routes? [yes|no]')) {
                $generator->printZambRoutes();
            }
        }

        $this->info('Done');


    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'name of the resource'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('all', null, InputOption::VALUE_OPTIONAL, 'Generate bundle (Controller, Model, View, Repository etc.)', null),
        );
    }


    /**
     * Get the name for the migration
     *
     * @param $resource
     * @return string
     */
    protected function getMigrationName($resource)
    {
        return "create_" . str_plural($resource) . "_table";
    }
}
