<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Xztcart;
use App\Models\XztBillingAddr;
use App\Models\XztShippingAddr;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Destination;
use App\Models\SellerShipAddr;
use App\Models\Order;
use DB;

class XztCartControl extends Controller
{
    public function storeOrder(Request $request) {
        $data = $request->input();
        // dd($data);
        $pick = 0;
        $validatedData = $request->validate([
            'dealer_name' => 'required',
            'project_tag' => 'required',
            'quantity' => 'required|numeric',
            'width' => 'required|numeric',
            'wid_decimal' => 'required|numeric',
            'length' => 'required|numeric',
            'len_decimal' => 'required|numeric',
            // 'controltype' => 'required',
            // 'motor_name' => 'required',
            // 'motor_type' => 'required',
            // 'shad_wand_side' => 'required',
            // 'motor_cntrl' => 'required',
            // 'somfy_list' => 'required',
            // 'manual_sel' => 'required',
            // 'chain_color' => 'required',
            // 'chain_ctrl' => 'required',
            // 'cord_ctrl' => 'required',
            // 'cord_color' => 'required',
            // // 'mount' => 'required',
            // // 'fabric' => 'required',
            // 'wrap_expose' => 'required',
            // 'cassette_type' => 'required',
            // 'cassette_color' => 'required',
            // 'brackets' => 'required',
            // 'brackets_opt' => 'required',
        ]);
        
        if($data['delivery_chk'] == 'ship') {
            $ship_addr = new XztShippingAddr();
            if ($request->has('first_name')) { $ship_addr->first_name = $data['first_name']; }
            if ($request->has('last_name')) { $ship_addr->last_name = $data['last_name']; }
            if ($request->has('email')) { $ship_addr->email = $data['email']; }
            if ($request->has('address')) { $ship_addr->address = $data['address']; }
            if ($request->has('address2')) { $ship_addr->address2 = $data['address2']; }
            if ($request->has('country')) { $ship_addr->country = $data['country']; }
            if ($request->has('state')) { $ship_addr->state = $data['state']; }
            if ($request->has('zip')) { $ship_addr->zip = $data['zip']; }
            $ship_addr->save();
            $ship_last_id = $ship_addr->id;
            //if both addresses are same
            if($request->has('same_address')) {
                $billing_addr = new XztBillingAddr();
                if ($request->has('first_name')) { $billing_addr->first_name = $data['first_name']; }
                if ($request->has('last_name')) { $billing_addr->last_name = $data['last_name']; }
                if ($request->has('email')) { $billing_addr->email = $data['email']; }
                if ($request->has('address')) { $billing_addr->address = $data['address']; }
                if ($request->has('address2')) { $billing_addr->address2 = $data['address2']; }
                if ($request->has('country')) { $billing_addr->country = $data['country']; }
                if ($request->has('state')) { $billing_addr->state = $data['state']; }
                if ($request->has('zip')) { $billing_addr->zip = $data['zip']; }
                $billing_addr->save();
                $bill_last_id = $billing_addr->id;
            }
            //if both addresses are different
            else { 
                $billing_addr = new XztBillingAddr();
                if ($request->has('bil_first_name')) { $billing_addr->first_name = $data['bil_first_name']; }
                if ($request->has('bil_last_name')) { $billing_addr->last_name = $data['bil_last_name']; }
                if ($request->has('bil_email')) { $billing_addr->email = $data['bil_email']; }
                if ($request->has('bil_address')) { $billing_addr->address = $data['bil_address']; }
                if ($request->has('bil_address2')) { $billing_addr->address2 = $data['bil_address2']; }
                if ($request->has('bil_country')) { $billing_addr->country = $data['bil_country']; }
                if ($request->has('bil_state')) { $billing_addr->state = $data['bil_state']; }
                if ($request->has('bil_zip')) { $billing_addr->zip = $data['bil_zip']; }
                $billing_addr->save();
                $bill_last_id = $billing_addr->id;
            }
        // no addresses entered
        } else {
            $pick = 1;
        }
        
        $order = new Xztcart();
        if ($request->has('cust_side_mark')) { $order->cust_side_mark = $data['cust_side_mark']; }
        $order->user_id = Auth::user()->id;
        $order->product_id = $data['id'];
        $order->price_tag = $data['price_tag_id'];
        if ($request->has('order_number')) { $order->order_number = $data['order_number']; }
        if ($request->has('dealer_name')) { $order->dealer_name = $data['dealer_name']; }
        if ($request->has('project_tag')) { $order->tags = $data['project_tag']; }
        if ($request->has('quantity')) { $order->quantity = $data['quantity']; }
        if ($request->has('width')) { $order->width = $data['width']; }
        if ($request->has('wid_decimal')) { $order->width_decimal = $data['wid_decimal']; }
        if ($request->has('length')) { $order->length = $data['length']; }
        if ($request->has('len_decimal')) { $order->length_decimal = $data['len_decimal']; }
        if ($request->has('shade_amount')) { $order->shade_amount = $data['shade_amount']; }

        if ($request->has('controltype')) { $order->control_type = $data['controltype']; }
        // if motor is selected
        if($data['controltype'] != 'manual') {
            if ($request->has('motor_type')) { $order->motor_type = $data['motor_type']; }
            if ($request->has('motor_name')) { $order->motor_name = $data['motor_name']; }
             //motorization normal
            if ($request->has('remote_ctrl_channel')) { $order->remote_ctrl_channel = $data['remote_ctrl_channel']; }
            //motorization shado wand
            if ($request->has('shad_wand_len')) { $order->shad_wand_len = $data['shad_wand_len']; }
            if ($request->has('shad_wand_side')) { $order->shad_wand_side = $data['shad_wand_side']; }
            //motorization array
            if ($request->has('motor_arr_pri')) { $order->motor_array = $data['motor_arr_pri']; }
            //motorization somfy
            if ($request->has('somfy_list')) { $order->somfy_upgrade_price = $data['somfy_list']; }
            if ($request->has('somfy_upgrade_name')) { $order->somfy_upgrade_name = $data['somfy_upgrade_name']; }
            if ($request->has('motor_cntrl')) { $order->remote_control = $data['motor_cntrl']; }
        }else {
            //manual chain control, manual cord control
            if ($request->has('chaincolor_arr')) { $order->chain_color = $data['chaincolor_arr']; } 
            else if ($request->has('cordcolor_arr')) { $order->cord_color = $data['cordcolor_arr']; }

            if ($request->has('chain_ctrl')) { $order->chain_ctrl = $data['chain_ctrl']; }
            else if ($request->has('cord_ctrl')) { $order->cord_ctrl = $data['cord_ctrl']; }
        }
        
        if($data['price_tag_id'] != 12 && $data['price_tag_id'] != 11) {
            if ($request->has('wrap_expose')) { $order->wrap_exposed = $data['wrap_expose']; }
            if ($request->has('wrap_exp_price')) { $order->wrap_price = $data['wrap_exp_price']; }
        }

        if ($request->has('fabric')) { $order->fabric = $data['fabric']; }
        if ($request->has('cassette_type')) { $order->cassette_type = $data['cassette_type']; }
        if ($request->has('casprice')) { $order->cassette_price = $data['casprice']; }
        if ($request->has('cassette_color')) { $order->cassette_color = $data['cassette_color']; }
        
        if ($request->has('solar_panel')) { $order->solar_panel = $data['solar_panel']; }
        if ($request->has('plug_in_charger')) { $order->plug_in_charger = $data['plug_in_charger']; }
        if ($request->has('shadoesmart_transformer')) { $order->shadoesmart_transformer = $data['shadoesmart_transformer']; }
        if ($request->has('shadoesmart_hub')) { $order->shadoesmart_hub = $data['shadoesmart_hub']; }
        
        if ($request->has('room_type')) { $order->room_type = $data['room_type']; }
        
        if ($request->has('brackets')) { $order->brackets = $data['brackets']; }
        
        if ($request->has('brackets_opt')) { $order->bracket_option = $data['brackets_opt']; }
        if ($request->has('brackets_opt_name')) { $order->bracket_option_name = $data['brackets_opt_name']; }

        if ($request->has('mount')) { $order->mount_price = $data['mount']; }
        if ($request->has('mount_type')) { $order->mount_type = $data['mount_type']; }
        
        if ($request->has('sp_instructions')) { $order->sp_instructions = $data['sp_instructions']; }
        
        if ($request->has('duedate')) { $order->due_date = date("Y-m-d", strtotime($data['duedate'])); }

        if ($request->has('d_price')) { $order->admin_discount = $data['d_price']; }

        if ($request->has('other_room')) { $order->other_room = $data['other_room']; }

        if ($request->has('coupon_discount') && $request->has('coupon')) { 
            // dd($data['coupon']);
            $order->coupon_discount = $data['coupon_discount']; 
            $rec = new CouponUsage();
            $rec->user_id = Auth::user()->id;
            $rec->coupon_code = $data['coupon'];
            $rec->amount = $data['coupon_discount'];
            $rec->save();
        }

        if($pick > 0) {
            $order->pickup = $pick;
        }else {
            $order->shipping_id = $ship_last_id;
            $order->billing_id = $bill_last_id;
        }
        if ($request->has('t_price')) { $order->total_price = $data['t_price']; }
        
        $order->save();
        return redirect('/dashboard');
    }

