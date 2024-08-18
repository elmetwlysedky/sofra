<?php

namespace App\Console\Commands;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete offers that have expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredOffers = Offer::where('end_to', '<', Carbon::now())->delete();

        $this->info("Expired offers have been deleted.");
    }
}
