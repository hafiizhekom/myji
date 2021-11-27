<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $num;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($i)
    {
        //
        $this->num = $i;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        //
        // echo "Running an example job ...\n";
        $rawData = file_get_contents('https://api.vultr.com/v1/os/list');
        $list = json_decode($rawData, true);
        shuffle($list);
        $key = array_rand($list);
        $favorite = $list[$key];
        Log::info('My Favorite OS is: ' . $favorite['name']. ' - '. Carbon\Carbon::now());
        echo 'My Favorite OS is: ' . $favorite['name'];
    }
}
