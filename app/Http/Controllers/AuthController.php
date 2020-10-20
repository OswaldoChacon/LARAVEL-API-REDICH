<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rol;
use App\Models\Usuario;
// use JWTAuth;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($credenciales))
            return response()->json(['message' => 'Correo o contraseña no válidos'], 404);
        $usuario = JWTAuth::user();
        $usuario->append('admin');
        return response()->json([
            'token' => $token,
            'perfil' => $usuario
        ], 200);
    }
    public function registrar(RegistroRequest $request)
    {        
        $nuevoUsuario = new Usuario();
        $nuevoUsuario->fill($request->all());     
        $nuevoUsuario->password = bcrypt($request->password);
        $nuevoUsuario->edad = Carbon::parse($request->fecha_nacimiento)->age;
        $rol = Rol::where('nombre','Candidato')->firstOrFail();        
        $nuevoUsuario->save();
        $nuevoUsuario->roles()->attach($rol);        
        return response()->json(['message' => 'Registro satisfactorio'], 200);
    }
}
