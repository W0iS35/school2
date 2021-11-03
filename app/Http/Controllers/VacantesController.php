<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use App\Models\Grado;
use App\Models\Local;
use App\Models\Nivel;
use App\Models\Seccion;
use App\Models\Vacante;
use Illuminate\Http\Request;

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
            "id_anio" => 'required | min:1',
            "local_id" => 'required | min:1',
            "nivel_id" => 'required | min:1',
            "grado_id" => 'required | min:1',
            "seccion_id" => 'required | min:1',
            "numero_vacantes" => 'required | min:1'
        ]);

        $anioAcademico = AnioAcademico::where('MP_ANIO_ID',$request->input('id_anio'))->first();
        if($anioAcademico){
            // Buscando seccion ya creada
            $vacante = Vacante::where('MP_LOC_ID',$request->input('local_id'))
                                ->where('MP_NIV_ID',$request->input('nivel_id'))
                                ->where('MP_ANIO_ID',$request->input('id_anio'))
                                ->where('MP_GRAD_ID',$request->input('grado_id'))
                                ->where('MP_SEC_ID',$request->input('seccion_id'))
                                ->where('MP_VAC_OBS',null)
                                ->get()->first();
            if(!$vacante){
                $vacante = new Vacante();
                $vacante->MP_LOC_ID=$request->input('local_id') ;
                $vacante->MP_NIV_ID= $request->input('nivel_id');
                $vacante->MP_ANIO_ID= $request->input('id_anio');
                $vacante->MP_GRAD_ID= $request->input('grado_id');
                $vacante->MP_SEC_ID= $request->input('seccion_id');
                $vacante->MP_VAC_TOT= (int) $request->input('numero_vacantes');
                $vacante->MP_VAC_DISP= (int) $request->input('numero_vacantes');
                $vacante->MP_VAC_OCU= 0;
                $vacante->save();
            }
            else
                echo "<script> alert('Error, seccion ya se encuentra registrada en el año academico'); </script>";
        }
        else
            echo "<script> alert('Error, no se encuentra el año academico'); </script>";

        return back();

    }

    public function update(Request $request)
    {     
        $request->validate([
            "id_vac" => 'required | min:1',
            "vacantes" => 'required | min:1'
        ]);

        $vacante = Vacante::find($request->input('id_vac'));

        if($vacante){
            $num_vacantes = (int) $request->input('vacantes');
            
            if($num_vacantes>$vacante->MP_VAC_OCU){
                $vacante->MP_VAC_TOT= $num_vacantes;
                $vacante->MP_VAC_DISP= $num_vacantes - $vacante->MP_VAC_OCU;
            }
            else
                echo "<script> alert('Error, el numero de vacantes no puede ser menor al numero de vacantes ocupadas') </script>";
            $vacante->save();
        }
        else
            echo "<script> alert('Error, no se encuentra la seccion a modificar') </script>";

        return back();
    }
    
    public function destroy($id)
    {
        $vacante = Vacante::find($id);
        if($vacante){
            $vacante->MP_VAC_OBS = '-1';
            $vacante->save();
        }
        return back();
    }

    public function masivo(Request $request){
        //return $request->all();

        $anioAcademico = AnioAcademico::find( $request->id_anio);
        //return $anioAcademico;

        $vacantesAgregadas = 0;
        $errores = 0;

        if ($anioAcademico)
            foreach ($request->all() as $key => $value) {
                if(strlen($key)==10 && substr($key,0,4)=="CODE" && substr($key,5,1)=="C" && $value="on" ){
                    //CODE1C1:12
                    //"CODE1C1:11": "on"
                    //CODE{{$nivel->MP_NIV_ID}}C{{$local->MP_LOC_ID}}:{{$grado->MP_GRA_ID}}{{$seccion->MP_SEC_ID}}
                    $id_nivel = substr($key,4,1);
                    $id_local = substr($key,6,1);
                    $id_grado = substr($key,8,1);
                    $id_seccion = substr($key,9,1);

                    
                    $nivel = Nivel::find($id_nivel);
                    $local = Local::find($id_local);
                    $grado = Grado::find($id_grado);
                    $seccion = Seccion::find($id_seccion);
                    
                    //return [$local,$nivel,$grado,$seccion];
                    //CODE1V1:11
                    //"CODE1V1:11": "0",
                    if($nivel && $local && $grado && $seccion){
                            
                        $codeCantVacantes = "CODE".$id_nivel."V".$id_local.":".$id_grado.$id_seccion ;
                        
                        $vacante =  new Vacante();
                        $vacante->MP_ANIO_ID =$anioAcademico->MP_ANIO_ID;
                        $vacante->MP_NIV_ID =$nivel->MP_NIV_ID;
                        $vacante->MP_GRAD_ID =$grado->MP_GRA_ID;
                        $vacante->MP_SEC_ID =$seccion->MP_SEC_ID;
                        $vacante->MP_VAC_TOT =$request->input($codeCantVacantes);
                        $vacante->MP_VAC_OCU = 0;
                        $vacante->MP_VAC_DISP =$request->input($codeCantVacantes);
                        $vacante->MP_LOC_ID =$local->MP_LOC_ID;
                        $vacante->save();
                        $vacantesAgregadas++;
                    }
                    else
                    $errores++;


                    //array_push($vacantes, $vacante);
                //   array_push($codigos, [$codeCantVacantes=>$request->input($codeCantVacantes)]);
                }
            }
            echo('<script> alert("'.$vacantesAgregadas.' vacantes agregadas..") </script>');
            echo('<script> alert("'.$errores.' errores..") </script>');
            return back();
    }

    /*
    
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
    */
}


