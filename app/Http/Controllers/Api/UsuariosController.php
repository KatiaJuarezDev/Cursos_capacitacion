<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class usuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuarios::all();

        //if($usuarios->isEmpty()){
        //    $data = [
        //        'message' => 'No se encontraron usuarios',
        //        'status' => 200
        //    ];
        //    return response()->json($data, 404);
        //}

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
            'tipo_usuario' => 'required'
        ]);
        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuarios::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'tipo_usuario' => $request->tipo_usuario
        ]);

        if(!$usuario){
            $data = [
                'message' => 'Error al crear el usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'message' => $usuario,
            'status' => 201
        ];

        return response()->json($data, 201);
    }

    public function show($id)
    {
        $usuario = Usuarios::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    public function destroy($id)
    {
        $usuario = Usuarios::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $usuario->delete();

        $data = [
            'message' => 'Usuario eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuarios::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
            'tipo_usuario' => 'required'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        $usuario->nombre = $request->nombre;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        $usuario->tipo_usuario = $request->tipo_usuario;

        $usuario->save();
        $data = [
            'message' => 'Usuario actualizado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $Request, $id)
    {
        $usuario = Usuarios::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($Request->all(), [
            'nombre' => 'max:255',
            'email' => 'email|unique:usuarios',
            'password' => 'string',
            'tipo_usuario' => 'string'
        ]);

        if($validator->fails()){
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        if($Request->has('nombre')){
            $usuario->nombre = $Request->nombre;
        }
        if($Request->has('email')){
            $usuario->email = $Request->email;
        }
        if($Request->has('password')){
            $usuario->password = $Request->password;
        }
        if($Request->has('tipo_usuario')){
            $usuario->tipo_usuario = $Request->tipo_usuario;
        }
        $usuario->save();

        $data = [
            'message' => 'Usuario actualizado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