    public function coupon_check(Request $request) {
        $success = 0;
        if ($request->has('coupon')) {
            $to_day = date("Y-m-d");
            $success = Coupon::where('code', $request->coupon)->where('end_date', '>', $to_day)->first();
        }
        if($success) {
            $is_used = CouponUsage::where('user_id', Auth::user()->id)->where('coupon_code', $request->coupon)->first();
            if($is_used) {
                return response()->json(['used'=>'Coupon already used.']);
            }else {
                return response()->json([
                    'msg'=>'found',
                    'code'=>$success->code,
                    'discount'=>$success->discount,
                    'discount_type'=>$success->discount_type,
                ]);
            }
        }else {
            return response()->json(['used'=>'Coupon not found.']);
        }
    }

    public function seller_index() {
        $destinations = Destination::select('country', 'country_code')->distinct()->get();
        $ship = SellerShipAddr::where('user_id', Auth::user()->id)->first();
        return view('frontend.user.seller.cart.index', compact('destinations', 'ship'));
    }
 
    public function store_cart(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'ship.ship_name' => 'required',
            'ship.ship_email' => 'required|email',
            'ship.ship_addr' => 'required',
            'ship.ship_country' => 'required',
            'ship.ship_city' => 'required',
            'ship.ship_zip' => 'required',
        ]);
        $success = false;

        try {
            DB::transaction(function () use ($request, &$success) {
                $ship_addr = new XztShippingAddr();
                $ship_addr->name = $request->ship['ship_name'];
                $ship_addr->email = $request->ship['ship_email'];
                $ship_addr->address = $request->ship['ship_addr'];
                if($request->ship['ship_addr2'] != null){
                    $ship_addr->address2 = $request->ship['ship_addr2'];
                }
                $ship_addr->country = $request->ship['ship_country'];
                $ship_addr->city = $request->ship['ship_city'];
                $ship_addr->zip = $request->ship['ship_zip'];
                if ($ship_addr->save()){
                    $success = true;
                }
                $ship_last_id = $ship_addr->id;

                $order = new Order();
                $order->user_id = Auth::user()->id;
                $order->grand_total = $request->ord_grandtotal;
                $order->coupon_discount = $request->coupon_amount;
                $order->save();
                $order_id = $order->id;
        
                foreach($request->products as $item) {
                    
                    $cart = new Xztcart();
                    if($item['parts'] == 0){
                        $cart->user_id = Auth::user()->id;
                        $cart->cust_side_mark = $item['cust_side_mark'];
                        $cart->order_id = $order_id;
                        $cart->order_number = $item['order_number'];
                        $cart->dealer_name = $item['dealer_name'];
                        $cart->project_tag = $item['project_tag'];
                        $cart->product_id = $item['prod_id'];
                        $cart->quantity = $item['quantity'];
                        $cart->width = $item['width'];
                        $cart->width_decimal = $item['wid_decimal'];
                        $cart->length = $item['length'];
                        $cart->length_decimal = $item['len_decimal'];
                        $cart->fabric = $item['fabric'];
                        $cart->shade_amount = $item['shade_price'];
                        $cart->room_type = $item['room_type'];
                        $cart->brackets = $item['brackets'];
                        $cart->sp_instructions = $item['sp_instructions'];
                        $cart->admin_discount = $item['disc_percent'];
                        $due_date = date_create($item['due_date']);
                        $cart->due_date = date_format($due_date, "Y-m-d");
                        $cart->shipping_id = $ship_last_id;
                        
                        if($item['wrap_expose'] != null) {
                            $cart->wrap_exposed = $item['wrap_expose'];
                        }
                        if($item['wrap_price'] != null) {
                            $cart->wrap_price = $item['wrap_price'];
                        }
                        if($item['cassette_price'] != null) {
                            $cart->cassette_price = $item['cassette_price'];
                        }
                        if($item['cassette_type'] != null) {
                            $cart->cassette_type = $item['cassette_type'];
                        }
                        if($item['cassette_color'] != null) {
                            $cart->cassette_color = $item['cassette_color'];
                        }
                        if($item['brackets_opt_price'] != null) {
                            $cart->bracket_option = $item['brackets_opt_price'];
                        }
                        if($item['brackets_opt'] != null) {
                            $cart->bracket_option_name = $item['brackets_opt'];
                        }
                        if($item['mount_price'] != null) {
                            $cart->mount_price = $item['mount_price'];
                        }
                        if($item['mount_type'] != null) {
                            $cart->mount_type = $item['mount_type'];
                        }
                        if($item['mount_pos'] != null) {
                            $cart->mount_pos = $item['mount_pos'];
                        }
                        if($item['spring_assist_price'] != null) {
                            $cart->spring_assist = $item['spring_assist_price'];
                        }
                        if($item['stack'] != null) {
                            $cart->stack = $item['stack'];
                        }
                        // if($item['coupon_val'] != null) {
                        //     $cart->coupon_discount = $item['coupon_val'];
                        // }
                        if($item['window_desc'] != null) {
                            $cart->window_desc = $item['window_desc'];
                        }

                        // if($item[''] != null) {
                        //     $cart->control_type = $item[''];
                        // }

                        if($item['control_type'] != null) {
                            $cart->control_type = $item['control_type'];
                        }
                        if($item['motor_name'] != null) {
                            $cart->motor_name = $item['motor_name'];
                        }
                        if($item['motor_pos'] != null) {
                            $cart->motor_pos = $item['motor_pos'];
                        }
                        if($item['motor_price'] != null) {
                            $cart->motor_price = $item['motor_price'];
                        }
                        if($item['motor_arr_price'] != null) {
                            $cart->motor_array = $item['motor_arr_price'];
                        }

                        if($item['channel_price'] != null) {
                            $cart->remote_ctrl_price = $item['channel_price'];
                        }
                        if($item['channel_name'] != null) {
                            $cart->remote_ctrl_channel = $item['channel_name'];
                        }
                        if($item['chain_cord'] != null) {
                            $cart->chain_cord = $item['chain_cord'];
                        }
                        if($item['chain_color'] != null) {
                            $cart->chain_color = $item['chain_color'];
                        }
                        if($item['chain_ctrl'] != null) {
                            $cart->chain_ctrl = $item['chain_ctrl'];
                        }
                        if($item['cord_color'] != null) {
                            $cart->cord_color = $item['cord_color'];
                        }
                        if($item['cord_ctrl'] != null) {
                            $cart->cord_ctrl = $item['cord_ctrl'];
                        }
                        
                        if($item['hub_price'] != null) {
                            $cart->shadoesmart_hub = $item['hub_price'];
                        }if($item['transformer_price'] != null) {
                            $cart->shadoesmart_transformer = $item['transformer_price'];
                        }if($item['solar_price'] != null) {
                            $cart->solar_panel = $item['solar_price'];
                        }if($item['plugin_price'] != null) {
                            $cart->plug_in_charger = $item['plugin_price'];
                        }
                        $cart->unit_price = $item['price'];
                        $cart->total_price = $item['total'];
                        $cart->status = 'Pending';

                        if ($cart->save()){
                            $success = true;
                        }
                    }else {
                        $cart->user_id = Auth::user()->id;
                        $cart->cust_side_mark = $item['cust_side_mark'];
                        $cart->order_id = $order_id;
                        $cart->order_number = $item['order_number'];
                        $cart->dealer_name = $item['dealer_name'];
                        $cart->project_tag = $item['project_tag'];
                        $cart->product_id = $item['prod_id'];
                        $cart->quantity = $item['quantity'];
                        $cart->unit_price = $item['price'];
                        $cart->total_price = $item['total'];
                        $due_date = date_create($item['due_date']);
                        $cart->due_date = date_format($due_date, "Y-m-d");
                        $cart->status = 'Pending';
                        $cart->shipping_id = $ship_last_id;
                        if ($cart->save()){
                            $success = true;
                        }
                    }
                }
            });
        }catch(\Exception $e) {
            $success = false;
            return redirect()->route('cart.seller.index')
                ->with('error','Something went wrong');
        }
        if($success){
            echo "success";
        }else {
            echo "failed";
        }
        
    }


}
