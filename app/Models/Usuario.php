<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory,SoftDeletes;
    /** propiedades del modelo
     * nombre
     * apellido
     * email
     * password
     * status
     */

     use HasFactory;

     protected $fillable =[
        'nombre',
        'apellido',
        'email',
        'password',
        'status'
     ];

     protected $hidden =[
        'password',
        'created_at',
        'updated_at',
        'delete_at'

     ];

}
