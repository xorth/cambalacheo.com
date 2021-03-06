<?php

namespace App\Listeners;

use App\Events\ArticleCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NewArticleAlertFacebook
{
    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  ArticleCreated  $event
     * @return void
     */
    public function handle(ArticleCreated $event)
    {
        $this->dispatch(
            new \App\Jobs\NewArticleFacebookAlert($event->article, "facebook")
        );
    }
}
