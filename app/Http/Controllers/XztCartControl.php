<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\CompanySetting;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Destination;
use App\Models\DiscountSeller;
use App\Models\Fabric;
use App\Models\FabricOptions;
use App\Models\Order;
use App\Models\Price;
use App\Models\ProductBracket;
use App\Models\ProductCassette;
use App\Models\ProductControltype;
use App\Models\ProductFabric;
use App\Models\ProductMount;
use App\Models\ProductRoomtype;
use App\Models\ProductSpringassist;
use App\Models\ProductStack;
use App\Models\ProductWrap;
use App\Models\SellerShipAddr;
use App\Models\ShadeOptions;
use App\Models\XztBillingAddr;
use App\Models\Xztcart;
use App\Models\XztMountposition;
use App\Models\XztShippingAddr;
use App\Models\XztWidMotors;
use App\Product;
use App\Upload;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Mail;
use PDF;

class XztCartControl extends Controller
{
    public function storeOrder(Request $request)
    {
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

        if ($data['delivery_chk'] == 'ship') {
            $ship_addr = new XztShippingAddr();
            if ($request->has('first_name')) {
                $ship_addr->first_name = $data['first_name'];
            }
            if ($request->has('last_name')) {
                $ship_addr->last_name = $data['last_name'];
            }
            if ($request->has('email')) {
                $ship_addr->email = $data['email'];
            }
            if ($request->has('address')) {
                $ship_addr->address = $data['address'];
            }
            if ($request->has('address2')) {
                $ship_addr->address2 = $data['address2'];
            }
            if ($request->has('country')) {
                $ship_addr->country = $data['country'];
            }
            if ($request->has('state')) {
                $ship_addr->state = $data['state'];
            }
            if ($request->has('zip')) {
                $ship_addr->zip = $data['zip'];
            }
            $ship_addr->save();
            $ship_last_id = $ship_addr->id;
            //if both addresses are same
            if ($request->has('same_address')) {
                $billing_addr = new XztBillingAddr();
                if ($request->has('first_name')) {
                    $billing_addr->first_name = $data['first_name'];
                }
                if ($request->has('last_name')) {
                    $billing_addr->last_name = $data['last_name'];
                }
                if ($request->has('email')) {
                    $billing_addr->email = $data['email'];
                }
                if ($request->has('address')) {
                    $billing_addr->address = $data['address'];
                }
                if ($request->has('address2')) {
                    $billing_addr->address2 = $data['address2'];
                }
                if ($request->has('country')) {
                    $billing_addr->country = $data['country'];
                }
                if ($request->has('state')) {
                    $billing_addr->state = $data['state'];
                }
                if ($request->has('zip')) {
                    $billing_addr->zip = $data['zip'];
                }
                $billing_addr->save();
                $bill_last_id = $billing_addr->id;
            }
            //if both addresses are different
            else {
                $billing_addr = new XztBillingAddr();
                if ($request->has('bil_first_name')) {
                    $billing_addr->first_name = $data['bil_first_name'];
                }
                if ($request->has('bil_last_name')) {
                    $billing_addr->last_name = $data['bil_last_name'];
                }
                if ($request->has('bil_email')) {
                    $billing_addr->email = $data['bil_email'];
                }
                if ($request->has('bil_address')) {
                    $billing_addr->address = $data['bil_address'];
                }
                if ($request->has('bil_address2')) {
                    $billing_addr->address2 = $data['bil_address2'];
                }
                if ($request->has('bil_country')) {
                    $billing_addr->country = $data['bil_country'];
                }
                if ($request->has('bil_state')) {
                    $billing_addr->state = $data['bil_state'];
                }
                if ($request->has('bil_zip')) {
                    $billing_addr->zip = $data['bil_zip'];
                }
                $billing_addr->save();
                $bill_last_id = $billing_addr->id;
            }
            // no addresses entered
        } else {
            $pick = 1;
        }

        $order = new Xztcart();
        if ($request->has('cust_side_mark')) {
            $order->cust_side_mark = $data['cust_side_mark'];
        }
        $order->user_id = Auth::user()->id;
        $order->product_id = $data['id'];
        $order->price_tag = $data['price_tag_id'];
        if ($request->has('order_number')) {
            $order->order_number = $data['order_number'];
        }
        if ($request->has('dealer_name')) {
            $order->dealer_name = $data['dealer_name'];
        }
        if ($request->has('project_tag')) {
            $order->tags = $data['project_tag'];
        }
        if ($request->has('quantity')) {
            $order->quantity = $data['quantity'];
        }
        if ($request->has('width')) {
            $order->width = $data['width'];
        }
        if ($request->has('wid_decimal')) {
            $order->width_decimal = $data['wid_decimal'];
        }
        if ($request->has('length')) {
            $order->length = $data['length'];
        }
        if ($request->has('len_decimal')) {
            $order->length_decimal = $data['len_decimal'];
        }
        if ($request->has('shade_amount')) {
            $order->shade_amount = $data['shade_amount'];
        }

        if ($request->has('controltype')) {
            $order->control_type = $data['controltype'];
        }
        // if motor is selected
        if ($data['controltype'] != 'manual') {
            if ($request->has('motor_type')) {
                $order->motor_type = $data['motor_type'];
            }
            if ($request->has('motor_name')) {
                $order->motor_name = $data['motor_name'];
            }
            //motorization normal
            if ($request->has('remote_ctrl_channel')) {
                $order->remote_ctrl_channel = $data['remote_ctrl_channel'];
            }
            //motorization shado wand
            if ($request->has('shad_wand_len')) {
                $order->shad_wand_len = $data['shad_wand_len'];
            }
            if ($request->has('shad_wand_side')) {
                $order->shad_wand_side = $data['shad_wand_side'];
            }
            //motorization array
            if ($request->has('motor_arr_pri')) {
                $order->motor_array = $data['motor_arr_pri'];
            }
            //motorization somfy
            if ($request->has('somfy_list')) {
                $order->somfy_upgrade_price = $data['somfy_list'];
            }
            if ($request->has('somfy_upgrade_name')) {
                $order->somfy_upgrade_name = $data['somfy_upgrade_name'];
            }
            if ($request->has('motor_cntrl')) {
                $order->remote_control = $data['motor_cntrl'];
            }
        } else {
            //manual chain control, manual cord control
            if ($request->has('chaincolor_arr')) {
                $order->chain_color = $data['chaincolor_arr'];
            } else if ($request->has('cordcolor_arr')) {
                $order->cord_color = $data['cordcolor_arr'];
            }

            if ($request->has('chain_ctrl')) {
                $order->chain_ctrl = $data['chain_ctrl'];
            } else if ($request->has('cord_ctrl')) {
                $order->cord_ctrl = $data['cord_ctrl'];
            }
        }

        if ($data['price_tag_id'] != 12 && $data['price_tag_id'] != 11) {
            if ($request->has('wrap_expose')) {
                $order->wrap_exposed = $data['wrap_expose'];
            }
            if ($request->has('wrap_exp_price')) {
                $order->wrap_price = $data['wrap_exp_price'];
            }
        }

        if ($request->has('fabric')) {
            $order->fabric = $data['fabric'];
        }
        if ($request->has('cassette_type')) {
            $order->cassette_type = $data['cassette_type'];
        }
        if ($request->has('casprice')) {
            $order->cassette_price = $data['casprice'];
        }
        if ($request->has('cassette_color')) {
            $order->cassette_color = $data['cassette_color'];
        }

        if ($request->has('solar_panel')) {
            $order->solar_panel = $data['solar_panel'];
        }
        if ($request->has('plug_in_charger')) {
            $order->plug_in_charger = $data['plug_in_charger'];
        }
        if ($request->has('shadoesmart_transformer')) {
            $order->shadoesmart_transformer = $data['shadoesmart_transformer'];
        }
        if ($request->has('shadoesmart_hub')) {
            $order->shadoesmart_hub = $data['shadoesmart_hub'];
        }

        if ($request->has('room_type')) {
            $order->room_type = $data['room_type'];
        }

        if ($request->has('brackets')) {
            $order->brackets = $data['brackets'];
        }

        if ($request->has('brackets_opt')) {
            $order->bracket_option = $data['brackets_opt'];
        }
        if ($request->has('brackets_opt_name')) {
            $order->bracket_option_name = $data['brackets_opt_name'];
        }

        if ($request->has('mount')) {
            $order->mount_price = $data['mount'];
        }
        if ($request->has('mount_type')) {
            $order->mount_type = $data['mount_type'];
        }

        if ($request->has('sp_instructions')) {
            $order->sp_instructions = $data['sp_instructions'];
        }

        if ($request->has('duedate')) {
            $order->due_date = date("Y-m-d", strtotime($data['duedate']));
        }

        if ($request->has('d_price')) {
            $order->admin_discount = $data['d_price'];
        }

        if ($request->has('other_room')) {
            $order->other_room = $data['other_room'];
        }

        if ($request->has('coupon_discount') && $request->has('coupon')) {
            // dd($data['coupon']);
            $order->coupon_discount = $data['coupon_discount'];
            $rec = new CouponUsage();
            $rec->user_id = Auth::user()->id;
            $rec->coupon_code = $data['coupon'];
            $rec->amount = $data['coupon_discount'];
            $rec->save();
        }

        if ($pick > 0) {
            $order->pickup = $pick;
        } else {
            $order->shipping_id = $ship_last_id;
            $order->billing_id = $bill_last_id;
        }
        if ($request->has('t_price')) {
            $order->total_price = $data['t_price'];
        }

        $order->save();
        return redirect('/dashboard');
    }

