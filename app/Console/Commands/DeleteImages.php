<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DeleteImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all images in specified folders';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directories = [
            'public/uploads/Aboutus',
            'public/uploads/Books',
            'public/uploads/Colleges',
            'public/uploads/Setting',
            'public/uploads/Sliders',
            'public/uploads/Universities',
            'public/uploads/Users',
        ];

        foreach ($directories as $directory) {
            $files = File::files($directory);

            foreach ($files as $file) {
                File::delete($file);
            }

            $this->info("Deleted all images in $directory");
        }

        return 0;
    }
}
