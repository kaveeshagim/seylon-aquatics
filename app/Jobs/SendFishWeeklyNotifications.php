<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Services\PHPMailerService;

class SendFishWeeklyNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;

    /**
     * Create a new job instance.
     *
     * @param  \Illuminate\Support\Collection  $users
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $subject = "Weekly Fish Stock List - " . now()->weekOfYear;
        $body = 'Hi, <br><br>New Fish Weekly Stock List is added';

        foreach ($this->users as $user) {
            // Insert notification into the database
            DB::table('tbl_notifications')->insert([
                'user_id' => $user->id,
                'notification' => "New Fish Weekly Stock List for week " . now()->weekOfYear . " is added!",
                'seen_status' => 0,
                'created_at' => now(),
            ]);

            // Send email to the user
            try {
                $mailerService = new PHPMailerService();
                $mailerService->sendEmail($user->email, $subject, nl2br($body));
                \Log::info('Email sent to: ' . $user->email);
            } catch (\Exception $e) {
                \Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
            }
        }
    }
}
