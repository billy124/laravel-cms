<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use Illuminate\Support\Facades\File;

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
        $directory = resource_path('assets/pages/');
        $files = File::allFiles($directory);
        
        //$bar = $this->output->createProgressBar(count($files));
        
        foreach ($files as $file) {
            $contents = json_decode(File::get($file), true);

            $page = Page::where('id', $contents['id'])
                    ->first();
            
            if($page) {
                $page->fill($contents);
                $page->save();
            } else {
                Page::create($contents);
            }
            
            //$bar->advance();
        }
    }
}
