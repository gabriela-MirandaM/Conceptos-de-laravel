<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'paises';

    protected $fillable =[
        'nombre',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function departamentos()
    {
        return $this->hasMany(Departamento::class);
    }
}
