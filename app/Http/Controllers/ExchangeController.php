<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Rate;
use App\Models\ExchangeHistory;
use App\Models\Monitor;


class ExchangeController extends Controller
{
    public function __construct(){

    }

    /**
     * 
     * El metodo sync_rates permite sincronizar el api disponigle en exchangeratesapi con la base de datos
     * de tal forma que se consume lo que esta en bd y no lo que esta en linea.
     * 
     */

    public function sync_rates(){
        $api = env('EXCHANGE_API');
        $rates = Http::get('https://api.exchangeratesapi.io/v1/latest?access_key='.$api);
        $rates = json_decode($rates);

        Rate::truncate();

        foreach ($rates->rates as $key => $rate) {
            Rate::create([
                'currency' => $key,
                'exchange' => $rate
            ]);
        }

    }

    /** 
     * 
     * Metodo que permite realizar la conversion de las monedas
     * @input origen
     * @input destino
     * @input qty
     * 
     * @ouput response->final_amount
     * 
     * Para realizar la conversion se usa como base el EUR ya que por limitaciones del api solo 
     * se puede traer currency rates en base al euro.
     * 
     * Adicional se registra el historico de cambios y se habilita el webhook segun la moneda que se esta
     * haciendo el cambio, pueden ser varias monedas y reporta el statuscode y lo almacena en la tabla monitor.
     * 
     * 
    */

    public function conversion(Request $request){
        $origen  = $request->origen;
        $destino = $request->destino;
        $qty     = $request->qty;

        try {
            $rate_origen  = Rate::where(['currency' => $origen])->first();
            $rate_destino = Rate::where(['currency' => $destino])->first();
            
            $final_amount = ($qty / $rate_origen->exchange) * $rate_destino->exchange;

            ExchangeHistory::create([
                'o_currency' => $origen,
                'd_currency' => $destino,
                'o_qty'      => $qty,
                'd_qty'      => $final_amount,
            ]);
    
            $monitor = Monitor::where(['currency' => $origen])->first();

            if($monitor){
               $webhook = Http::post(env('WEBHOOK_URI'));
               $monitor->last_response = $webhook->status();
               $monitor->save();
            }

            return Response(['response' => 'success', 'data' => ['final_amount' => $final_amount]], 200);

        } catch (\Throwable $th) {
            return Response(['response' => 'error', 'data' => [$th->getMessage()]], 500);
        }

    }

    /**
     * 
     * Metodo para obtener la lista del historico de cambios realizados.
     * 
     */

    public function historial(){

        $history = ExchangeHistory::all();
        $new_list = [];
        
        foreach ($history as $row) {
            $row->creado = $row->created_at->format('Y-m-d H:i');
            $new_list[] = $row;
        }

        return [
            'response' => 'success',
            'data' => $new_list
        ];
    }


    /**
     * 
     * Listado de monedas disponibles para el intercambio.
     * 
     */

     public function rates(){
        return [
            'response' => 'success',
            'data'     => Rate::all()
        ];
     }

}
