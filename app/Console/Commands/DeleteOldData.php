<?php

namespace App\Console\Commands;

use App\Services\TodoService;
use Exception;
use Illuminate\Console\Command;

class DeleteOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_old_date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will delete all the todos which soft deleted more than a month';

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
        try{
            $this->info("Started...");

            TodoService::delete_old_date();

            $this->info("");
            $this->info("finished...");
            $this->info("successfully deleted");
        }catch(Exception $e){
            $this->error($e->getMessage());
        }
    }
}
