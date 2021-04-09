<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TCG\Voyager\Traits\Seedable;

class ComputerTrainingInstall extends Command
{
  use Seedable;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'training:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install dummy data for Computer Training Application';

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
    public function handle()
    {
      if($this->confirm('This will delete All your data and install the default dummy data. Are you sure?')) {
        $this->callSilent('storage:link');

        $this->call('migrate:fresh',[
          '--seed' => true,
        ]);
        $this->info('Seeding data into the database');
        $this->call('db:seed',[
          '--class' => 'VoyagerDatabaseSeeder',
        ]);

        $this->call('db:seed',[
          '--class' => 'VoyagerDummyDatabaseSeeder',
        ]);

        $this->call('db:seed',[
          '--class' => 'TeachersTableSeeder',
        ]);

        $this->call('db:seed',[
          '--class' => 'RoomsTableSeeder',
        ]);

        $this->call('db:seed',[
          '--class' => 'ClassroomsTableSeeder',
        ]);

        $this->info('Dummy data installed');
      }

    }
}
