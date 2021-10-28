<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use App\Models\Vacante;
use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;

class VacantesController extends Controller
{
    //
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
            "id_anio" => 'required | min:1'
        ]);

        return $request->all();

        $anioAcademico = AnioAcademico::where('MP_ANIO_ID',$request->input('id_anio'))->first();

        foreach ($request->all() as $key => $value) {
            if(strlen($key)==10 && substr($key,0,4)=="CODE" && substr($key,5,1)=="C" && $value="on" ){
                //CODE1C1:12
                //"CODE1C1:11": "on"
                //CODE{{$nivel->MP_NIV_ID}}C{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}
                $id_nivel = substr($key,4,1);
                $id_local = substr($key,6,1);
                $id_grado = substr($key,8,1);
                $id_seccion = substr($key,9,1);
                
                //CODE1V1:11
                //"CODE1V1:11": "0",
                $codeCantVacantes = "CODE".$id_nivel."V".$id_local.":".$id_grado.$id_seccion ;
                
                $vacante =  new Vacante();
                $vacante->MP_ANIO_ID =$anioAcademico->MP_ANIOACADEMICO;
                //$vacante->MP_ANIO_ID =666;
                $vacante->MP_LOC_ID =$id_local;
                $vacante->MP_NIV_ID =$id_nivel;
                $vacante->MP_GRAD_ID =$id_grado;
                $vacante->MP_SEC_ID =$id_seccion;
                $vacante->MP_VAC_TOT =$request->input($codeCantVacantes);
                $vacante->MP_VAC_OCU = 0;
                $vacante->MP_VAMP_VAC_DISP =0; 
                $vacante->save();
                //array_push($vacantes, $vacante);
             //   array_push($codigos, [$codeCantVacantes=>$request->input($codeCantVacantes)]);
            }
        }
        


        /*

                                        <td class="text-uppercase ">{{$vacante->MP_VAC_TOT}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_VAC_OCU}}</td>
                                        <td class="text-uppercase ">{{$vacante->MP_VAMP_VAC_DISP}}</td>

        $vacantes = [];
        //$codigos = [];

        foreach ($request->all() as $key => $value) {
            if(strlen($key)==10 && substr($key,0,4)=="CODE" && substr($key,5,1)=="C" && $value="on" ){
                //CODE1C1:12
                //"CODE1C1:11": "on"
                //CODE{{$nivel->MP_NIV_ID}}C{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}
                $id_nivel = substr($key,4,1);
                $id_local = substr($key,6,1);
                $id_grado = substr($key,8,1);
                $id_seccion = substr($key,9,1);
                
                //CODE1V1:11
                //"CODE1V1:11": "0",
                $codeCantVacantes = "CODE".$id_nivel."V".$id_local.":".$id_grado.$id_seccion ;
                
                $vacante =  new Vacante();
                $vacante->MP_ANIO_ID =$anioAcademico->MP_ANIOACADEMICO;
                //$vacante->MP_ANIO_ID =666;
                $vacante->MP_LOC_ID =$id_local;
                $vacante->MP_NIV_ID =$id_nivel;
                $vacante->MP_GRAD_ID =$id_grado;
                $vacante->MP_SEC_ID =$id_seccion;
                $vacante->MP_VAC_TOT =$request->input($codeCantVacantes);
                $vacante->save();
                array_push($vacantes, $vacante);
             //   array_push($codigos, [$codeCantVacantes=>$request->input($codeCantVacantes)]);
            }
        }

        */

        return back();
    }

    public function masivo(Request $request)
    {     
        $request->validate([
            "id_anio" => 'required | min:1'
        ]);


        $anioAcademico = AnioAcademico::where('MP_ANIO_ID',$request->input('id_anio'))->first();

        if($anioAcademico){
            foreach ($request->all() as $key => $value) {
                if(strlen($key)==10 && substr($key,0,4)=="CODE" && substr($key,5,1)=="C" && $value="on" ){
                    //"CODE1C1:11": "on"
                    $id_nivel = substr($key,4,1);
                    $id_local = substr($key,6,1);
                    $id_grado = substr($key,8,1);
                    $id_seccion = substr($key,9,1);
                    
                    $codeCantVacantes = "CODE".$id_nivel."V".$id_local.":".$id_grado.$id_seccion ;
                    
                    $vacante =  new Vacante()
                    ;
                    $vacante->MP_ANIO_ID =$anioAcademico->MP_ANIO_ID;
                    $vacante->MP_LOC_ID =$id_local;
                    $vacante->MP_NIV_ID =$id_nivel;
                    $vacante->MP_GRAD_ID =$id_grado;
                    $vacante->MP_SEC_ID =$id_seccion;
                    $vacante->MP_VAC_TOT =$request->input($codeCantVacantes);
                    $vacante->MP_VAC_OCU = 0;
                    $vacante->MP_VAC_DISP =$request->input($codeCantVacantes);; 
                    $vacante->save();
                }
            }
        }
        else
            echo "<script> alert('Error en carga masiva, no se encontro el año academico') </script>";
        return back();
    }

    public function show($id_anio)
    {
        $vacantes = Vacante::where('MP_ANIO_ID',$id_anio)->get();
        //return $vacantes;
        return response()->json($vacantes);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request)
    {
        /*
        
            $vacantes =Vacante::where('MP_ANIO_ID', $anioAcademico->MP_ANIO_ID);            

    $vacantesActualizadas = [];
    $vacantesNuevas = [];
            
            $vacantesActuales=[];

            foreach ($request->all() as $key => $value) {
                if(strlen($key)==10 && substr($key,0,4)=="EDIT" && substr($key,5,1)=="C" && $value="on" ){
                    //CODE1C1:12
                    //"EDIT1C1:11": "on"
                    //CODE{{$nivel->MP_NIV_ID}}C{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}

                    $id_nivel = substr($key,4,1);
                    $id_local = substr($key,6,1);
                    $id_grado = substr($key,8,1);
                    $id_seccion = substr($key,9,1);

                    //EDIT1V1:11
                    $codeCantVacantes = "CODE".$id_nivel."V".$id_local.":".$id_grado.$id_seccion ;
                    
                    // Buscando vacante
                    $vacanteMod = Vacante::where('MP_LOC_ID',$id_local)
                                        ->where('MP_NIV_ID',$id_nivel)
                                        ->where('MP_ANIO_ID',$anioAcademico->MP_ANIO_ID)
                                        ->where('MP_GRAD_ID',$id_grado)
                                        ->where('MP_SEC_ID',$id_seccion)
                                        ->first();
                    
                    //Validaciones de negocio

                    if($vacanteMod){
                        $vacanteMod->MP_ANIO_ID =$anioAcademico->MP_ANIOACADEMICO;
                        //$vacante->MP_ANIO_ID =666;
                        $vacanteMod->MP_LOC_ID =$id_local;
                        $vacanteMod->MP_NIV_ID =$id_nivel;
                        $vacanteMod->MP_GRAD_ID =$id_grado;
                        $vacanteMod->MP_SEC_ID =$id_seccion;
                        $vacanteMod->MP_VAC_TOT =$request->input($codeCantVacantes);
                        $vacanteMod->save();
                        
                        array_push($vacantesActualizadas, $vacanteMod);
                    }
                    else{
                        $vacanteMod =  new Vacante();
                        $vacanteMod->MP_ANIO_ID =$anioAcademico->MP_ANIOACADEMICO;
                        //$vacante->MP_ANIO_ID =666;
                        $vacanteMod->MP_LOC_ID =$id_local;
                        $vacanteMod->MP_NIV_ID =$id_nivel;
                        $vacanteMod->MP_GRAD_ID =$id_grado;
                        $vacanteMod->MP_SEC_ID =$id_seccion;
                        $vacanteMod->MP_VAC_TOT =$request->input($codeCantVacantes);
                        $vacanteMod->save();

                        array_push($vacantesNuevas, $vacanteMod);
                    }

                    // Creando un array de vacantes que no seran eliminadas...
                    array_push($vacantesActuales, $vacanteMod->MP_VAC_ID);

                    

                }
            }
        }
        
        return ["Actualizadas"=>$vacantesActualizadas,"Nuevas"=> $vacantesNuevas] ;
        
        */


    }

    
    public function destroy($id)
    {

    }
}
