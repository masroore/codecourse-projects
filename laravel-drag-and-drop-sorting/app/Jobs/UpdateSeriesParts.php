<?php

namespace App\Jobs;

use App\Series;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateSeriesParts implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $series;

    public $parts;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Series $series, $parts)
    {
        $this->series = $series;
        $this->parts = $parts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->series->parts->each(function ($part, $index) {
            $part->timestamps = false;
            $part->update(array_only($this->parts[$index], ['title', 'sort_order']));
        });
    }
}
