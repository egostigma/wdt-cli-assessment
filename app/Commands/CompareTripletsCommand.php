<?php

namespace App\Commands;

use Exception;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CompareTripletsCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'triplets {--data*=* : The input array of triplet (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Find comparison points of triplets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->option('data');
        $triplets = [];
        $points = [];

        foreach ($data as $key => $value) {
            $triplets[$key] = explode(" ", $value);
            $points[$key] = 0;
            throw_unless(
                sizeof($triplets[$key]) == 3,
                new Exception("Array $key is not a triplet")
            );
        }

        for ($i = 0; $i < sizeof($triplets); $i++) {
            for ($j = ($i + 1); $j < sizeof($triplets); $j++) {
                for ($k = 0; $k <= sizeof($triplets[$i]) - 1; $k++) {
                    if ($triplets[$i][$k] > $triplets[$j][$k]) {
                        $points[$i]++;
                    } elseif ($triplets[$i][$k] < $triplets[$j][$k]) {
                        $points[$j]++;
                    }
                }
            }
        }

        $this->info(implode(" ", $points));
    }

    private function isPrime($num)
    {
        for ($i = 2; $i < $num; $i++) {
            if ($num % $i == 0) {
                return 0;
            }

            return 1;
        }
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
