<?php

namespace App\Console\Commands;

use App\Models\Lost;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckLostFoundExceeded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-lost-found-exceeded';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     * Execute the console command.
     */
    public function handle(): void
    {
        // $oneWeekAgo = Carbon::now()->subWeek();

        // // Update records where is_claimed is 0 and older than 1 week
        // Lost::where('is_claimed', 0)
        //             ->where('created_at', '<', $oneWeekAgo)
        //             ->update(['is_exceeded' => true]);

        // $this->info('Lost items that exceeded 1 week have been updated.');

        Lost::where('is_claimed', 0)->update(['is_transferred' => true]);
        $this->info('Command executed: app:check-lost-found-exceeded');
        }
}
