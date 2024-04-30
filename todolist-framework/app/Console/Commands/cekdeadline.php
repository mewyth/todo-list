<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//model
use App\Models\jadwal;
//carbon buat cek tanggal
use Carbon\Carbon;

class cekdeadline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cekdeadline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $jadwals = jadwal::where('id_user', session('user.id'))->get();
        //cek deadline
        foreach ($jadwals as $jadwal) {
            if (Carbon::parse($jadwal->end)->lt(Carbon::now())) {
                $message = 'Tugas dengan judul "'.$jadwal->judul.'" telah melewati deadline';
                $this->info($message);
                //kirim session
                session()->push('alerts', $message);
            }
        }
    }
}