    public function coupon_check(Request $request)
    {
        $success = 0;
        if ($request->has('coupon')) {
            $to_day = date("Y-m-d");
            $success = Coupon::where('code', $request->coupon)->where('end_date', '>', $to_day)->first();
        }
        if ($success) {
            $is_used = CouponUsage::where('user_id', Auth::user()->id)->where('coupon_code', $request->coupon)->first();
            if ($is_used) {
                return response()->json(['used' => 'Coupon already used.']);
            } else {
                return response()->json([
                    'msg' => 'found',
                    'code' => $success->code,
                    'discount' => $success->discount,
                    'discount_type' => $success->discount_type,
                ]);
            }
        } else {
            return response()->json(['used' => 'Coupon not found.']);
        }
    }

    public function seller_cart_product_edit(Request $request)
    {
        $cart = new Xztcart();
        $item = json_decode($request->product, true);
        if (!$item) {
            flash(translate('Item parsing problem'))->success();
            return back();
        }
        if (isset($item['room_type']) && $item['room_type']) {
            $item['room_type'] = str_replace("&singlequote", "'", $item['room_type']);
        }

        if ($item['parts'] == 0) {
            $cart->user_id = Auth::user()->id;
            $cart->cust_side_mark = $item['cust_side_mark'];
            $cart->order_number = $item['order_number'];
            $cart->dealer_name = $item['dealer_name'];
            $cart->product_id = $item['prod_id'];
            $cart->quantity = $item['quantity'];
            $cart->width = $item['width'];
            $cart->width_decimal = $item['wid_decimal'];
            $cart->length = $item['length'];
            $cart->length_decimal = $item['len_decimal'];
            $cart->fabric = trim($item['fabric']);
            $cart->shade_amount = $item['shade_price'];
            $cart->room_type = $item['room_type'];
            $cart->brackets = $item['brackets'];
            $cart->sp_instructions = $item['sp_instructions'];
            $cart->admin_discount = $item['disc_percent'];
            $cart->date = date('Y-m-d');

            if ($item['wrap_expose'] != null) {
                $cart->wrap_exposed = $item['wrap_expose'];
            }
            if ($item['wrap_price'] != null) {
                $cart->wrap_price = $item['wrap_price'];
            }
            if ($item['cassette_price'] != null) {
                $cart->cassette_price = $item['cassette_price'];
            }
            if ($item['cassette_type'] != null) {
                $cart->cassette_type = $item['cassette_type'];
            }
            if ($item['cassette_color'] != null) {
                $cart->cassette_color = $item['cassette_color'];
            }
            if (isset($item['bottom_rail_price']) && $item['bottom_rail_price'] != null) {
                $cart->bottom_rail_price = $item['bottom_rail_price'];
            }
            if (isset($item['bottom_rail']) && $item['bottom_rail'] != null) {
                $cart->bottom_rail = $item['bottom_rail'];
            }
            if (isset($item['bottom_rail_color']) && $item['bottom_rail_color'] != null) {
                $cart->bottom_rail_color = $item['bottom_rail_color'];
            }
            if ($item['brackets_opt_price'] != null) {
                $cart->bracket_option = $item['brackets_opt_price'];
            }
            if ($item['brackets_opt'] != null) {
                $cart->bracket_option_name = $item['brackets_opt'];
            }
            if ($item['mount_price'] != null) {
                $cart->mount_price = $item['mount_price'];
            }
            if ($item['mount_type'] != null) {
                $cart->mount_type = $item['mount_type'];
            }
            if ($item['mount_pos'] != null) {
                $cart->mount_pos = $item['mount_pos'];
            }
            if ($item['spring_assist_price'] != null) {
                $cart->spring_assist = $item['spring_assist_price'];
            }
            if ($item['stack'] != null) {
                $cart->stack = $item['stack'];
            }
            // if($item['coupon_val'] != null) {
            //     $cart->coupon_discount = $item['coupon_val'];
            // }
            if ($item['window_desc'] != null) {
                $cart->window_desc = $item['window_desc'];
            }

            // if($item[''] != null) {
            //     $cart->control_type = $item[''];
            // }

            if ($item['control_type'] != null) {
                $cart->control_type = $item['control_type'];
            }
            if ($item['motor_name'] != null) {
                $cart->motor_name = $item['motor_name'];
            }
            if ($item['motor_pos'] != null) {
                $cart->motor_pos = $item['motor_pos'];
            }
            if ($item['motor_price'] != null) {
                $cart->motor_price = $item['motor_price'];
            }
            if ($item['motor_arr_price'] != null) {
                $cart->motor_array = $item['motor_arr_price'];
            }

            if ($item['channel_price'] != null) {
                $cart->remote_ctrl_price = $item['channel_price'];
            }
            if ($item['channel_name'] != null) {
                $cart->remote_ctrl_channel = $item['channel_name'];
            }
            if ($item['chain_cord'] != null) {
                $cart->chain_cord = $item['chain_cord'];
            }
            if ($item['chain_color'] != null) {
                $cart->chain_color = $item['chain_color'];
            }
            if ($item['chain_ctrl'] != null) {
                $cart->chain_ctrl = $item['chain_ctrl'];
            }
            if ($item['cord_color'] != null) {
                $cart->cord_color = $item['cord_color'];
            }
            if ($item['cord_ctrl'] != null) {
                $cart->cord_ctrl = $item['cord_ctrl'];
            }

            if ($item['hub_price'] != null) {
                $cart->shadoesmart_hub = $item['hub_price'];
            }
            if ($item['transformer_price'] != null) {
                $cart->shadoesmart_transformer = $item['transformer_price'];
            }
            if ($item['solar_price'] != null) {
                $cart->solar_panel = $item['solar_price'];
            }
            if ($item['plugin_price'] != null) {
                $cart->plug_in_charger = $item['plugin_price'];
            }
            $cart->unit_price = $item['price'];
            $cart->total_price = $item['total'];
            $cart->status = 'Pending';
        } else {
            $cart->user_id = Auth::user()->id;
            $cart->cust_side_mark = $item['cust_side_mark'];
            $cart->order_number = $item['order_number'];
            $cart->dealer_name = $item['dealer_name'];
            $cart->product_id = $item['prod_id'];
            $cart->quantity = $item['quantity'];
            $cart->unit_price = $item['price'];
            $cart->total_price = $item['total'];
            $cart->project_tag = $item['project_tag'];
            $due_date = date_create($item['due_date']);
            $cart->due_date = date_format($due_date, "Y-m-d");
            $cart->status = 'Pending';
            $cart->date = date('Y-m-d H:i:s');
        }
        $order = $cart;

        //Cart info for which going to update item
        $cart_type = $request->input("cart_type");
        $cartIndex = $request->input("cartIndex");
        $itemIndex = $request->input("itemIndex");

        $id = $order->product_id;
        $invoice = CompanySetting::where('keys', 'ORDER_NO')->first();
        $product = Product::findOrFail($id);
        $cust_discount = DiscountSeller::where('user_id', Auth::user()->id)->first();
        $part = $product;
        if ($product->is_parts == 1) {
            return view('frontend.user.seller.cart.edit_cart_part', compact('part', 'cart_type', 'cartIndex', 'itemIndex', 'cust_discount', 'invoice', 'order'));
        }

        //other information for edit

        $fabric = ProductFabric::with('xztfabric')->where('product_id', '=', $id)->get();
        $mount = ProductMount::with('xztmount')->where('product_id', '=', $id)->get();
        $cassette = ProductCassette::with('xztcassette')->where('product_id', '=', $id)->get();
        $bracket = ProductBracket::with('xztbracket')->where('product_id', '=', $id)->get();
        $springassist = ProductSpringassist::with('xztspringassist')->where('product_id', '=', $id)->get();
        $roomtype = ProductRoomtype::with('xztroomtype')->where('product_id', '=', $id)->get();

        $otherRoomTypeItem = $roomtype->first(function ($item, $key) {
            if (strtolower($item->xztroomtype->name) == "other") {
                return true;
            }
            return false;
        });
        $roomtypeWithoutOther = $roomtype->filter(function ($item, $key) {
            if (strtolower($item->xztroomtype->name) == "other") {
                return false;
            }
            return true;
        });
        $roomtypeSorted = $roomtypeWithoutOther->sort(function ($item1, $item2) {
            if ($item1->xztroomtype->name < $item2->xztroomtype->name) {
                return -1;
            }
            if ($item1->xztroomtype->name > $item2->xztroomtype->name) {
                return 1;
            }
            if ($item1->xztroomtype->name == $item2->xztroomtype->name) {
                return 0;
            }
        });
        $roomtypeSorted->push($otherRoomTypeItem);
        $roomtype = $roomtypeSorted;

        $stack = ProductStack::with('xztstack')->where('product_id', '=', $id)->get();
        $controltype = ProductControltype::where('product_id', '=', $id)->get();
        $ct_manuals = ProductControltype::with('manual')->where('product_id', '=', $id)->where('ct_manual_id', '<>', null)->get();
        $ct_motors = ProductControltype::with('motor')->where('product_id', '=', $id)->where('ct_motor_id', '<>', null)->get();
        $ct_wid_motors = ProductControltype::with('width')->where('product_id', '=', $id)->where('ct_widmotor_code', '<>', null)->first();
        if (isset($ct_wid_motors->ct_widmotor_code)) {
            $wid_motor_max = XztWidMotors::where('ct_code', $ct_wid_motors->ct_widmotor_code)->max('max_wid');
        } else {
            $wid_motor_max = '';
        }
        $wrap = ProductWrap::with('xztwrap')->where('product_id', '=', $id)->first();

        $mountpos = XztMountposition::all();

        $price_cat = Category::select('*')->where('id', $product->category_id)->first();

        $wid_len = Price::select('id', 'cat_id', 'price_code', 'width', 'length', 'price', 'square_cassette', 'fabric_wrap', 'std_r_cassette', 'wid_diff', 'len_diff', 'motor_array', 'round_cassette')
            ->where('cat_id', $product->category->parentCategory->id)
            ->where('shade_code', $product->shade_code)
            ->get();

        $price_arr = [];
        foreach ($wid_len as $key => $item) {
            $price_arr[$key]['width'] = $item->width;
            $price_arr[$key]['length'] = $item->length;
            $price_arr[$key]['price'] = $item->price;
            $price_arr[$key]['square_cassette'] = $item->square_cassette;
            $price_arr[$key]['fabric_wrap'] = $item->fabric_wrap;
            $price_arr[$key]['std_r_cassette'] = $item->std_r_cassette;
            $price_arr[$key]['wid_diff'] = $item->wid_diff;
            $price_arr[$key]['len_diff'] = $item->len_diff;
            $price_arr[$key]['round_cassette'] = $item->round_cassette;
            $price_arr[$key]['motor_array'] = $item->motor_array;
        }

        $distinct_wid = Price::select('width')->where('cat_id', $product->category->parentCategory->id)->distinct()->orderBy('id', 'ASC')->get();

        $distinct_len = Price::select('length')->where('cat_id', $product->category->parentCategory->id)->distinct()->orderBy('id', 'ASC')->get();

        $shade_opt = ShadeOptions::where('cat_id', $product->category->parentCategory->id)->first();
        // dd($shade_opt);

        $fab_opt = FabricOptions::select()->where('price_tag', $product->category->price_tag)->get();

        $today_date = Carbon::now()->format('Y-m-d');
        $coupons = Coupon::where('end_date', '>', $today_date)->get();

        $coupon_arr = [];
        foreach ($coupons as $key => $item) {
            $coupon_arr[$key]['type'] = $item->type;
            $coupon_arr[$key]['code'] = $item->code;
            $coupon_arr[$key]['discount'] = $item->discount;
            $coupon_arr[$key]['discount_type'] = $item->discount_type;
        }

        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        $fabric_all = Fabric::all();

        $destinations = Destination::select('country', 'country_code')->distinct()->get();

        return view('frontend.user.seller.cart.edit_cart_product', compact('order', 'product', 'categories', 'tags', 'lang', 'fabric', 'price_cat', 'price_arr', 'distinct_wid', 'distinct_len', 'fabric_all', 'shade_opt', 'fab_opt', 'coupon_arr', 'cust_discount', 'destinations', 'roomtype', 'mount', 'cassette', 'bracket', 'springassist', 'wrap', 'stack', 'mountpos', 'controltype', 'ct_manuals', 'ct_motors', 'ct_wid_motors', 'wid_motor_max', 'invoice', 'cart_type', 'cartIndex', 'itemIndex'));
    }

