<?php

namespace App\Http\Controllers;

use JWTAuth;
use Carbon\Carbon;
use App\Models\Usuario;
use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Builder;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function uploadCV(Request $request)
    {
        $usuario = JWTAuth::user();
        $fileNameToStore = 'CV-' . time() . $request->filename->getClientOriginalName();
        $path = $request->file('filename')->storeAs('public/curriculos', $fileNameToStore);
        $usuario->cv = $fileNameToStore;
        $usuario->save();
        return response()->json(['message' => 'CV subido'], 200);
    }
    public function eliminarCV()
    {
        $usuario = JWTAuth::user();
        File::delete($usuario->cv);
        $usuario->cv = null;
        $usuario->save();
        return response()->json(['message' => 'CV eliminado'], 200);
    }
    public function datosPersonales()
    {
        return response()->json(JWTAuth::user(), 200);
    }
    public function postularme(Request $request)
    {
        $usuario = JWTAuth::user();
        if (!$usuario->cv)
            return response()->json(['message' => 'Debes subir tu curriculo para poder postular a los empleos'], 400);
        $vacante = Vacante::where('empresa', $request->clave)->firstOrFail();
        $usuario->postulaciones()->attach($vacante, array('fecha'=>Carbon::now()->toDateString()));
        return response()->json(['message' => 'Te has postulado al empleo'], 200);        
    }

    public function postulados(Request $request)
    {
        $usuarioQuery = Usuario::query();
        $usuarioQuery->has('postulaciones');

        if ($request->empresa != 'undefined')
            $usuarioQuery->whereHas('postulaciones', function (Builder $query) use ($request) {
                $query->Empresa($request->empresa);
            });
        if ($request->fecha_postulacion)
            $usuarioQuery->whereHas('postulaciones',function (Builder $query) use ($request) {
                $query->where('fecha',$request->fecha_postulacion);
            });
        if ($request->edad)
            $usuarioQuery->where('edad', $request->edad);
        if ($request->sexo != 'Indistinto')
            $usuarioQuery->where('sexo', $request->sexo);


        $postulantes = $usuarioQuery->get();
        return response()->json($postulantes, 200);
    }
}
