<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class SyncPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync pages after a git pull';

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
        // delete all the records from the pages table
        DB::table((new Page())->getTable())->truncate();
        // the directory we store all new pages json in
        $directory = resource_path('assets/pages/');
        // get all the files from the page directory
        $files = File::allFiles($directory);
        
        // create a progress bar for feed back purposes 
        $progress = $this->output->createProgressBar(count($files));
        
        // start and displays the progress bar
        $progress->start();

        // loop through the files
        foreach ($files as $file) {
            // get the contents of the file as an array
            $contents = json_decode(File::get($file), true);

            if(isset($contents['id'])) {
                // drop the id key as we dont need it
                array_forget($contents, 'id');
            }
            
            Page::create($contents);
            
            // update the advance bar
            $progress->advance();
        }
        
        // finish the bar
        $progress->finish();
        
        $this->line('');
        $this->info('Sync completed.');
    }
}
