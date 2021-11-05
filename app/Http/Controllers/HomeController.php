<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use App\Models\Concepto;
use App\Models\ConceptosPago;
use App\Models\Grado;
use App\Models\Local;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Vacante;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function anioAcademico(){
        $anios= AnioAcademico::orderBy('MP_ANIO_ID','DESC')->take(10)->get();
        //return $anios; 
        return view('index_anio_academico')->with('anios',$anios);
    }
    public function vacantes($id_anio=null){

        //return $id_anio;
        
        $anios = AnioAcademico::where('MP_ANIO_ESTADO','VIGENTE')->get();
        $anio=null;
        

        if(count($anios)==1)
                $anio= $anios[0];

        if($id_anio || $anio ){
            
            $anio=($anio)?$anio:AnioAcademico::where('MP_ANIO_ID', $id_anio)->first();
            if($anio){
                $nivel= Nivel::all();
                $grado = Grado::all();
                $secciones = Seccion::all();
                $locales = Local::all();

                $vacantes = Vacante::where('MP_ANIO_ID',$anio->MP_ANIO_ID)
                                    ->where('MP_VAC_OBS',null)
                                    ->orderBy('MP_GRAD_ID')->get();
                //return $vacantes; 


                return view('index_vacantes')->with('anios',$anios)
                                            ->with('anio',$anio)
                                            ->with('niveles',$nivel)
                                            ->with('grados',$grado)
                                            ->with("locales",$locales)
                                            ->with('secciones',$secciones)
                                            ->with('vacantes',$vacantes);
            }
            echo ("<script>alert('No se encontro el año solicitado');</script>");
        }
        return view('index_vacantes')->with('anios',$anios);
        
    }
    public function conceptosPago($id_anio=null){
        
        $aniosActivos = AnioAcademico::where('MP_ANIO_ESTADO','VIGENTE')->get();

        if($id_anio){
            $anio = AnioAcademico::where('MP_ANIO_ID', $id_anio)->first();
            $conceptosPago = ConceptosPago::where('MP_ANIO_ID',$id_anio)->get();
            $conceptos = Concepto::all();
            $niveles = Nivel::all();
            $locales = Local::all();
            //return $conceptos;
            return view('index_conceptos')->with('anios', $aniosActivos)
                                          ->with('anio',$anio)
                                          ->with('conceptosPago',$conceptosPago)
                                          ->with('conceptos',$conceptos)
                                          ->with('niveles',$niveles)
                                          ->with('locales',$locales);
        }

        return view('index_conceptos')->with('anios', $aniosActivos);
    }

}
