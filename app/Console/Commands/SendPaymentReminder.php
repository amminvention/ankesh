<?php

namespace App\Console\Commands;

use App\Setting;
use App\VehicleRecord;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class SendPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:paymentreminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send payment reminder to customer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $setting = Setting::latest()->first();
        $vehicle_records = VehicleRecord::whereDate('renewal_date', '<=' ,Carbon::now()->addDay(6)->format('Y-m-d'))->orderBy('renewal_date', 'DESC')->get();

        if($vehicle_records->count() > 0)
        {
            foreach($vehicle_records as $vehicle_record) {

                // Send the email to user
                Mail::send('email.reminder', ['vehicle_record' => $vehicle_record], function ($mail) use ($vehicle_record, $setting) {
                    $mail->to($vehicle_record->customers->email)
                        ->from($setting->mail_from, $setting->site_name)
                        ->subject('Payment Reminder');
                });

            }

            $this->info('Payment Reminder sent successfully!');
        }
    }
}