    public function seller_index()
    {
        $destinations = Destination::select('country', 'country_code')->distinct()->get();
        $ship = SellerShipAddr::where('user_id', Auth::user()->id)->first();
        return view('frontend.user.seller.cart.index', compact('destinations', 'ship'));
    }

    public function saved_carts_index()
    {
        return view('frontend.user.seller.saved_carts.index');
    }
    public function send_saved_quote_email(Request $request)
    {
        $data = str_replace("&singlequote", "'", $request->data);
        $data = json_decode($data, true);
        $logo = "";
        if ($data["userType"] == 1 && Auth::user()->logo) {
            $u = Upload::find(Auth::user()->logo);
            if ($u) {
                $logo = static_asset($u->file_name);
            }
        }
        $data["logo"] = $logo;
        $pdf = $this->generateQuotePDF($data);

        try {

            if (file_exists($pdf)) {

                Mail::send('emails/quote_template', ["data" => $data, "seller_name" => Auth::user()->name], function ($messages) use ($data, $pdf) {
                    $messages->from(Auth::user()->email, Auth::user()->name);
                    $messages->attach($pdf);
                    $messages->to($data["email"], 'Receiver')->subject("Quote Invoice");
                });
                // Delete attachment
                unlink($pdf);
            }
        } catch (\Exception $e) {
            \Log::info("Mail sending failed with the error " . $e->getMessage());
        }

        flash(translate('Email sent successfully!'))->success();
        return back();
    }

