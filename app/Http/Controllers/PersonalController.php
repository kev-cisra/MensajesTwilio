<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class PersonalController extends Controller
{
    //
    public function index(){
        return Inertia::render("Personal/Personal");
    }

    public function SavePerso(Request $request){
        // return $request;
        Validator::make($request, [
            'nombre' => ['required', 'string', 'max:80'],
            'ApPat' => ['required', 'string', 'max:80'],
            'ApMat' => ['required', 'string', 'max:80'],
            'clavePais' => ['required', 'string', 'max:3'],
            'Telefono' => ['required', 'string', 'min:10', 'max:10'],
        ])->validate();

        $per = new Personal;
        $per->nombre = $request->Nombre;
        $per->ApPat = $request->ApPat;
        $per->ApMat = $request->ApMat;
        $per->clavePais = $request->ClaPais;
        $per->Telefono = $request->Telefono;
        $per->save();
        return "Ok";
    }
}
