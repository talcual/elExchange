<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitor;
use App\Models\Rate;


class MonitorController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $monitors   = Monitor::all();
        $currencies = Rate::all();

        return view('monitor.index', compact('monitors', 'currencies'));
    }

    public function create(Request $request){
        try {
            
            Monitor::create([
                'currency' => $request->moneda,
                'last_response' => ''
            ]);

            return back()->with('response', 'Success');

        } catch (\Throwable $th) {
            return back()->with('response','Error '.$th);
        }
    }

    public function delete(Request $request){
        $row = Monitor::where(['id' => $request->id]);

        try {
            if($row->exists()){
                $row->delete();
            }

            return back()->with('response', 'success');

        } catch (\Throwable $th) {
            return back()->with('response', 'Error '.$th);
        }

    }

}
