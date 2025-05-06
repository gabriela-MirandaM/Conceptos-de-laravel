<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*Usuario::create([
            'nombre' => 'Karla',
            'apellido' => 'Miranda',
            'email' => 'karla@gmail.com',
            'password' => Hash::make('mirandaK25$'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);*/

        /*$usuarios =[
            [
                'nombre' => 'Stefani',
                'apellido' => 'Miranda',
                'email' => 'Stefani@gmail.com',
                'password' => Hash::make('mejiaStefani25$'),
                'status' => 1,
            ],
            [
                'nombre' => 'Kendal',
                'apellido' => 'Sosa',
                'email' => 'Kendal@gmail.com',
                'password' => Hash::make('sosa37Kendal25!'),
                'status' => 1,
            ],
            [
                'nombre' => 'Ana',
                'apellido' => 'Mejia',
                'email' => 'Ana@gmail.com',
                'password' => Hash::make('mejiaAna65?'),
                'status' => 1,
            ],
            [
                'nombre' => 'Carlos',
                'apellido' => 'Moreno',
                'email' => 'Carlos@gmail.com',
                'password' => Hash::make('sanchezCarlos08*'),
                'status' => 1,
            ],
        ];

        DB::table('usuarios)->insert($usuarios);

        foreach($usuarios as $usuario){
            Usuario::create($usuario);
        }*/

        DB::table('usuarios')->insert([
            [
                'nombre' => 'Chistian',
                'apellido' => 'Deleon',
                'email' => 'Chistian@mail.com',
                'password' => Hash::make('VivaelDiseño2025!'),
                'status' => 1,
            ],
            [
                'nombre' => 'Kevin',
                'apellido' => 'Gutierrez',
                'email' => 'kguitierrez@outlook.com',
                'password' => Hash::make('soyunSamurai2025!'),
                'status' => 1,
            ],
        ]);

    }
}