    public function store_cart_attachments(Request $request)
    {
        $atachment_file = $request->file("attachment_file");

        if ($atachment_file && $atachment_file instanceof UploadedFile) {
            $new_filename = 'order-attachments-' . time() . $atachment_file->getClientOriginalName();
            $atachment_file->move(storage_path("temp"), $new_filename);
            return response()->json([
                "atachment_path" => [storage_path("temp/" . $new_filename)],
            ]);
        } else if ($atachment_file && is_array($atachment_file) && sizeof($atachment_file) > 0 && $atachment_file[0] instanceof UploadedFile) {
            $paths = [];
            foreach ($atachment_file as $file) {
                $new_filename = 'order-attachments-' . time() . $file->getClientOriginalName();
                $file->move(storage_path("temp"), $new_filename);
                array_push($paths, storage_path("temp/" . $new_filename));
            }
            return response()->json([
                "atachment_path" => $paths,
            ]);
        }
        return response()->json([
            "atachment_path" => [],
        ]);
    }

    public function store_cart(Request $request)
    {
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
        if($request->products == null || $request->products == "") {
            $success = false;
            echo "Invalid products";
        }
        if(sizeof($request->products) == 0) {
            $success = false;
            echo "No products given";
        }
        $order = null;
        $ship_addr = [];
        $get_order_no = 0;
        try {
            DB::transaction(function () use ($request, &$success, &$order, &$ship_addr, &$get_order_no) {
                $ship_addr = new XztShippingAddr();
                $ship_addr->name = $request->ship['ship_name'];
                $ship_addr->email = $request->ship['ship_email'];
                $ship_addr->address = $request->ship['ship_addr'];
                if ($request->ship['ship_addr2'] != null) {
                    $ship_addr->address2 = $request->ship['ship_addr2'];
                }
                $ship_addr->country = $request->ship['ship_country'];
                $ship_addr->city = $request->ship['ship_city'];
                $ship_addr->zip = $request->ship['ship_zip'];
                if ($ship_addr->save()) {
                    $success = true;
                }
                $ship_last_id = $ship_addr->id;

                $get_order_no = CompanySetting::where("keys", 'ORDER_NO')->first()->values;

                $order = new Order;
                $order->user_id = Auth::user()->id;
                $order->grand_total = $request->ord_grandtotal;
                $order->order_no = $get_order_no;
                $order->coupon_discount = $request->coupon_amount;
                $order->shipping_id = $ship_last_id;
                $order->save();
                $order_id = $order->id;
                $total = 0;
                foreach ($request->products as $item) {
                    $total+=(float)$item['total'];
                    $cart = new Xztcart();
                    if ($item['parts'] == 0) {
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
                        $cart->date = date('Y-m-d H:i:s');
                        $cart->shipping_id = $ship_last_id;

                        if ($item['wrap_expose'] != null) {
                            $cart->wrap_exposed = $item['wrap_expose'];
                        }
                        if ($item['wrap_price'] != null) {
                            $cart->wrap_price = $item['wrap_price'];
                        }
                        if ($item['cassette_price'] != null) {
                            $cart->cassette_price = $item['cassette_price'];
                        }
                        if ($item['cassette_type'] != null) {
                            $cart->cassette_type = $item['cassette_type'];
                        }
                        if ($item['cassette_color'] != null) {
                            $cart->cassette_color = $item['cassette_color'];
                        }
                        if (isset($item['bottom_rail_price']) && $item['bottom_rail_price'] != null) {
                            $cart->bottom_rail_price = $item['bottom_rail_price'];
                        }
                        if (isset($item['bottom_rail']) && $item['bottom_rail'] != null) {
                            $cart->bottom_rail = $item['bottom_rail'];
                        }
                        if (isset($item['bottom_rail_color']) && $item['bottom_rail_color'] != null) {
                            $cart->bottom_rail_color = $item['bottom_rail_color'];
                        }
                        if ($item['brackets_opt_price'] != null) {
                            $cart->bracket_option = $item['brackets_opt_price'];
                        }
                        if ($item['brackets_opt'] != null) {
                            $cart->bracket_option_name = $item['brackets_opt'];
                        }
                        if ($item['mount_price'] != null) {
                            $cart->mount_price = $item['mount_price'];
                        }
                        if ($item['mount_type'] != null) {
                            $cart->mount_type = $item['mount_type'];
                        }
                        if ($item['mount_pos'] != null) {
                            $cart->mount_pos = $item['mount_pos'];
                        }
                        if ($item['spring_assist_price'] != null) {
                            $cart->spring_assist = $item['spring_assist_price'];
                        }
                        if ($item['stack'] != null) {
                            $cart->stack = $item['stack'];
                        }
                        // if($item['coupon_val'] != null) {
                        //     $cart->coupon_discount = $item['coupon_val'];
                        // }
                        if ($item['window_desc'] != null) {
                            $cart->window_desc = $item['window_desc'];
                        }

                        // if($item[''] != null) {
                        //     $cart->control_type = $item[''];
                        // }

                        if ($item['control_type'] != null) {
                            $cart->control_type = $item['control_type'];
                        }
                        if ($item['motor_name'] != null) {
                            $cart->motor_name = $item['motor_name'];
                        }
                        if ($item['motor_pos'] != null) {
                            $cart->motor_pos = $item['motor_pos'];
                        }
                        if ($item['motor_price'] != null) {
                            $cart->motor_price = $item['motor_price'];
                        }
                        if ($item['motor_arr_price'] != null) {
                            $cart->motor_array = $item['motor_arr_price'];
                        }

                        if ($item['channel_price'] != null) {
                            $cart->remote_ctrl_price = $item['channel_price'];
                        }
                        if ($item['channel_name'] != null) {
                            $cart->remote_ctrl_channel = $item['channel_name'];
                        }
                        if ($item['chain_cord'] != null) {
                            $cart->chain_cord = $item['chain_cord'];
                        }
                        if ($item['chain_color'] != null) {
                            $cart->chain_color = $item['chain_color'];
                        }
                        if ($item['chain_ctrl'] != null) {
                            $cart->chain_ctrl = $item['chain_ctrl'];
                        }
                        if ($item['cord_color'] != null) {
                            $cart->cord_color = $item['cord_color'];
                        }
                        if ($item['cord_ctrl'] != null) {
                            $cart->cord_ctrl = $item['cord_ctrl'];
                        }

                        if ($item['hub_price'] != null) {
                            $cart->shadoesmart_hub = $item['hub_price'];
                        }
                        if ($item['transformer_price'] != null) {
                            $cart->shadoesmart_transformer = $item['transformer_price'];
                        }
                        if ($item['solar_price'] != null) {
                            $cart->solar_panel = $item['solar_price'];
                        }
                        if ($item['plugin_price'] != null) {
                            $cart->plug_in_charger = $item['plugin_price'];
                        }
                        $cart->unit_price = $item['price'];
                        $cart->total_price = $item['total'];
                        $cart->suggested_price = $item['suggested_price'];
                        $cart->status = 'Pending';

                        if ($cart->save()) {
                            $success = true;
                        }
                    } else {
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
                        $cart->suggested_price = $cart->total_price;
                        $due_date = date_create($item['due_date']);
                        $cart->due_date = date_format($due_date, "Y-m-d");
                        $cart->status = 'Pending';
                        $cart->date = date('Y-m-d H:i:s');
                        $cart->shipping_id = $ship_last_id;
                        if ($cart->save()) {
                            $success = true;
                        }
                    }
                }

                $order->grand_total = $total;
                $order->save();

            });
        } catch (\Exception $e) {
            $success = false;
            echo $e->getMessage();
        }
        if ($success && $order) {

            // Generate the PDF Here
            $this->generatePDF($order->id);
            $pdf = storage_path('temp/order-confirmation-' . $order->order_no . '.pdf');
            $get_order_no = (int) $get_order_no + 1;
            $set_order_no = CompanySetting::where('keys', 'ORDER_NO')->first();
            $set_order_no->values = $get_order_no;
            $set_order_no->save();

            $this->send_inv_seller($order->id, $ship_addr->id, $pdf, $request->attachment_paths);
            return response()->json([
                'msg' => 'success',
                'order_id' => $get_order_no - 1,
            ]);
        } else {
            echo "failed";
        }
    }

