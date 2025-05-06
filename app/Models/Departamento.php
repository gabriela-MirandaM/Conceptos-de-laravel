<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'departamentos';

    protected $fillable =[
        'nombre',
        'id_pais',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function pais()
    {
        return $this->belongsTo(Pais::class,'id_pais');//pais_id
    }

    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

}
