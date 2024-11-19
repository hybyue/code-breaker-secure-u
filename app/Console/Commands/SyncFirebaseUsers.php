<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\FirebaseService;


class SyncFirebaseUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-firebase-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(FirebaseService $firebaseService)
    {
        $this->info('Starting user sync...');
        
        $users = User::all();
        $bar = $this->output->createProgressBar(count($users));
        
        foreach ($users as $user) {
            $firebaseService->syncUser($user);
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('User sync completed!');
        
        return Command::SUCCESS;
    }
}
