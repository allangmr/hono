<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $fillable = [
        'nombre', 'fec_nacimiento', 'telefono','direccion', 'email','cedula', 'id_estado'
    ];
}
