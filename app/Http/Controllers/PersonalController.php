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

    public function SavePerso(Request $request){
        // return $request;
        $request->validate([
            'Nombre' => 'required|string|max:80',
            'ApPat' => 'required|string|max:80',
            'ApMat' => 'required|string|max:80',
            'ClaPais' => 'required|string|max:4',
            'Telefono' => 'required|integer|min:1000000000|max:9999999999',
        ]);

        // $per = new Personal;
        // $per->nombre = $request->Nombre;
        // $per->ApPat = $request->ApPat;
        // $per->ApMat = $request->ApMat;
        // $per->clavePais = $request->ClaPais;
        // $per->Telefono = $request->Telefono;
        // $per->save();

        return "Ok";
    }
}
