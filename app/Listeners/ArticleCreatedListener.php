<?php

namespace App\Listeners;

use Carbon\Carbon;
use App\Models\Label;
use App\Events\ArticleCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $labels = collect($event->labels);
        $currentLabels = Label::select('name')->whereIn('name', $labels)->pluck('name')->toArray();
        $labels = $labels->reject(function($label) use($currentLabels) {
            return in_array($label, $currentLabels);
        });
        $labels = $labels->map(function($label) {
            return ['name' => $label, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
        });
        Label::insert($labels->toArray());
    }
}
