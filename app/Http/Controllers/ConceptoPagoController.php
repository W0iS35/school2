<?php

namespace App\Http\Controllers;

use App\Models\AnioAcademico;
use App\Models\Concepto;
use App\Models\ConceptosPago;
use App\Models\Local;
use App\Models\Nivel;
use Illuminate\Http\Request;
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
            'fecha_vencimiento'=>'required | date | min:10',
            'monto'=>'required | min:1 ',
        ]);

        $anio = AnioAcademico::find($request->input('id_anio'));
        $concepto = Concepto::find($request->input('concepto'));
        $nivel = Nivel::where('MP_NIV_NIVEL', $request->input('nivel'))->first();
        $local = Local::find($request->input('local'));
        $monto = (Double)$request->input('monto');

        $cPago =  new ConceptosPago();
        $cPago->MP_CONPAGO_MONTO=$monto;
        $cPago->MP_CON_ID=$concepto->MP_CON_ID;
        $cPago->MP_NIV_ID=$nivel->MP_CON_ID;


        

        return [$anio, $concepto, $nivel, $local, 
        $request->input('fecha_vencimiento'),
        str_replace('-','',$request->input('fecha_vencimiento')),
        $request->input('monto')
    ];



        return $request->all();
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
        return $request->all();
    }

    
    public function destroy($id)
    {

    }
}
