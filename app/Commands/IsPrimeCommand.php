<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class IsPrimeCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'isPrime {num : The input number (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Verify a prime number';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $num = $this->argument('num');
        $this->info($this->isPrime($num) ? 'true' : 'false');
    }

    private function isPrime(int $num): bool
    {
        if ($num == 1) {
            return 0;
        }

        for ($i = 2; $i <= $num/2; $i++) {
            if ($num % $i == 0) {
                return 0;
            }
        }

        return 1;
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
