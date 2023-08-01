<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;

class UpdateExpiredTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update status of expired transactions from "belum bayar" to "expired"';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $transactions = Transaction::where('status', 'belum bayar')
            ->where('expired', '<=', Carbon::now())
            ->get();

        foreach ($transactions as $transaction) {
            $transaction->status = 'expired';
            $transaction->save();
        }

        $this->info('Expired transactions have been updated.');

        return 0;
    }
}
