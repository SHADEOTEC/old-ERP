<?php

namespace App\Http\Controllers;

use App\Address;
use App\Cart;
use App\Category as AppCategory;
use App\Coupon;
use App\CouponUsage;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\OTPVerificationController;
use App\Mail\InvoiceEmailManager;
use App\Models\Category;
use App\Models\CompanySetting;
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
use App\Models\SellerBank;
use App\Models\SellerShipAddr;
use App\Models\ShadeOptions;
use App\Models\Xztcart;
use App\Models\XztMountposition;
use App\Models\XztShippingAddr;
use App\Models\XztWidMotors;
use App\OrderDetail;
use App\Product;
use App\ProductStock;
use App\SmsTemplate;
use App\User;
use App\Utility\SmsUtility;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductStatusMail;
use App\OrderStatus;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use MehediIitdu\CoreComponentRepository\CoreComponentRepository;
use PDF;
use Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function main_orders(Request $request, $status = null)
    {
        //Shadeotech Dealer Orders
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $sort_searchdate = null;
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('order_no', 'desc');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('products.name', 'like', '%' . $sort_search . '%');
        }

        if ($request->has('searchdate')) {
            $sort_searchdate = date("Y-m-d", strtotime($request->searchdate));
            $orders = $orders->where('created_at', 'like', $sort_searchdate . '%');
        }

        if ($status != null) {
            $orders = $orders->where('status', $status);
        }
        $orders = $orders->get();
        //$orders = $orders->paginate(15);

        // foreach ($orders as $key => $value) {
        //     $order = \App\Order::find($value->id);
        //     $order->viewed = 1;
        //     $order->save();
        // }
        // $orders = $orders->paginate(15);
        // return view('frontend.user.seller.orders', compact('orders', 'payment_status', 'delivery_status', 'sort_search'));
        return view('frontend.user.seller.main_orders', compact('orders', 'sort_search', 'sort_searchdate'));
    }

    public function seller_order_items(Request $request, $id)
    {
        //Shadeotech Dealer Orders Items
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $sort_searchdate = null;
        $orders = DB::table('xztcarts')->where('order_id', $id)->orderBy('xztcarts.id', 'desc')
            ->join('products', 'xztcarts.product_id', '=', 'products.id')
            ->select('xztcarts.*', 'products.name');
        /*$orders = DB::table('orders')
        ->orderBy('id', 'desc')
        //->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->where('seller_id', Auth::user()->id)
        ->select('orders.id')
        ->distinct();

        if ($request->payment_status != null) {
        $orders = $orders->where('payment_status', $request->payment_status);
        $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
        $orders = $orders->where('delivery_status', $request->delivery_status);
        $delivery_status = $request->delivery_status;
        }*/
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('products.name', 'like', '%' . $sort_search . '%');
        }

        if ($request->has('searchdate')) {
            $sort_searchdate = date("Y-m-d", strtotime($request->searchdate));
            $orders = $orders->where('xztcarts.date', $sort_searchdate);
        }

        // if($status != null){
        //     $orders = $orders->where('xztcarts.status', $status);
        // }
        // $orders = $orders->paginate(15);

        // foreach ($orders as $key => $value) {
        //     $order = \App\Order::find($value->id);
        //     $order->viewed = 1;
        //     $order->save();
        // }
        $orders = $orders->get();
        $mainOrder = Order::find($id);
        if ($mainOrder == null) {
            return back();
        }
        if (sizeof($orders) == 0) {
            return back();
        }
        // return view('frontend.user.seller.orders', compact('orders', 'payment_status', 'delivery_status', 'sort_search'));
        return view('frontend.user.seller.orders', compact('orders', 'sort_search', 'sort_searchdate', 'mainOrder'));
    }

    public function index(Request $request, $status = null)
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $sort_searchdate = null;
        $orders = DB::table('xztcarts')->orderBy('xztcarts.id', 'desc')
            ->join('products', 'xztcarts.product_id', '=', 'products.id')
            ->where('xztcarts.user_id', Auth::user()->id)
            ->select('xztcarts.*', 'products.name');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('products.name', 'like', '%' . $sort_search . '%');
        }

        if ($request->has('searchdate')) {
            $sort_searchdate = date("Y-m-d", strtotime($request->searchdate));
            $orders = $orders->where('xztcarts.date', $sort_searchdate);
        }

        if ($status != null) {
            $orders = $orders->where('xztcarts.status', $status);
        }

        $orders = $orders->paginate(15);

        // return view('frontend.user.seller.orders', compact('orders', 'payment_status', 'delivery_status', 'sort_search'));
        return view('frontend.user.seller.main_orders', compact('orders', 'sort_search', 'sort_searchdate'));
    }

    // All Orders
    public function all_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $sort_search = null;
        $delivery_status = null;

        $orders = DB::table('xztcarts')->orderBy('xztcarts.id', 'desc')
            ->join('products', 'xztcarts.product_id', '=', 'products.id')
            ->where('xztcarts.user_id', Auth::user()->id)
            ->select('xztcarts.*', 'products.name');

        // $orders = Xztcart::orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($date != null) {
            $orders = $orders->where('created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->where('created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }
        $orders = $orders->paginate(15);
        return view('backend.sales.all_orders.index', compact('orders', 'sort_search', 'delivery_status', 'date'));
    }

    public function all_orders_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order_shipping_address = json_decode($order->shipping_address);
        $delivery_boys = User::where('city', $order_shipping_address->city)
            ->where('user_type', 'delivery_boy')
            ->get();

        return view('backend.sales.all_orders.show', compact('order', 'delivery_boys'));
    }

    // Inhouse Orders
    public function admin_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $date = $request->date;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        $orders = DB::table('orders')
            ->orderBy('id', 'desc')
            //                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('seller_id', $admin_user_id)
            ->select('orders.id')
            ->distinct();

        if ($request->payment_type != null) {
            $orders = $orders->where('payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')) {
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
        }
        if ($date != null) {
            $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
        }

        $orders = $orders->paginate(15);
        return view('backend.sales.inhouse_orders.index', compact('orders', 'payment_status', 'delivery_status', 'sort_search', 'admin_user_id', 'date'));
    }

    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        return view('backend.sales.inhouse_orders.show', compact('order'));
    }

    // Seller Orders [Shadeotech] Admin
    public function seller_orders(Request $request)
    {
        $date = $request->date;
        $order_status = OrderStatus::with('user')->get();
        $seller_id = $request->seller_id;
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $main_order = Order::with('xztcarts', 'user')->orderBy('order_no', 'desc');
        // dd($main_order);
        $sellers = User::where('user_type', 'seller')->get();

        if ($seller_id) {
            $main_order = $main_order->whereHas('xztcarts', function ($q) use ($seller_id) {
                $q->where('user_id', $seller_id);
            });
        }
        // $i=0;
        $main_order = $main_order->get();
        // dd($main_order);
        // foreach($main_order as $hello){
        //     // echo $i;
        // $test = $hello->xztcarts;
        // dd ($test);
        // // dd($main_order);
        // echo "<br>";
        // }
        // die;
        return view('backend.sales.seller_orders.index', compact('payment_status', 'delivery_status', 'sort_search', 'sellers', 'seller_id', 'date', 'main_order','order_status'));
    }

    public function delivery_note(Request $request, $id)
    {
        $order = Xztcart::find($id);
        // dd($order);
        $seller = User::find($order->user_id);
        $bank = SellerBank::find($order->user_id);
        $ship = XztShippingAddr::where('id', $order->shipping_id)->first();
        $csm = DiscountSeller::where('user_id', $order->user_id)->first();
        $product = Product::with('category')->where('id', $order->product_id)->first();
        return view('backend.sales.seller_orders.seller_invoice', compact('order', 'seller', 'bank', 'ship', 'csm', 'product'));
    }

    public function main_ord_delivery_note(Request $request, $id)
    {
        $order = Xztcart::with('product')->where('order_id', $id)->get();
        $total = Order::find($id);
        if ($total == null) {
            return back();
        }
        if (sizeof($order) == 0) {
            return back();
        }
        $ship_addr = XztShippingAddr::find($total->shipping_id);

        return view('backend.sales.seller_orders.main_ord_delivery_note', compact('order', 'total', 'ship_addr'));
    }

    public function seller_order_invoice(Request $request, $id)
    {
        $order = Xztcart::with('product')->where('order_id', $id)->get();
        $total = Order::find($id);
        if ($total == null) {
            return back();
        }
        if (sizeof($order) == 0) {
            return back();
        }
        $ship_addr = XztShippingAddr::find($total->shipping_id);

        return view('frontend.user.seller.seller_ord_inv', compact('order', 'total', 'ship_addr'));
    }

    public function labels(Request $request, $id)
    {
        $order = Xztcart::find($id);
        // dd($order);
        $seller = User::find($order->user_id);
        $bank = SellerBank::find($order->user_id);
        $ship = SellerShipAddr::where('id', $order->order_number)->first();
        $csm = DiscountSeller::where('user_id', $order->user_id)->first();
        $product = Product::with('category')->where('id', $order->product_id)->first();

        $bar_code_number = explode("-", $order->order_number)[1] . explode("-", $order->order_number)[2];
        if (strlen($bar_code_number) < 13) {
            while (strlen($bar_code_number) < 13) {
                $bar_code_number = 0 . $bar_code_number;
            }
        }
        if (strlen($bar_code_number) > 13) {
            $bar_code_number = substr($bar_code_number, 0, 13);
        }

        return view('backend.sales.seller_orders.labels', compact('order', 'bar_code_number', 'seller', 'bank', 'ship', 'csm', 'product'));
    }

    public function orders_labels_all($id)
    {

        $order = Order::find($id);
        if (!$order) {
            return abort(400);
        }
        $order_items = Xztcart::where('order_id', $id)->get();
        foreach ($order_items as $item) {
            $seller = User::find($item->user_id);
            $item->seller = $seller;
            $bar_code_number = explode("-", $item->order_number)[1] . explode("-", $item->order_number)[2];
            if (strlen($bar_code_number) < 13) {
                while (strlen($bar_code_number) < 13) {
                    $bar_code_number = 0 . $bar_code_number;
                }
            }
            if (strlen($bar_code_number) > 13) {
                $bar_code_number = substr($bar_code_number, 0, 13);
            }
            $item->bar_code_number = $bar_code_number;
        }
        $order = $order_items[0];


        return view('backend.sales.seller_orders.order-labels', compact('order_items', 'order'));
    }

    public function get_lineitems(Request $request, $id)
    {
        $orders = Xztcart::with('product')->where('order_id', $id)->paginate(10);
        return view('backend.sales.seller_orders.lineitems', compact('orders'));
    }

    public function edit_lineitems(Request $request, $order_item_id)
    {
        $order = Xztcart::with('xztshippingaddr')->findOrFail($order_item_id);
        $main_order = Order::find($order->order_id);
        $seller_id = $main_order->user_id;
        $seller = User::find($seller_id);
        $id = $order->product_id;
        $product = Product::findOrFail($id);
        $cust_discount = DiscountSeller::where('user_id', $seller_id)->first();
        $part = $product;
        if ($product->is_parts == 1) {
            return view('backend.sales.seller_orders.order_edit_part', compact('part', 'seller', 'cust_discount', 'order', 'main_order'));
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
        $categories = AppCategory::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        $fabric_all = Fabric::all();

        $destinations = Destination::select('country', 'country_code')->distinct()->get();

        $invoice = CompanySetting::where('keys', 'ORDER_NO')->first();

        //dd($order, $main_order);
        //dd($order, $main_order, $ct_manuals);
        $order->date = Carbon::parse($order->date)->format("Y-m-d");

        return view('backend.sales.seller_orders.order_edit', compact('main_order', 'seller', 'order', 'product', 'categories', 'tags', 'lang', 'fabric', 'price_cat', 'price_arr', 'distinct_wid', 'distinct_len', 'fabric_all', 'shade_opt', 'fab_opt', 'coupon_arr', 'cust_discount', 'destinations', 'roomtype', 'mount', 'cassette', 'bracket', 'springassist', 'wrap', 'stack', 'mountpos', 'controltype', 'ct_manuals', 'ct_motors', 'ct_wid_motors', 'wid_motor_max', 'invoice'));
    }

    public function update_lineitems(Request $request, $order_item_id)
    {

        $cart = Xztcart::with('xztshippingaddr')->find($order_item_id);
        if (!$cart) {
            return response()->json([
                'msg' => 'Error item not found',
            ]);
        }
        $item = $request->product;

        if ($item['parts'] == 1) {
            $cart->project_tag = $item['project_tag'];
            $cart->quantity = $item['quantity'];
            $cart->unit_price = $item['price'];
            $cart->total_price = $item['total'];
            $due_date = date_create($item['due_date']);
            $cart->due_date = date_format($due_date, "Y-m-d");
        } else {
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
            $cart->date = date('Y-m-d H:i:s');

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
        }

        $cart->save();

        $mainOrder = Order::find($cart->order_id);
        $grand_total = 0;
        $allItems = Xztcart::where("order_id", $cart->order_id)->get();
        foreach ($allItems as $order_single_item) {
            $grand_total += $order_single_item->total_price;
        }
        $mainOrder->grand_total = $grand_total;
        $mainOrder->save();
        $this->generatePDF($mainOrder->id);
        $pdf = storage_path('temp/order-update-' . $mainOrder->order_no . '.pdf');

        send_notification($mainOrder, "Updated");

        $this->send_inv_seller($mainOrder->id, $mainOrder->shipping_id, $pdf);

        return response()->json([
            'msg' => 'success',
        ]);
    }

    //Specs
    public function specs(Request $request, $id)
    {
        $order = Xztcart::where('order_number', $id)->first();
        $seller = User::find($order->user_id);
        $bank = SellerBank::find($order->user_id);
        $ship = XztShippingAddr::where('id', $order->shipping_id)->first();
        // dd($ship);
        $csm = DiscountSeller::where('user_id', $order->user_id)->first();
        $product = Product::with('category')->where('id', $order->product_id)->first();
        return view('backend.sales.seller_orders.specs', compact('order', 'seller', 'bank', 'ship', 'csm', 'product'));
    }

    public function seller_orders_show($id)
    {
        // $order = Xztcart::where('order_number', $id)->first();
        $order = Order::where('order_no', $id)->first();
        return view('backend.sales.seller_orders.ord_details', compact('order'));
    }

    public function seller_status_upd(Request $request)
    {
        $order = Order::where('order_no', $request->order_number)->first();
        if ($order) {
            if ($request->has('status')) {
                Xztcart::where('order_number', $request->order_number)->update([
                    'status' => $request->status,
                ]);
                Order::where('order_no', $request->order_number)->update([
                    'status' => $request->status,
                ]);
                Xztcart::where("order_id", $order->id)->update([
                    'status' => $request->status,
                ]);
            }
        }
        $email = User::find($order->user_id)->email;
        $subject = 'Mail from shadeotech';
        $data = array(
            'order_no' => $order->order_no,
            'status' => $order->status,
        );
        // Mail::to($email)->send(new ProductStatusMail($order));
        Mail::send('emails.statusmail', $data, function ($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });
        return redirect()->route('seller_orders.index');
    }

    // Pickup point orders
    public function pickup_point_order_index(Request $request)
    {
        $date = $request->date;
        $sort_search = null;

        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        } else {
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                ->orderBy('code', 'desc')
                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->where('order_details.shipping_type', 'pickup_point')
                ->select('orders.id')
                ->distinct();

            if ($request->has('search')) {
                $sort_search = $request->search;
                $orders = $orders->where('code', 'like', '%' . $sort_search . '%');
            }
            if ($date != null) {
                $orders = $orders->whereDate('orders.created_at', '>=', date('Y-m-d', strtotime(explode(" to ", $date)[0])))->whereDate('orders.created_at', '<=', date('Y-m-d', strtotime(explode(" to ", $date)[1])));
            }

            $orders = $orders->paginate(15);

            return view('backend.sales.pickup_point_orders.index', compact('orders', 'sort_search', 'date'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        } else {
            $order = Order::findOrFail(decrypt($id));
            return view('backend.sales.pickup_point_orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        if (Auth::check()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->guest_id = mt_rand(100000, 999999);
        }

        $carts = Cart::where('user_id', Auth::user()->id)
            ->where('owner_id', $request->owner_id)
            ->get();

        if ($carts->isEmpty()) {
            flash(translate('Your cart is empty'))->warning();
            return redirect()->route('home');
        }

        $shipping_info = Address::where('id', $carts[0]['address_id'])->first();
        $shipping_info->name = Auth::user()->name;
        $shipping_info->email = Auth::user()->email;
        if ($shipping_info->latitude || $shipping_info->longitude) {
            $shipping_info->lat_lang = $shipping_info->latitude . ',' . $shipping_info->longitude;
        }

        $order->seller_id = $request->owner_id;
        $order->shipping_address = json_encode($shipping_info);

        $order->payment_type = $request->payment_option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->code = date('Ymd-His') . rand(10, 99);
        $order->date = strtotime('now');

        if ($order->save()) {
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();

            //Order Details Storing
            foreach ($carts as $key => $cartItem) {
                $product = Product::find($cartItem['product_id']);

                if ($product->added_by == 'admin') {
                    array_push($admin_products, $cartItem['product_id']);
                } else {
                    $product_ids = array();
                    if (array_key_exists($product->user_id, $seller_products)) {
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem['product_id']);
                    $seller_products[$product->user_id] = $product_ids;
                }

                $subtotal += $cartItem['price'] * $cartItem['quantity'];
                $tax += $cartItem['tax'] * $cartItem['quantity'];

                $product_variation = $cartItem['variation'];

                $product_stock = $product->stocks->where('variant', $product_variation)->first();
                if ($product->digital != 1 && $cartItem['quantity'] > $product_stock->qty) {
                    flash(translate('The requested quantity is not available for ') . $product->getTranslation('name'))->warning();
                    $order->delete();
                    return redirect()->route('cart')->send();
                } elseif ($product->digital != 1) {
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->shipping_type = $cartItem['shipping_type'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];
                $order_detail->shipping_cost = $cartItem['shipping_cost'];

                $shipping += $order_detail->shipping_cost;

                if ($cartItem['shipping_type'] == 'pickup_point') {
                    $order_detail->pickup_point_id = $cartItem['pickup_point'];
                }
                //End of storing shipping cost

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();

                if (
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated
                ) {
                    if ($order_detail->product_referral_code) {
                        $referred_by_user = User::where('referral_code', $order_detail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, $order_detail->quantity, 0, 0);
                    }
                }
            }

            $order->grand_total = $subtotal + $tax + $shipping;

            if ($carts->first()->coupon_code != '') {
                $order->grand_total -= $carts->sum('discount');
                if (Session::has('club_point')) {
                    $order->club_point = Session::get('club_point');
                }
                $order->coupon_discount = $carts->sum('discount');

                //                $clubpointController = new ClubPointController;
                //                $clubpointController->deductClubPoints($order->user_id, Session::get('club_point'));

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Coupon::where('code', $carts->first()->coupon_code)->first()->id;
                $coupon_usage->save();
            }

            $order->save();

            $array['view'] = 'emails.invoice';
            $array['subject'] = translate('Your order has been placed') . ' - ' . $order->code;
            $array['from'] = env('MAIL_FROM_ADDRESS');
            $array['order'] = $order;

            foreach ($seller_products as $key => $seller_product) {
                try {
                    Mail::to(\App\User::find($key)->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            if (
                \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
                SmsTemplate::where('identifier', 'order_placement')->first()->status == 1
            ) {
                try {
                    $otpController = new OTPVerificationController;
                    $otpController->send_order_code($order);
                } catch (\Exception $e) {
                }
            }

            //sends Notifications to user
            send_notification($order, 'placed');
            if (get_setting('google_firebase') == 1 && $order->user->device_token != null) {
                $request->device_token = $order->user->device_token;
                $request->title = "Order placed !";
                $request->text = " An order {$order->code} has been placed";

                $request->type = "order";
                $request->id = $order->id;
                $request->user_id = $order->user->id;

                send_firebase_notification($request);
            }

            //sends email to customer with the invoice pdf attached
            if (env('MAIL_USERNAME') != null) {
                try {
                    Mail::to(Auth::user()->email)->queue(new InvoiceEmailManager($array));
                    Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            $request->session()->put('order_id', $order->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order != null) {
            foreach ($order->orderDetails as $key => $orderDetail) {
                try {

                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)->where('variant', $orderDetail->variation)->first();
                    if ($product_stock != null) {
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                } catch (\Exception $e) {
                }

                $orderDetail->delete();
            }
            $order->delete();
            flash(translate('Order has been deleted successfully'))->success();
        } else {
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function bulk_order_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $order_id) {
                $this->destroy($order_id);
            }
        }

        return 1;
    }

    public function order_details($id)
    {
        $order = Xztcart::with('xztshippingaddr')->findOrFail($id);
        $mainOrder = Order::findOrFail($order->order_id);

        // $order->save();
        return view('frontend.user.seller.order_details', compact('order', 'mainOrder'));
    }

    public function order_edit(Request $request, $order_item_id)
    {
        $order = Xztcart::with('xztshippingaddr')->findOrFail($order_item_id);
        $id = $order->product_id;
        $product = Product::findOrFail($id);
        $cust_discount = DiscountSeller::where('user_id', Auth::user()->id)->first();
        $part = $product;
        $main_order = Order::find($order->order_id);
        if ($product->is_parts == 1) {
            return view('frontend.user.seller.order_edit_part', compact('part', 'cust_discount', 'order', 'main_order'));
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
        $categories = AppCategory::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        $fabric_all = Fabric::all();

        $destinations = Destination::select('country', 'country_code')->distinct()->get();

        $invoice = CompanySetting::where('keys', 'ORDER_NO')->first();

        //dd($order, $main_order);
        //dd($order, $main_order, $ct_manuals);
        $order->date = Carbon::parse($order->date)->format("Y-m-d");

        return view('frontend.user.seller.order_edit', compact('main_order', 'order', 'product', 'categories', 'tags', 'lang', 'fabric', 'price_cat', 'price_arr', 'distinct_wid', 'distinct_len', 'fabric_all', 'shade_opt', 'fab_opt', 'coupon_arr', 'cust_discount', 'destinations', 'roomtype', 'mount', 'cassette', 'bracket', 'springassist', 'wrap', 'stack', 'mountpos', 'controltype', 'ct_manuals', 'ct_motors', 'ct_wid_motors', 'wid_motor_max', 'invoice'));
    }

    public function order_seller_update(Request $request, $order_item_id)
    {

        $cart = Xztcart::with('xztshippingaddr')->findOrFail($order_item_id);
        $item = $request->product;

        if ($item['parts'] == 1) {
            $cart->project_tag = $item['project_tag'];
            $cart->quantity = $item['quantity'];
            $cart->unit_price = $item['price'];
            $cart->total_price = $item['total'];
            $due_date = date_create($item['due_date']);
            $cart->due_date = date_format($due_date, "Y-m-d");
        } else {
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
            $cart->date = date('Y-m-d H:i:s');

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
        }

        $cart->save();

        $mainOrder = Order::find($cart->order_id);
        $grand_total = 0;
        $allItems = Xztcart::where("order_id", $cart->order_id)->get();
        foreach ($allItems as $order_single_item) {
            $grand_total += $order_single_item->total_price;
        }
        $mainOrder->grand_total = $grand_total;
        $mainOrder->save();
        $this->generatePDF($mainOrder->id);
        $pdf = storage_path('temp/order-update-' . $mainOrder->order_no . '.pdf');

        send_notification($mainOrder, "Updated");

        $this->send_inv_seller($mainOrder->id, $mainOrder->shipping_id, $pdf);

        return response()->json([
            'msg' => 'success',
        ]);
    }

    public function order_delete($order_item_id)
    {
        $cart = Xztcart::findOrFail($order_item_id);
        $mainOrder = Order::find($cart->order_id);
        $allOrderItemsSize = Xztcart::where("order_id", $mainOrder->id)->count();
        if ($allOrderItemsSize <= 1) {
            $cart->delete();
            $mainOrder->delete();
            if (Auth::user()->user_type == "admin") {
                return redirect(route('seller_orders.index'));
            } else {
                return redirect(route('orders.main'));
            }
        } else {
            $grand_total = $mainOrder->grand_total - $cart->total_price;
            $mainOrder->grand_total = $grand_total;
            $mainOrder->save();
            $cart->delete();
        }
        return redirect()->back();
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $order->delivery_status = $request->status;
        $order->save();

        if ($request->status == 'cancelled' && $order->payment_type == 'wallet') {
            $user = User::where('id', $order->user_id)->first();
            $user->balance += $order->grand_total;
            $user->save();
        }

        if (Auth::user()->user_type == 'seller') {
            foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
                    $variant = $orderDetail->variation;
                    if ($orderDetail->variation == null) {
                        $variant = '';
                    }

                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                        ->where('variant', $variant)
                        ->first();

                    if ($product_stock != null) {
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {

                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();

                if ($request->status == 'cancelled') {
                    $variant = $orderDetail->variation;
                    if ($orderDetail->variation == null) {
                        $variant = '';
                    }

                    $product_stock = ProductStock::where('product_id', $orderDetail->product_id)
                        ->where('variant', $variant)
                        ->first();

                    if ($product_stock != null) {
                        $product_stock->qty += $orderDetail->quantity;
                        $product_stock->save();
                    }
                }

                if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                    if (($request->status == 'delivered' || $request->status == 'cancelled') &&
                        $orderDetail->product_referral_code
                    ) {

                        $no_of_delivered = 0;
                        $no_of_canceled = 0;

                        if ($request->status == 'delivered') {
                            $no_of_delivered = $orderDetail->quantity;
                        }
                        if ($request->status == 'cancelled') {
                            $no_of_canceled = $orderDetail->quantity;
                        }

                        $referred_by_user = User::where('referral_code', $orderDetail->product_referral_code)->first();

                        $affiliateController = new AffiliateController;
                        $affiliateController->processAffiliateStats($referred_by_user->id, 0, 0, $no_of_delivered, $no_of_canceled);
                    }
                }
            }
        }
        if (
            \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
            \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
            SmsTemplate::where('identifier', 'delivery_status_change')->first()->status == 1
        ) {
            try {
                SmsUtility::delivery_status_change($order->user->phone, $order);
            } catch (\Exception $e) {
            }
        }

        //sends Notifications to user
        send_notification($order, $request->status);
        if (get_setting('google_firebase') == 1 && $order->user->device_token != null) {
            $request->device_token = $order->user->device_token;
            $request->title = "Order updated !";
            $status = str_replace("_", "", $order->delivery_status);
            $request->text = " Your order {$order->code} has been {$status}";

            $request->type = "order";
            $request->id = $order->id;
            $request->user_id = $order->user->id;

            send_firebase_notification($request);
        }

        if (
            \App\Addon::where('unique_identifier', 'delivery_boy')->first() != null &&
            \App\Addon::where('unique_identifier', 'delivery_boy')->first()->activated
        ) {

            if (Auth::user()->user_type == 'delivery_boy') {
                $deliveryBoyController = new DeliveryBoyController;
                $deliveryBoyController->store_delivery_history($order);
            }
        }

        return 1;
    }

    //    public function bulk_order_status(Request $request) {
    ////        dd($request->all());
    //        if($request->id) {
    //            foreach ($request->id as $order_id) {
    //                $order = Order::findOrFail($order_id);
    //                $order->delivery_viewed = '0';
    //                $order->save();
    //
    //                $this->change_status($order, $request);
    //            }
    //        }
    //
    //        return 1;
    //    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();

        if (Auth::user()->user_type == 'seller') {
            foreach ($order->orderDetails->where('seller_id', Auth::user()->id) as $key => $orderDetail) {
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        } else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach ($order->orderDetails as $key => $orderDetail) {
            if ($orderDetail->payment_status != 'paid') {
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();

        if ($order->payment_status == 'paid' && $order->commission_calculated == 0) {
            commission_calculation($order);

            $order->commission_calculated = 1;
            $order->save();
        }

        //sends Notifications to user
        send_notification($order, $request->status);
        if (get_setting('google_firebase') == 1 && $order->user->device_token != null) {
            $request->device_token = $order->user->device_token;
            $request->title = "Order updated !";
            $status = str_replace("_", "", $order->payment_status);
            $request->text = " Your order {$order->code} has been {$status}";

            $request->type = "order";
            $request->id = $order->id;
            $request->user_id = $order->user->id;

            send_firebase_notification($request);
        }

        if (
            \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
            \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
            SmsTemplate::where('identifier', 'payment_status_change')->first()->status == 1
        ) {
            try {
                SmsUtility::payment_status_change($order->user->phone, $order);
            } catch (\Exception $e) {
            }
        }
        return 1;
    }

    public function assign_delivery_boy(Request $request)
    {
        if (\App\Addon::where('unique_identifier', 'delivery_boy')->first() != null && \App\Addon::where('unique_identifier', 'delivery_boy')->first()->activated) {

            $order = Order::findOrFail($request->order_id);
            $order->assign_delivery_boy = $request->delivery_boy;
            $order->delivery_history_date = date("Y-m-d H:i:s");
            $order->save();

            $delivery_history = \App\DeliveryHistory::where('order_id', $order->id)
                ->where('delivery_status', $order->delivery_status)
                ->first();

            if (empty($delivery_history)) {
                $delivery_history = new \App\DeliveryHistory;

                $delivery_history->order_id = $order->id;
                $delivery_history->delivery_status = $order->delivery_status;
                $delivery_history->payment_type = $order->payment_type;
            }
            $delivery_history->delivery_boy_id = $request->delivery_boy;

            $delivery_history->save();

            if (env('MAIL_USERNAME') != null && get_setting('delivery_boy_mail_notification') == '1') {
                $array['view'] = 'emails.invoice';
                $array['subject'] = translate('You are assigned to delivery an order. Order code') . ' - ' . $order->code;
                $array['from'] = env('MAIL_FROM_ADDRESS');
                $array['order'] = $order;

                try {
                    Mail::to($order->delivery_boy->email)->queue(new InvoiceEmailManager($array));
                } catch (\Exception $e) {
                }
            }

            if (
                \App\Addon::where('unique_identifier', 'otp_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'otp_system')->first()->activated &&
                SmsTemplate::where('identifier', 'assign_delivery_boy')->first()->status == 1
            ) {
                try {
                    SmsUtility::assign_delivery_boy($order->delivery_boy->phone, $order->code);
                } catch (\Exception $e) {
                }
            }
        }

        return 1;
    }

    public function send_inv_seller($order_id, $ship_id, $attachment)
    {
        $cart_items = Xztcart::with('product')->where('order_id', $order_id)->get();
        $ship = XztShippingAddr::where('id', $ship_id)->first();
        $order = Order::where('id', $order_id)->first();

        $emails = array($ship->email, env('ADMIN_MAIL'));

        try {

            if (file_exists($attachment)) {
                Mail::send('emails/inv_template', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order], function ($messages) use ($ship, $emails, $attachment) {
                    $messages->from(env('MAIL_USERNAME'), 'Shadeotech');
                    $messages->attach($attachment);
                    $messages->to($emails, 'Receiver')->subject("Order Confirmation");
                });
            } else {
                Mail::send('emails/inv_template', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order], function ($messages) use ($ship, $emails) {
                    $messages->from(env('MAIL_USERNAME'), 'Shadeotech');
                    $messages->to($emails, 'Receiver')->subject("Order Confirmation");
                });
            }

            // Delete attachment
            unlink(storage_path('temp/order-confirmation-' . $order->order_no . '.pdf'));
        } catch (\Exception $e) {
            \Log::info("Mail sending failed with the error " . $e->getMessage());
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
        // return view('frontend.user.seller.order-confirmation2', ['cart_items' => $cart_items, 'ship' => $ship, 'order' => $order]); // PDF View
    }
}
