<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AnioAcademico;
use App\Models\Concepto;
use App\Models\ConceptosPago;
use App\Models\CronogramaPago;
use App\Models\Grado;
use App\Models\Local;
use App\Models\Nivel;
use App\Models\Pago;
use App\Models\Seccion;
use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $year = date('Y'); 
        
        $locales = Local::all();
        $niveles = Nivel::all();
        $anioActual = AnioAcademico::where("MP_ANIO_NOMBRE", $year)->first();
        $conceptosPago =  ConceptosPago::where("MP_ANIO_ID", $anioActual->MP_ANIO_ID)->get();


        return view('index')->with("locales", $locales)
                            ->with("niveles", $niveles)
                            ->with('anioActual', $anioActual)
                            ->with('conceptosPago', $conceptosPago);
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

    
    
/*********************** Begin: Modulo de facturacion ************************************/
    public function facturacion_pagos(){

        
        $year = date('Y'); 
        $anioActual = AnioAcademico::where("MP_ANIO_NOMBRE", $year)->first();
        //return $anioActual;

        return view('index_pagos_facturacion')->with('anio',$anioActual);
    }
    
    /*********************** End: Modulo de facturacion ************************************/
    
    
    /*********************** Begin: API ************************************/
    public function getDashboard($id_anio, $id_local=null,  $id_nivel=null){
        $vacantes =[];
        if($id_local && $id_nivel){
            $anio = AnioAcademico::where("MP_ANIO_ID",$id_anio)->first();
            
            $vacantes =  $anio->vacantes->where('MP_VAC_OBS','!=', '-1')
            ->where('MP_NIV_ID', $id_nivel)
            ->where('MP_LOC_ID', $id_local);
            
        }
        return response()->json($vacantes);
    }


    public function getInfoAlumno($dni , $id_anio){
        $response = [];
        if($dni && $id_anio){
            $alumno = Alumno::where('MP_ALU_DNI', $dni)->get()->first();
            $anio = AnioAcademico::where('MP_ANIO_ID', $id_anio)->get()->first();

           
            //return ["alumno"=> $alumno, "anio"=> $anio, "vacante"=> $vacante, "conceptosPago"=> $conceptosPago, "cronograma"=>$cronograma];

            
            if($alumno && $anio){
                $vacante = [];
                $cronograma= [];
                $conceptosPago = [];
                $otrosPagos = [];
                $deudas_pendientes=[];
                $alumno_cursando = true;

                $matriculas = $alumno->matricula;

                if($matriculas){
                    
                    $vacante = null; 
                    $matricula= null;

                    foreach($matriculas as $matriculaIterador){
                        // Verificando si el alumno esta matriculado en el anio actual (si el alumno esta matriculado, habra vacante )
                        if($matriculaIterador->vacante->MP_ANIO_ID == $anio->MP_ANIO_ID){
                            $matricula= $matriculaIterador;
                            $vacante = $matriculaIterador->vacante;
                        }
                        else{
                            
                            $cronogramasPendientes = CronogramaPago::join('MP_CONCEPTOPAGO', 'MP_CRONOGRAMAPAGO.MP_CONPAGO_ID', '=', 'MP_CONCEPTOPAGO.MP_CONPAGO_ID')
                            ->join('MP_CONCEPTO', 'MP_CONCEPTOPAGO.MP_CON_ID', '=', 'MP_CONCEPTO.MP_CON_ID')
                            ->where('MP_MAT_ID',$matriculaIterador->MP_MAT_ID)
                            ->where('MP_CRO_ESTADO', 'PENDIENTE')->get();

                        
                            //->select(["MP_CRO_ID as id_cronograma","MP_MAT_ID", "MP_CRO_ESTADO", "MP_CRO_TIPODEUDA", "MP_CRO_MONTO", "MP_ANIO_ID","MP_CON_CONCEPTO" ])

                            $deudas_pendientes = [...$deudas_pendientes, ...$cronogramasPendientes];
                        }
                    }
                    //return $deudas_pendientes;
                    //Si el alumno no se encuentra matriculado en el año actua, matricula y vacante seran iguales al ultimo anio de estudios 
                    if(!$vacante){
                        $vacante = $matriculas[0]->vacante; 
                        $matricula= $matriculas[0];
                        $alumno_cursando = false;
                        //return $vacante;
                    }

                    $cronograma =   CronogramaPago::join('MP_CONCEPTOPAGO', 'MP_CRONOGRAMAPAGO.MP_CONPAGO_ID', '=', 'MP_CONCEPTOPAGO.MP_CONPAGO_ID')
                                             ->join('MP_CONCEPTO', 'MP_CONCEPTOPAGO.MP_CON_ID', '=', 'MP_CONCEPTO.MP_CON_ID')
                                             ->where("MP_MAT_ID",$matricula->MP_MAT_ID)
                                            ->select(["MP_CRO_ID as id_cronograma","MP_MAT_ID", "MP_CRO_ESTADO", "MP_CRO_TIPODEUDA", "MP_CRO_MONTO", "MP_ANIO_ID","MP_CON_CONCEPTO" ])
                                             ->get();
                      
                     $query = "
                             select	cp.MP_CONPAGO_ID as 'id_conceptoPago', cp.MP_CONPAGO_MONTO as 'monto',
                                    c.MP_CON_ID as 'id_concepto', c.MP_CON_CONCEPTO as 'concepto_nombre',
                                    c.MP_TIPO_CON_ID as 'id_tipo', t.MP_TIPO_CON_DESC as  'tipo_concepto'
                             from MP_CONCEPTOPAGO cp inner join MP_CONCEPTO c 
                             on cp.MP_CON_ID = c.MP_CON_ID
                                 inner join MP_TIPO_CONCEPTO t on c.MP_TIPO_CON_ID =t.MP_TIPO_CON_ID 
                                 where cp.MP_ANIO_ID = ? 
                                      and (cp.MP_NIV_ID is null or cp.MP_NIV_ID= ?)
                                      and (cp.MP_LOC_ID is null or cp.MP_LOC_ID= ?)
                                      and t.MP_TIPO_CON_ID !=1

                     ";

                     
                     // Orden: anio_id, nivel_id, local_id
                     $conceptosPago = DB::select($query,  [ ($alumno_cursando? $vacante->MP_ANIO_ID: $anio->MP_ANIO_ID ),$vacante->MP_NIV_ID,$vacante->MP_LOC_ID]);  
                    //return ["alumno"=> $alumno, "anio"=> $anio, "vacante"=> $vacante, "conceptosPago"=> $conceptosPago, "cronograma"=>$cronograma];
                    


                    $otrosPagos = Pago::join('MP_CONCEPTOPAGO', 'MP_PAGO.MP_CONPAGO_ID', '=', 'MP_CONCEPTOPAGO.MP_CONPAGO_ID')
                                                      ->join('MP_CONCEPTO', 'MP_CONCEPTOPAGO.MP_CON_ID', '=', 'MP_CONCEPTO.MP_CON_ID')
                                                      ->where('MP_PAGO.MP_CRO_ID',null)
                                                      ->where('MP_PAGO.MP_MAT_ID', $matricula->MP_MAT_ID)
                                                      ->select(['MP_PAGO_ID', 'MP_PAGO_FECHA', 'MP_PAGO_NRO','MP_TIPCOM_ID', 'MP_CON_CONCEPTO', 'MP_CONPAGO_MONTO', 'MP_PAGO_LEE_MONTO'])
                                                      ->get();
                                                      
                    $response = [
                        "alumno" => [
                            "id"=>$alumno->MP_ALU_ID,
                            "nombres"=>$alumno->MP_ALU_NOMBRES,
                            "apellidos"=>$alumno->MP_ALU_APELLIDOS,
                            "dni"=>$alumno->MP_ALU_DNI,
                            "sexo"=>$alumno->MP_ALU_SEXO,
                        ],
                        "matricula"=> $matricula?[
                            "matricula_id"=>$matricula->MP_MAT_ID,
                            "estado_id"=>$matricula->MP_MAT_ESTADO,
                            "situacion_id"=>$matricula->MP_MAT_SITUACION,

                            "local_id"=>$vacante->MP_LOC_ID,
                            "vacante_id"=>$vacante->MP_VAC_ID,
                            "nivel_id"=>$vacante->MP_NIV_ID,
                            "anio_id"=>$vacante->MP_ANIO_ID,
                            "grado_id"=>$vacante->MP_GRAD_ID,
                            "seccion_id"=>$vacante->MP_SEC_ID
                        ]:[],
                        "cronograma"=>$cronograma,
                        "conceptosPago"=>$conceptosPago,
                        "otrosPagos"=> $otrosPagos,
                        "deudasPendientes"=>$deudas_pendientes,
                        "cursando"=>$alumno_cursando,
                    ];                 
                }   
                //else
                //    return ["alumno"=> $alumno, "anio"=> $anio, "vacante"=> $vacante];
                return response()->json([
                    "ok"=>true,
                    "data"=>$response
                ],200);
            }
            
            return response()->json([
                "ok"=>false,
                "msg"=> "ERROR: No se encuentra ningun alumno registrado con el dni: "+$dni]
                ,400);
        }
        return response()->json([
            "ok"=>false,
            "msg"=> "ERROR: Falta de parametros (DNI / Año academico) "]
            ,400);
    }

    /*********************** End: API ************************************/
    
    
    /*********************** Begin: Error 404 ************************************/
    public function error404(){
        return view('error404');
    }
    /*********************** End: Error 404 ************************************/
}






