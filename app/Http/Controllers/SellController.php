<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Helpers\Validations;

use App\Models\SellModel;
use App\Models\DetailSellModel;
use App\Models\ProductModel;
use App\Models\UsuarioModel;

use Carbon\Carbon;
use DB;
use Log;
use Redirect;

class SellController extends Controller
{
    public function index()
    {
        $sells = SellModel::getSellsAll(); 
        return view('sell.index', ["sells" => $sells]);
    }
    public function create()
    {
        $products = ProductModel::getProductsAll(); 
        $users = UsuarioModel::getUsuariosAll(); 
        return view('sell.create', ["products" => $products, "users" => $users]);
    }
    public function show($id_sell)
    {
        $details = DetailSellModel::getDetailSellsAll($id_sell); 
        return view('sell.show', ["details" => $details]);
    }

    public function store(Request $request)
    {
        Log::info($request);
        
        $messages = [ 'id_producto.required'  => 'Debe seleccionar al menos un producto' ];

        $validator = Validator::make($request->all(), [ 'id_producto' => 'required|array'], $messages);
        
        if($validator->fails()){
            $resp = Validations::getErrorMessages( $validator->errors()->messages() );
            return Redirect::back()->withErrors(['msg' => "ERROR: ".$resp ]);
        }

        $gEstado = 0; $gMessage = '';
        DB::beginTransaction();

        try {
            $observacion = ($request->get('observation') != null) ? $request->get('observation') : 'Ninguna';
            
            $g_subtotal  = (array) $request->get('i_subtotal');

            $total = 0;
            foreach ($g_subtotal as $key => $subtotal) {
                $total +=  floatval($subtotal) ;
            }

            $insertSell = DB::table('sells')
            ->insertGetId([ 
                "date"           => $request->get('fecha'),
                "observation"    => $observacion,
                "id_user"        => $request->get('id_user'),
                "total"          => $total,
            ]);

            if ($insertSell == 0) { //no se insertó
                $gEstado = 1;
                $gMessage = "ERROR, no se guardó el item de Sell:Cabecera";
            }

            $id_productos  = (array) $request->get('id_producto');
            $i_precio    = (array) $request->get('i_precio');
            $i_cantidad  = (array) $request->get('i_cantidad');
            $i_subtotal  = (array) $request->get('i_subtotal');

            $lastId = DetailSellModel::lastId() + 1;

            $id_detalle_insertados = [];

            foreach ($id_productos as $key => $id_producto) {

                $insertDetalle = DB::table('detail_sells')
                ->insert([ 
                    "id" => $lastId,
                    "id_sell" => $insertSell,
                    "amount"     => $i_cantidad[$key],
                    "unit_price" => $i_precio[$key],
                    "subtotal"   => $i_subtotal[$key],
                    "id_product" => $id_producto,
                ]);

                if ($insertDetalle == 0) { //no se insertó
                    $gEstado = 1;
                    $gMessage = "ERROR, no se guardó el item de DetailSell";
                    break; // me salgo
                }

                array_push($id_detalle_insertados, $lastId);

                $lastId++;
            }

            if ($gEstado == 0) {
                DB::commit();
                Log::info('si se realizo los INSERTS');
                return redirect()->route('admin.sell.index');

            }else{
                DB::rollback();
                Log::info('NO se realizo los INSERTS');

                return Redirect::back()->withErrors(['msg' => $gMessage ]);
            }

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Log::info('Ups! Algo paso');
            return Redirect::back()->withErrors(['msg' => $th->getMessage()]);
        }
    }
}