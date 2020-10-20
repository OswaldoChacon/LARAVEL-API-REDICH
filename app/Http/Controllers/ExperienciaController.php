<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienciaRequest;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use JWTAuth;

class ExperienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuario = JWTAuth::user();
        $experiencias = $usuario->experiencias()->get();
        return response()->json($experiencias, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExperienciaRequest $request)
    {
        //        
        $usuario = JWTAuth::user();
        $nuevaExperiencia = new Experiencia();
        $nuevaExperiencia->fill($request->all());                
        // $usuario->experiencias()->associate($nuevaExperiencia);
        $nuevaExperiencia->usuario()->associate($usuario);
        $nuevaExperiencia->save();
        return response()->json(['message'=>'Experiencia registrada'], 201);
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
    public function update(ExperienciaRequest $request, Experiencia $experiencia)
    {
        //
        $experiencia->fill($request->all());
        $experiencia->save();
        return response()->json(['message'=>'Experiencia actualizada'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experiencia $experiencia)
    {
        //
        $experiencia->delete();
        return response()->json(['message'=>'Experiencia eliminada'], 200);
    }
}