    public function send_inv_seller($order_id, $ship_id, $attachment, $attachment_paths = [])
    {
        if (!$attachment_paths) {
            $attachment_paths = [];
        }
        $cart_items = Xztcart::with('product')->where('order_id', $order_id)->get();
        $ship = XztShippingAddr::where('id', $ship_id)->first();
        $order = Order::where('id', $order_id)->first();
        if (env('ADMIN_MAIL')) {

            $emails = array($ship->email, env('ADMIN_MAIL', 'info@shadeotech.com'));
        } else {
            $emails = array($ship->email);
        }

        try {

            if (file_exists($attachment)) {
                Mail::send('emails/inv_template', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order], function ($messages) use ($ship, $emails, $attachment, $attachment_paths) {
                    $messages->from(env('MAIL_FROM_ADDRESS', 'erp@shadeotech.com'), 'shadeotech@mail.com');
                    $messages->attach($attachment);
                    foreach ($attachment_paths as $path) {
                        if (file_exists($path)) {
                            $messages->attach($path);
                        }
                    }
                    $messages->to($emails, 'Receiver')->subject("Order Confirmation");
                });
            } else {
                Mail::send('emails/inv_template', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order], function ($messages) use ($ship, $emails, $attachment_paths) {
                    $messages->from(env('MAIL_FROM_ADDRESS', 'erp@shadeotech.com'), 'shadeotech@mail.com');
                    foreach ($attachment_paths as $path) {
                        if (file_exists($path)) {
                            $messages->attach($path);
                        }
                    }
                    $messages->to($emails, 'Receiver')->subject("Order Confirmation");
                });
            }

