<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use Illuminate\Http\Request;

class AnioAcademicoController extends Controller
{

    public function index()
    {
        //
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {     
        $request->validate([
            "nombre"=>"required | string | min:3",
            "descripcion"=>"required | string | min:3",
            "fechaInit"=>"required | date",
            "fechaFin"=>"required | date",
            "estado" => "required"
        ]);

        $anioAcademico = new AnioAcademico();
        
        $anioAcademico->MP_ANIO_FECHAINICIO=str_replace("-","",$request->input('fechaInit'));
        $anioAcademico->MP_ANIO_FECHAFIN= str_replace("-","",$request->input('fechaFin'));
        $anioAcademico->MP_ANIO_DESCRIPCION=$request->input('descripcion');
        $anioAcademico->MP_ANIO_NOMBRE=$request->input('nombre');
        $anioAcademico->MP_ANIO_ESTADO=$request->input('estado');

        //return $anioAcademico;
        $anioAcademico->save();

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        $request->validate([
            "descripcion"=>"required | string | min:3",
            "nombre"=>"required | string | min:3",
            "fechaInit"=>"required | date",
            "fechaFin"=>"required | date",
            "estado" => "required",
            "id_anio" => 'required | min:1'
        ]);

        $anioAcademico = AnioAcademico::where('MP_ANIO_ID',$request->input('id_anio'))->first();
        
        if($anioAcademico){        
            $anioAcademico->MP_ANIO_FECHAINICIO=str_replace("-","",$request->input('fechaInit'));
            $anioAcademico->MP_ANIO_FECHAFIN= str_replace("-","",$request->input('fechaFin'));
            $anioAcademico->MP_ANIO_DESCRIPCION=$request->input('descripcion');
            $anioAcademico->MP_ANIO_NOMBRE=$request->input('nombre');
            $anioAcademico->MP_ANIO_ESTADO=$request->input('estado');

            //return $anioAcademico;
            $anioAcademico->save();
        }
        //return $anioAcademico;
        return back();
    }

    
    public function destroy($id)
    {

    }

}
