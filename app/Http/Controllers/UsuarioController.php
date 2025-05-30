<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Exception;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = Usuario::all();

            return response()->json(
                [
                    'message' => 'Lista de usuarios',
                    'data' => $users,
                ],
                200,
            );
        } catch (\Throwable $th) {
            if (env('APP_PRODUCTION', true)) {
                return response()->json(['message' => 'Ocurrio un error, verifica la información o vuelve a intentarlo mas tarde'], 500);
            }
            return response()->json(
                [
                    'message' => 'Ocurrio un error. ',
                    'error' => $th->getMessage(),
                    'line' => $th->getLine(),
                    'trace' => $th->getTrace(),
                ],
                500,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
                        /*$user = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
            'status' =>$request->status ?? 1,
        ]);*/

        $request->validate([
            'nombre' => 'required| string|max:255',
            'apellido' => 'required| string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            //La contaseña tiene una formato de minimo 8 caracteres combinando numeros, letras entre
            //mayusculas y minisculas, ademas de caracteres especiales, ! @ # $ % ^ & * ( ) _ + - = { } [ ] : ; " ' < > , . ? / | \ ~ `

            /* 'password'=> [
            'required',
            'string',
            Password::min(8)->mixedCase()->letters()->numbers()->symbols()
        ]*/
            'password' => 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[\\w\\d]).+$/',
        ]);

        $user = new Usuario([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(!$user->save()) throw new \Exception("Hubo un error al guardar los datos del usuario");
        if(env('DB_LOGS',true)) Helper::logs(request(),$user->id, 'CREATE', $user->id, 'usuarios');

        return response()->json(
            [
                'message' => 'Usuario creado exitosamente.',
                'data' => $user,
            ],
            201,
        );
        } catch (\Throwable $th) {
            if (env('APP_PRODUCTION', true)) {
                return response()->json(['message' => 'Ocurrio un error, verifica la información o vuelve a intentarlo mas tarde'], 500);
            }
            return response()->json(
                [
                    'message' => 'Ocurrio un error. ',
                    'error' => $th->getMessage(),
                    'line' => $th->getLine(),
                    'trace' => $th->getTrace(),
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = Usuario::where('id', $id)->where('status', '=', '1')->firstOrFail();

            if(!$user){
          return response()->json([
            'message' => 'Usuario no encontrado',
          ],404);}

            return response()->json([
                'data' => $user,
            ]);
        } catch (\Throwable $th) {
            if (env('APP_PRODUCTION', true)) {
                return response()->json(['message' => 'Ocurrio un error, verifica la información o vuelve a intentarlo mas tarde'], 500);
            }
            return response()->json(
                [
                    'message' => 'Ocurrio un error. ',
                    'error' => $th->getMessage(),
                    'line' => $th->getLine(),
                    'trace' => $th->getTrace(),
                ],
                500,
            );
        }
    }

    public function filter()
    {

        try {
            //Todos los usuario que esten activos
            $users = Usuario::where('status', '=', '1')->paginate(10);
            return response()->json(
                [
                    'message' => 'Lista de usuarios activos',
                    'data' => $users,
                ],
                200,
            );
        } catch (\Throwable $th) {
            if (env('APP_PRODUCTION', true)) {
                return response()->json(['message' => 'Ocurrio un error, verifica la información o vuelve a intentarlo mas tarde'], 500);
            }
            return response()->json(
                [
                    'message' => 'Ocurrio un error. ',
                    'error' => $th->getMessage(),
                    'line' => $th->getLine(),
                    'trace' => $th->getTrace(),
                ],
                500,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Usuario::where('id', $id)->first();

        if (!$user) {
            return response()->json(
                [
                    'message' => 'Usuario no encontrado',
                ],
                404,
            );
        }

        /* $user->update([
            'nombre'=> $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->paswword): $user->password,
            'status' => $request-> status ?? $user->status
        ]);*/

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente.',
            'data' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Usuario::where('id', $id)->where('status', '=', '1')->first();

        if (!$user) {
            return response()->json(
                [
                    'message' => 'Usuario no encontrado.',
                ],
                404,
            );
        }

        $user->delete();
       // $user->status = 2;
        //$user->save();
        return response()->json([
            'message' => 'Usuario Eliminado exitosamente.',
            'data' => $user,
        ]);
    }
}
