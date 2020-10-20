<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacanteRequest;
use App\Models\Requisito;
use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $vacantesQuery = Vacante::query();
        if($request->salario)
            $vacantesQuery->Sueldo($request->salario);
        $vacantes = $vacantesQuery->with('requisitos')->where('activo',true)->paginate(3);
        return response()->json($vacantes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacanteRequest $request)
    {
        //        
        // dd($request->requisitos);
        $nuevaVacante = new Vacante();
        $nuevaVacante->fill($request->all());
        // $nuevaVacante->requisitos =json_encode($request->requisitos);
        $nuevaVacante->save();
        foreach ($request->requisitos as $requisito) {            
            $nuevaVacante->requisitos()->create($requisito);
        }        
        return response()->json(['message' => 'Vacante registrado'], 201);
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
}
