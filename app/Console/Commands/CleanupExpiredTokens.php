<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CleanupExpiredTokens extends Command
{
    protected $signature = 'app:cleanup-expired-tokens'; 
    protected $description = 'Cleanup expired password reset tokens';

    public function handle()
    {
        $expirationTime = Carbon::now()->subMinutes(2);

        DB::table('password_reset_tokens')
            ->where('created_at', '<', $expirationTime)
            ->delete();

        $this->info('Expired tokens cleaned up successfully.');
    }
}