<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdvertiserEmail;
use App\Models\Advertiser;

class SendAdvertiserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tomorrow = date("Y-m-d", strtotime("+1 day"));
        $advertisers = Advertiser::whereHas('ads', function($query) use($tomorrow) {
            $query->where('start_date', $tomorrow);
        })->get();
        foreach ($advertisers as $advertiser) {
            Mail::to($advertiser->email)->send(new AdvertiserEmail());
        }
    }
}
