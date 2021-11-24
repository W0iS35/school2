<?php

namespace App\Http\Controllers;

use App\Models\ConceptosPago;
use App\Models\CronogramaPago;
use App\Models\Matricula;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::first(); 
        return response()->json(['pagos'=>$pagos],201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        /**************************** Data a generar ****************************
            fecha de pago
        *   nro de pago 
            observaciones 
        *   serie de comprobante  
            usuario id
            monto
            serie de pago
        *   fecha de emision es nulo cuando el pago es en efectivo ** 
                ******************
                    cronograma id
                    matricula id
                    lee monto
                ******************
        **************************** Data a recibir ****************************
            dni_alumno
            concepto_pago
            tipo_pago
            pago_banco
            numero_operacion
            fecha_operacion
            fecha_pago
            tipo_comprobante
        */

        // Validando los datos 
        /*
            $request->validate([
                'concepto_pago'=> 'required',
                'dni_alumno'=> 'required',
                'fecha_pago'=> 'required',
                'matricula_id'=> 'required',
                'pago_banco'=> 'required',
                'tipo_comprobante'=> 'required',
                'tipo_pago'=> 'required',
                'tipo_comprobante'=> 'required | min:1'
            ]);
        */

        // Validaciones
        $matricula = Matricula::where('MP_MAT_ID',$request->input('matricula_id',-1))
                                ->first();

        $conceptoPago = ConceptosPago::where('MP_CONPAGO_ID', $request->input('concepto_pago',-1))
                                        ->first();
                                        
        $cronograma = CronogramaPago::where('MP_CRO_ID', $request->input('cronograma_id', -1))
                                        ->first();

        if($matricula && ($conceptoPago || $cronograma)){
            //$cronograma,$conceptoPago, $matricula
            
            // Verificando si ya se pago el concepto del cronograma
            if($cronograma){
                if($cronograma->MP_CRO_ESTADO!="PENDIENTE"){
                    return response()->json([
                        "ok"=>false,
                        "msg"=>"El cronograma de pagos para el concepto de ".$cronograma->conceptoPago->concepto->MP_CON_CONCEPTO." ya esta cancelado.",
                        "data"=>$request->all()]
                        ,402);
                    }
                }

            $pago = new Pago();
            //$fecha_pago  = Date('y-m-d h:i:s');
            //$fecha_pago  = Date('y-m-d h:i:s');
            //$pago-> MP_PAGO_ID: "103858",
            
            // Generando numero de pago
            $ultimoPago = Pago::orderBy('MP_PAGO_NRO', 'desc')->first();
            $numeroGenerado = ($ultimoPago)? ((int)$ultimoPago->MP_PAGO_NRO)+1:3;
            
            //$pago->MP_PAGO_FECHA="2021-10-13 10:01:36.000";
            $pago->MP_PAGO_FECHA=str_replace("-","",$request->input('fecha_pago'));
            $pago->MP_PAGO_NRO=$numeroGenerado;
            $pago->MP_PAGO_OBS="";
            $pago->MP_TIPCOM_ID=$request->input('tipo_comprobante');
            
            $pago->MP_MAT_ID=$matricula->MP_MAT_ID;
            $pago->USU_ID=Auth::user()->USU_ID;
            $pago->MP_SERCOM_ID=Auth::user()->serieUsuario->MP_SERCOM_ID;
            $pago->MP_PAGO_SERIE=(Auth::user()->serieComprobante)?Auth::user()->serieComprobante->MP_SERCOM_NOMBRE:"YYYY";


            $montoTemp= -1; 
            if($cronograma){
                $pago->MP_CRO_ID=$cronograma->MP_CRO_ID;
                $pago->MP_CONPAGO_ID=null;
                
                $montoTemp= $cronograma->MP_CRO_MONTO;
            }
            else{
                $pago->MP_CRO_ID=null;
                $pago->MP_CONPAGO_ID=$conceptoPago->MP_CONPAGO_ID;
                
                $montoTemp= $conceptoPago->MP_CONPAGO_MONTO;
            }

            $pago->MP_PAGO_MONTO=$montoTemp;
            $pago->MP_PAGO_LEE_MONTO="leendo......";

            
            // Si es tipo de pago en efectivo
            $tipoPagoTemp=$request->input('tipo_pago',1);
            if($tipoPagoTemp=="1"){
                $pago->BANCO=  null;
                $pago->MP_PAGO_FECHAEMISION=null;
                $pago->NUMERO_OPERACION=null;
            }
            else
            if($tipoPagoTemp=="2"){

                // Validacion de pago bancario ...........
                $fechaOperacion = $request->input('fecha_operacion');
                $numeroOperacion = $request->input('numero_operacion');

                
                if(strlen($numeroOperacion)<3){
                    $error = true;
                    $msg = "";
                    
                    return response()->json([
                        "ok"=>false,
                        "msg"=>"El numero de operacion esta vacio o incompleto"]
                        ,402);
                }

                // Buscando transacciones con ese numero de operacion
                $operacionDuplicada = Pago::where('NUMERO_OPERACION', $numeroOperacion)->first();
                if($operacionDuplicada){
                    return response()->json([
                        "ok"=>false,
                        "msg"=>"Operacion duplicada, el numero de operacion ya ha sido registrado en otros pagos",
                        "pagoDuplicadoo"=> $operacionDuplicada ,
                        "data"=>$request->all()]
                        ,402);
                    }

                $error = false;
                $msg = "";

                if(!$fechaOperacion){
                    $error = true;
                    $msg = "La fecha de operacion no puede ser nula";
                }

                if(strlen($fechaOperacion)!==10){
                    $error = true;
                    $msg = "La fecha de operacion esta incompleta";
                }

                if($error){
                    return response()->json([
                        "ok"=>false,
                        "msg"=> $msg,
                        "data"=>$request->all()]
                        ,402);
                }

                $pago->BANCO=$request->input('pago_banco');
                $pago->MP_PAGO_FECHAEMISION=str_replace("-","",$fechaOperacion);
                $pago->NUMERO_OPERACION=$numeroOperacion;

                }
                
                $pago->MP_PAGO_NRO_NC=null;
                $pago->save();

                //return $pago;
                if($cronograma){
                    $cronograma->MP_CRO_ESTADO = 'CANCELADO';
                    $cronograma->save();
                }
            // Enviando respuesta...
            return response()->json([
                "ok"=>true,
                "msg"=>"Se registro el pago correctamente",
                "pago"=> $pago,
                "data-filtrada"=>[$cronograma,$conceptoPago, $matricula],
                "data"=>$request->all()]
                ,201);
        }
        return response()->json([
            "ok"=>false,
            "msg"=> "ERROR: No se encuentra la matricula, cronograma o concepto",
            "data"=>$request->all() ]
            ,402);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
