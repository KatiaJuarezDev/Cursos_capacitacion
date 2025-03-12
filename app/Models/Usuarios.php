<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
   use HasFactory;
   protected $table = 'usuarios';
   protected $primaryKey = 'user_id'; // Indica a Laravel que la clave primaria es 'user_id'

    public $timestamps = true; // Si no usas 'created_at' y 'updated_at', ponlo en 'false'


    protected $fillable = [
         'nombre',
         'email',
         'password',
         'tipo_usuario'
    ];
}
