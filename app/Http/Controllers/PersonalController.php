<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonalController extends Controller
{
    //
    public function index(){
        return Inertia::render("Personal/Personal");
    }

    // Consulta informacion del personal
    public function ConsPersonal(){
        $per = Personal::get();

        return $per;
    }

    // Guardar personal
    public function SavePerso(Request $request){
        // return $request;
        $request->validate([
            'Nombre' => 'required|string|max:80',
            'ApPat' => 'required|string|max:80',
            'ApMat' => 'required|string|max:80',
            'ClaPais' => 'required|string|max:4',
            'Telefono' => 'required|integer|min:1000000000|max:9999999999',
        ]);

        Personal::updateOrCreate(['id' => $request->id], [
            "nombre" => $request->Nombre,
            "ApPat" => $request->ApPat,
            "ApMat" => $request->ApMat,
            "clavePais" => $request->ClaPais,
            "Telefono" => $request->Telefono
        ]);

        return "Ok";
    }

    // Elimiona el personal
    public function DeletPer($id){
        Personal::find($id)->delete();
        return "ok";
    }
}
