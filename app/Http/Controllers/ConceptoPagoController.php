<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use App\Models\Concepto;
use App\Models\ConceptosPago;
use App\Models\Local;
use App\Models\Nivel;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Double;

class ConceptoPagoController extends Controller
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
            'id_anio'=>'required | min:1',
            'concepto'=>'required | min:1',
            'nivel'=>'required | min:1',
            'local'=>'required | min:1',
            //'fecha_vencimiento'=>'required | date | min:10',
            'monto'=>'required | min:1 ',
        ]);
        
        $id_nivel = $request->input('nivel','0');
        
        $id_local = $request->input('local','0');

        
        $anio = AnioAcademico::find($request->input('id_anio'));
        $concepto = Concepto::find($request->input('concepto'));
        $nivel = ($id_nivel=="0")? null: Nivel::where('MP_NIV_NIVEL', $id_nivel)->first();
        $local = ($id_local=="0")? null:Local::find($id_local);
        $monto = (Double)$request->input('monto');

        //return $concepto;
        //return ConceptosPago::first();
        
        if($anio && $concepto && $monto){
            
            // Evitando duplicidades (Buscando conceptos de pago)
            $conceptoPago = ConceptosPago::where('MP_CON_ID',$concepto->MP_CON_ID)
            ->where('MP_ANIO_ID',$anio->MP_ANIO_ID)
            ->where('MP_NIV_ID',($nivel)? $nivel->MP_NIV_ID :null)
            ->where('MP_LOC_ID',($local)? $local->MP_LOC_ID :null)->first();

/*
            return ["anio" =>$anio, 
            "concepto" =>$concepto, 
            "nivel" =>$nivel, 
            "local" =>$local, 
            "monto" =>$monto, 
            "conceptoPago" =>$conceptoPago]; 
*/

            if(!$conceptoPago){    
                //return $conceptoPago;
                $cPago =  new ConceptosPago();
                $cPago->MP_CON_ID=$concepto->MP_CON_ID;
                $cPago->MP_ANIO_ID=$anio->MP_ANIO_ID;
                $cPago->MP_NIV_ID=($nivel)? $nivel->MP_NIV_ID :null;
                $cPago->MP_LOC_ID=($local)? $local->MP_LOC_ID :null;
                $cPago->MP_CONPAGO_MONTO=$monto;
                $cPago->save();
                /* 
                return ["anio" =>$anio, 
                "concepto" =>$concepto, 
                "nivel" =>$nivel, 
                "local" =>$local, 
                "monto" =>$monto, 
                "conceptoPago" =>$conceptoPago,
                "cPago"=>$cPago]; 
                */

            }
            
        }
        return back();
        

        //$request->input('fecha_vencimiento'),
        //str_replace('-','',$request->input('fecha_vencimiento')),=


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
        //
        $request->validate([
            'id_concepto_pago' => 'required | min:1',
            'monto' => 'required | min:1 | numeric',
        ]);

        $conceptoPago = ConceptosPago::find($request->input('id_concepto_pago'));

        if($conceptoPago){
            $monto = (Double) $request->input('monto');
            $conceptoPago->MP_CONPAGO_MONTO = $monto;
            $conceptoPago->save();
        }
        return back();
    }

    
    public function destroy($id)
    {
        $conceptoPago = ConceptosPago::find($id);

        if( $conceptoPago){

            // Buscando pagos realizados
            $existeCronograma = DB::table('MP_CRONOGRAMAPAGO')->where('MP_CONPAGO_ID', $conceptoPago->MP_CONPAGO_ID)->first();
            $existePago = DB::table('MP_PAGO')->where('MP_CONPAGO_ID', $conceptoPago->MP_CONPAGO_ID)->first();

            //return ["existeCronograma"=> $existeCronograma, "existePago"=> $existePago];
            if(!($existeCronograma || $existePago))            
                $conceptoPago->delete();
            else
                echo '<script> alert( "Error, ya se ha registrado pagos con este concepto" ); <script>';

        }

            return back();
    }
}
