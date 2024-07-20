<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RehashPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rehash:passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rehash passwords if necessary';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user) {
            // Since passwords aren't hashed, directly hash them without checking needsRehash
            $user->password = Hash::make($user->password);
            $user->save();
        }

        $this->info('Passwords rehashed successfully.');
        return 0;
    }
}
