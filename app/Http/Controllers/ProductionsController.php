<?php

namespace App\Http\Controllers;

use App\Models\Xztcart;
use App\Models\XztProduction;
use App\Models\XztShippingAddr;
use App\Models\XztVendor;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class ProductionsController extends Controller
{

    /* public function index($ord_num) {
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
    } */

    public function item_list($id)
    {
        $mainOrder = Order::find($id);
        if (!$mainOrder) {
            return abort(404);
        }
        $ship_addr = XztShippingAddr::find($mainOrder->shipping_id);
        $order = Xztcart::where('order_id', $id)->get();
        foreach ($order as $product) {
            $product->production = XztProduction::where('order_item_id', $product->id)->first();
        }

        
        $vendor = XztVendor::all();
        $order_id = $id;
        return view('backend.production.items', compact('order', 'ship_addr', 'mainOrder', 'vendor', 'order_id'));
    }

    public function apply_formulas(Request $request)
    {
        $v_id = $request->vendor_id;
        $width = $request->width;
        $length = $request->length;
        $formula = XztVendor::where('id', $v_id)->first();
        $shades = $width - abs($formula->shades);
        $fascia = $width - abs($formula->fascia);
        $tube = $fascia - abs($formula->tube);
        $bottom_rail = $tube - abs($formula->bottom_rail);
        $bottom_tube = $bottom_rail - abs($formula->bottom_tube);
        $fabric_width = $length + abs($formula->fabric_width);
        $fabric_height = $length + abs($formula->fabric_height);
        $blind_width = $length + abs($formula->blind_width);
        return response()->json([
            'shades' => number_format($shades, 2),
            'fascia' => number_format($fascia, 2),
            'tube' => number_format($tube, 2),
            'bottom_rail' => number_format($bottom_rail, 2),
            'bottom_tube' => number_format($bottom_tube, 2),
            'fabric_width' => number_format($fabric_width, 2),
            'fabric_height' => number_format($fabric_height, 2),
            'blind_width' => number_format($blind_width, 2),
        ]);

    }

    public function save_production(Request $request)
    {
        $data = $request->production;
        for ($i = 0; $i < sizeof($data); $i++) {
            XztProduction::where('order_item_id', $data[$i]["order_item_id"])->delete();
            $rec = new XztProduction();
            $rec->order_id = $data[$i]["order_id"];
            $rec->order_item_id = $data[$i]["order_item_id"];
            $rec->vendor_id = $data[$i]["vendor_id"];
            $rec->width = $data[$i]["width"];
            $rec->length = $data[$i]["length"];
            $rec->shades = $data[$i]["shades"];
            $rec->fascia = $data[$i]["fascia"];
            $rec->tube = $data[$i]["tube"];
            $rec->bottom_rail = $data[$i]["bot_rail"];
            $rec->bottom_tube = $data[$i]["bot_tube"];
            $rec->fabric_width = $data[$i]["fab_width"];
            $rec->fabric_height = $data[$i]["fab_height"];
            $rec->save();
        }

        echo "success";

    }

    public function view_production($id)
    {
        $find_data = XztProduction::with('order_item')->where('order_id', $id)->get();
        $order = Order::findOrFail($id);
        $mainOrderFirstItem = Xztcart::where("order_id", $id)->first();
        // dd($find_data);
        if (isset($find_data[0])) {
            $seller = User::with('discountseller')->where('id', $find_data[0]->order->user_id)->first();
        } else {
            $seller = '';
        }

        return view('backend.production.view_production', compact('find_data', 'order', 'mainOrderFirstItem', 'seller'));

    }

}