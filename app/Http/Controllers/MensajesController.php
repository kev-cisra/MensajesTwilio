<?php

namespace App\Http\Controllers;

use App\Models\Mensajes;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MensajesController extends Controller
{
    //
    public function SendMesaje(Request $request){
        $phone = $request->claPais.$request->telefono;
        
        mensa_twilio($phone, $request->mensaje);

        return "ok";
    }

    public function SaveMensa(Request $request){
        $hoy = Carbon::now()->format("Y-m-d H:i");
        
        $request->validate([
            'fecha' => "required|date|after_or_equal:$hoy",
            'mensaje' => 'required|string|max:200'
        ]);

        if ($request->estatus) {
            $request->validate([
                'temporizador' => "required|integer|min:2"
            ]);
        }

        Mensajes::updateOrCreate(['id' => $request->id], [
            "Estatus" => $request->estatus,
            "FecEnvio" => $request->fecha,
            "temporizador" => $request->temporizador,
            "Mensaje" => $request->mensaje,
            "personal_id" => $request->personal
        ]);

        return "ok";
    }
}
