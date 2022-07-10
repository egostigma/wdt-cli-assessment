<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RemoveDuplicateCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'removeDuplicate {array* : The input array (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Remove duplicate members from an array';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $array = $this->argument('array');
        $output = [];
        $temp_array = $array;
        $result_array = $array;

        // $result_array = array_unique($array); // easy way

        // manual
        foreach ($array as $key => $value) {
            array_shift($temp_array);
            foreach ($temp_array as $key2 => $value2) {
                if ($value == $value2) {
                    unset($result_array[($key + 1) + $key2]);
                }
            }
        }

        foreach ($result_array as $value) {
            $output[] = (int) $value;
        }

        $this->info(json_encode($output));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
