<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Xztcart;
use App\Models\XztProduction;
use App\Models\XztVendor;

class ProductionsController extends Controller
{
    
    public function index($ord_num) {
        $order = Xztcart::where('order_number', $ord_num)->first();
        $vendor = XztVendor::all();

        // if(isset($ord_num) && !empty($ord_num)) {
        //     if(XztProduction::where('order_number', $ord_num)->first()) {
                
        //     }else {
        //         $sel_data = Xztcart::where('order_number', $ord_num)->first();
        //         $rec = new XztProduction();
        //         $rec->order_number = $sel_data->order_number;
        //         $rec->width = $sel_data->width + $sel_data->width_decimal;
        //         $rec->height = $sel_data->length + $sel_data->length_decimal;
        //         $rec->position = $sel_data->motor_pos;
        //         $rec->save();
        //         return redirect()->route('seller_orders.index');
        //     }
        // }
        return view('backend.production.index', compact('order', 'vendor'));
    }

    public function apply_formulas(Request $request) {
        $v_id = $request->vendor_id;
        $width = $request->width;
        $length = $request->length;
        $formula = XztVendor::where('id', $v_id)->first();
        $shades = $width - $formula->shades;
        $fascia = $width - $formula->fascia;
        $tube = $fascia - $formula->tube;
        $bottom_rail = $tube - $formula->bottom_rail;
        $bottom_tube = $bottom_rail - $formula->bottom_tube;
        $fabric_height = $length + $formula->fabric_height;
        
        return response()->json([
            'shades' => number_format($shades, 2),
            'fascia' => number_format($fascia, 2),
            'tube' => number_format($tube, 2),
            'bottom_rail' => number_format($bottom_rail, 2),
            'bottom_tube' => number_format($bottom_tube, 2),
            'fabric_height' => number_format($fabric_height, 2),
        ]);



    }





}
