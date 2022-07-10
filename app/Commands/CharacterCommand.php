<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CharacterCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'character {text : The input text (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Find the first non repeating char in a string';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input = $this->argument('text');
        $current_char = '';
        $processed_chars = [];
        while (!!$input) {
            $current_char = $input[0];
            if (!in_array($current_char, $processed_chars)) {
                array_push($processed_chars, $current_char);
                $input = substr($input, 1);
                if (!strpos($input, $current_char)) {
                    $this->info($current_char);
                    break;
                }
            } else {
                $input = substr($input, 1);
            }
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
