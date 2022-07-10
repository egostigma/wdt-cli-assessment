<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Str;

class ReverseCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'reverse {text : The input text (required)}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Reverse words but not reverse the place';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $input_text = $this->argument('text');
        $exp_texts = explode(" ", $input_text);
        foreach ($exp_texts as $key => $text) {
            $exp_texts[$key] = Str::reverse($text);
        }

        $texts = implode(" ", $exp_texts);

        $this->info($texts);
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