            // Delete attachment
            unlink(storage_path('temp/order-confirmation-' . $order->order_no . '.pdf'));
        } catch (\Exception $e) {
            \Log::info("Mail sending failed with the error " . $e->getMessage());
            \Log::info("Data: " . json_encode($emails) . json_encode($ship));
            Log::error($e->getTraceAsString());
        }
    }

    // Generate the order confirmation pdf
    public function generatePDF($id = 37)
    {
        $cart_items = Xztcart::with('product')->where('order_id', $id)->get();
        $order = Order::where('id', $id)->first();
        $ship = XztShippingAddr::where('id', $order->shipping_id)->first();
        $pdfConfig = [
            'format' => 'A4',
            'mode' => 'utf-8',
            'orientation' => 'p',
            'margin_left' => 4,
            'margin_right' => 4,
            'display_mode' => 'fullpage',
        ];
        $pdf = PDF::loadView('frontend.user.seller.order-confirmation2', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order], [], $pdfConfig);
        return $pdf->save(storage_path('temp/order-confirmation-' . $order->order_no . '.pdf')); // Saving the PDF

        // return view('emails.inv_template', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order]); // Email View
        return view('frontend.user.seller.order-confirmation2', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order]); // PDF View
    }

    public function generateQuotePDF($data)
    {
        /*
        data: {
        userType: number[1 | 0],
        tag: string,
        date: date,
        cart: JSONArray,
        grandTotal: number,
        name: string,
        email: string,
        message: string,
        logo: string,
        }
         */

        $pdfConfig = [
            'format' => 'A4',
            'mode' => 'utf-8',
            'orientation' => 'p',
            'margin_left' => 4,
            'margin_right' => 4,
            'display_mode' => 'fullpage',
        ];

        $pdf = PDF::loadView('frontend.user.seller.quote-confirmation', ["data" => $data], [], $pdfConfig);
        $path = 'temp/quote-confirmation-' . today()->format("Y-m-d") . time() . '.pdf';
        $pdf->save(storage_path($path)); // Saving the PDF
        return storage_path($path);
    }
}