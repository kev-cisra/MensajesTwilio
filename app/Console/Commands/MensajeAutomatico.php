<?php

namespace App\Console\Commands;

use App\Models\Mensajes;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MensajeAutomatico extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mensa:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron para mandar mensajes automaticamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $hoy = Carbon::now()->format("Y-m-d H:i");

        
        $mensajes = Mensajes::where("FecEnvio", "=", $hoy)
        ->Persona()
        ->get();
        
        foreach ($mensajes as $send) {
            $phone = $send->personal["clavePais"].$send->personal["Telefono"];
            mensa_twilio($phone, $send->Mensaje);
            
            if (boolval($send->Estatus)) {
                $newFec = Carbon::create($send->FecEnvio)->addMinutes($send->temporizador)->format("Y-m-d H:i");
                
                Mensajes::find($send->id)->update([
                    "FecEnvio" => $newFec
                ]);
            }
        }

        // Storage::disk('local')->put('Mensajes.txt', $newFec);
        return Command::SUCCESS;
    }
}
