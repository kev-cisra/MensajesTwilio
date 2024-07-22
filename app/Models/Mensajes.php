<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensajes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at']; //Registramos la nueva columna
    protected $guarded = ['id','created_at','updated_at'];

    public function personal(){
        return $this->belongsTo(Personal::class, "personal_id");
    }

    public function scopePersona($q){
        $q->with([
            "personal" => function($p){
                $p->select("id", "nombre", "ApPat", "ApMat", "clavePais", "Telefono");
            }
        ]);
    }
}
