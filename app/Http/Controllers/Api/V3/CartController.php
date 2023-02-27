<?php

namespace App\Http\Controllers\Api\V3;

use App\Category;
use App\Models\CompanySetting;
use App\Models\Coupon;
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
use App\Models\ShadeOptions;
use App\Models\Xztcart;
use App\Models\XztMountposition;
use App\Models\XztShippingAddr;
use App\Models\XztWidMotors;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group  Cart management
 *
 * APIs for managing carts
 */
class CartController extends Controller
{

    /**
     * Get all data for product to create a cart item.
     *
     * This route get product_id and seller_id as input send back data which can be used for creating a new cart item.
     *  Response is a JSON includes following sections.
     *
     * <b>product</b>       --Current products of cart
     *
     * <b>categories</b>    --List of all categories present in system. List include parent categories as top level which include child categories as sub list.
     *
     * <b>tags</b>          --Array of tags associated with product
     *
     * <b>fabric</b>        --List of fabric associated with products
     *
     * <b>price_cat</b>     --Current prouduct category object
     *
     * <b>price_arr</b>     --Two dimensional array includes price data according to each possible width and height
     *
     * <b>distinct_wid</b>  --List of numbers associated with current product category
     *
     * <b>distinct_len</b>  --List of numbers associated with current product category
     *
     * <b>fabric_all</b>    --All fabric present in system
     *
     * <b>shade_opt</b>     --All shade options list associated with current category
     *
     * <b>fab_opt</b>       --All fabric options list associated with current category
     *
     * <b>coupon_arr</b>    --List of coupons whose end date greater then today
     *
     * <b>cust_discount</b> --Seller discount object according to seller_id URI parameter
     *
     * <b>destinations</b>  --All destination, an associative array of {country, country_code}
     *
     * <b>roomtype</b>      --List of rooms sorted by name
     *
     * <b>mount</b>
     *
     * <b>cassette</b>
     *
     * <b>bracket</b>
     *
     * <b>springassist</b>
     *
     * <b>wrap</b>
     *
     * <b>stack</b>
     *
     * <b>mountpos</b>
     *
     * <b>controltype</b>
     *
     * <b>ct_manuals</b>
     *
     * <b>ct_motors</b>
     *
     * <b>ct_wid_motors</b>
     *
     * <b>wid_motor_max</b>
     *
     * <b>invoice</b>       --Lates order number
     *
     * ]
     * @urlParam  id required The ID of the product.
     * @urlParam  seller_id required The ID of seller.
     * @responseFile  responses/product_data_for_cart.get.json
     * @response  404 {
     *  "message": "Invalid Product Id | Seller Id"
     * }
     */
    public function product_data_for_cart($id, $seller_id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'message' => 'Invalid Product Id ' . $id,
            ], 404);
        }
        $seller = User::find($seller_id);
        if (!$seller || ($seller && $seller->user_type != "seller")) {
            return response()->json([
                'message' => 'Invalid Seller Id ' . $seller_id,
            ], 404);
        }
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

        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();

        $fabric_all = Fabric::all();

        $cust_discount = DiscountSeller::where('user_id', $seller_id)->first();

        $destinations = Destination::select('country', 'country_code')->distinct()->get();

        $invoice = CompanySetting::where('keys', 'ORDER_NO')->first();

        return new JsonResponse([
            "product" => $product,
            "categories" => $categories,
            "tags" => $tags,
            "fabric" => $fabric,
            "price_cat" => $price_cat,
            "price_arr" => $price_arr,
            "distinct_wid" => $distinct_wid,
            "distinct_len" => $distinct_len,
            "fabric_all" => $fabric_all,
            "shade_opt" => $shade_opt,
            "fab_opt" => $fab_opt,
            "coupon_arr" => $coupon_arr,
            "cust_discount" => $cust_discount,
            "destinations" => $destinations,
            "roomtype" => $roomtype,
            "mount" => $mount,
            "cassette" => $cassette,
            "bracket" => $bracket,
            "springassist" => $springassist,
            "wrap" => $wrap,
            "stack" => $stack,
            "mountpos" => $mountpos,
            "controltype" => $controltype,
            "ct_manuals" => $ct_manuals,
            "ct_motors" => $ct_motors,
            "ct_wid_motors" => $ct_wid_motors,
            "wid_motor_max" => $wid_motor_max,
            "invoice" => $invoice,
        ]);

    }

    /**
     * @responseFile  responses/products.get.json
     */
    public function products()
    {
        $products = Product::with('category')->where('is_parts', 0)->where('state', 'Active')->where('archived', 0)->orderBy('name', 'asc');
        $products = $products->get();

        foreach ($products as $p) {
            $p->category->parentCategory = $p->category->parentCategory;
            $p->desc = strip_tags($p->description);
        }

        return new JsonResponse($products);
    }

    /**
     * Create a new order. This api route will create a new order for seller [seller_id] with all products data passed with request.
     *
     * @bodyParam seller_id int required The id of the seller. Example: 100
     * @bodyParam products.*.prod_id int required The prod_id field. Example: 60
     * @bodyParam products.*.dealer_name string The dealer_name field. Example: John Deo
     * @bodyParam products.*.order_number string The order_number field. Example: 100-54646356-60
     * @bodyParam products.*.due_date string The due_date field. Example: 20-02-2023
     * @bodyParam products.*.disc_percent double The disc_percent field. Example: 65
     * @bodyParam products.*.shade_price double The shade_price field. Example 465
     * @bodyParam products.*.mount_price double The mount_price field. Example: 40
     * @bodyParam products.*.mount_type string The mount_type field
     * @bodyParam products.*.mount_pos string The mount_pos field
     * @bodyParam products.*.wrap_expose string The wrap_expose field
     * @bodyParam products.*.wrap_price double The wrap_price field
     * @bodyParam products.*.cassette_price double The cassette_price field
     * @bodyParam products.*.cassette_type string The cassette_type field
     * @bodyParam products.*.cassette_color string The cassette_color field
     * @bodyParam products.*.bottom_rail_price double The bottom_rail_price field
     * @bodyParam products.*.bottom_rail string The bottom_rail field
     * @bodyParam products.*.bottom_rail_color string The bottom_rail_color field
     * @bodyParam products.*.brackets_opt string The brackets_opt field
     * @bodyParam products.*.brackets_opt_price double The brackets_opt_price field
     * @bodyParam products.*.spring_assist_price double The spring_assist_price field
     * @bodyParam products.*.cust_side_mark string The cust_side_mark field
     * @bodyParam products.*.project_tag string The project_tag field
     * @bodyParam products.*.room_type string The room_type field
     * @bodyParam products.*.window_desc string The window_desc field
     * @bodyParam products.*.quantity int The quantity field
     * @bodyParam products.*.width int The width field
     * @bodyParam products.*.wid_decimal float The wid_decimal field
     * @bodyParam products.*.length int The length field
     * @bodyParam products.*.len_decimal float The len_decimal field
     * @bodyParam products.*.fabric string The fabric field
     * @bodyParam products.*.stack string The stack field
     * @bodyParam products.*.control_type string The control_type field
     * @bodyParam products.*.motor_name string The motor_name field
     * @bodyParam products.*.motor_pos string The motor_pos field
     * @bodyParam products.*.motor_price double The motor_price field
     * @bodyParam products.*.motor_arr_price double The motor_arr_price field
     * @bodyParam products.*.channel_name string The channel_name field
     * @bodyParam products.*.channel_price double The channel_price field
     * @bodyParam products.*.plugin_price double The plugin_price field
     * @bodyParam products.*.solar_price double The solar_price field
     * @bodyParam products.*.hub_price double The hub_price field
     * @bodyParam products.*.transformer_price double The transformer_price field
     * @bodyParam products.*.chain_cord string The chain_cord field
     * @bodyParam products.*.chain_ctrl string The chain_ctrl field
     * @bodyParam products.*.chain_color string The chain_color field
     * @bodyParam products.*.cord_ctrl string The cord_ctrl field
     * @bodyParam products.*.cord_color string The cord_color field
     * @bodyParam products.*.brackets string The brackets field
     * @bodyParam products.*.sp_instructions string The sp_instructions field
     * @bodyParam products.*.parts int The parts field . Example 0 | 1
     * @bodyParam products.*.price double The price field
     * @bodyParam products.*.suggested_price double The suggested_price field
     * @bodyParam products.*.total double The total field
     *
     * @bodyParam ship.ship_name string required The ship_name of order.
     * @bodyParam ship.ship_email string required The ship_email of order.
     * @bodyParam ship.ship_addr string required The ship_addr of order.
     * @bodyParam ship.ship_addr2 string required The ship_addr2 of order.
     * @bodyParam ship.ship_country string required The ship_country of order.
     * @bodyParam ship.ship_city string required The ship_city of order.
     * @bodyParam ship.ship_zip string required The ship_zip of order.
     *
     * @bodyParam ord_grandtotal double required The grand total amount of order after coupon and discount. Example: 4500
     * @bodyParam coupon_val double required The coupon amount of order if any else pass 0. Example: 0
     *
     * @response  {
     *  "success": true,
     *  "message": "Order created successfully"
     * }
     *
     *
     */

    public function create_order(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'ord_grandtotal' => 'required',
            'seller_id' => 'required',
            'ship.ship_name' => 'required',
            'ship.ship_email' => 'required|email',
            'ship.ship_addr' => 'required',
            'ship.ship_country' => 'required',
            'ship.ship_city' => 'required',
            'ship.ship_zip' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "success" => false,
                "message" => "Please provide all required fields",
                "data" => $validation->getMessageBag()->toArray(),
            ], 201);
        }

        $sellerUser = User::find($request->seller_id);
        if ($sellerUser == null) {
            return response()->json([
                "success" => false,
                "message" => "Seller not found",
            ]);
        }
        $success = false;
        $order = null;
        $ship_addr = new XztShippingAddr;
        $get_order_no = 0;
        try {
            DB::transaction(function () use ($request, $sellerUser, &$success, &$order, &$ship_addr, &$get_order_no) {
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
                $order->user_id = $sellerUser->id;
                $order->grand_total = $request->ord_grandtotal;
                $order->order_no = $get_order_no;
                $order->coupon_discount = $request->coupon_amount;
                $order->shipping_id = $ship_last_id;
                $order->save();
                $order_id = $order->id;

                foreach ($request->products as $item) {

                    $cart = new Xztcart;
                    if ($item['parts'] == 0) {
                        $cart->user_id = $sellerUser->id;
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
                        }if ($item['transformer_price'] != null) {
                            $cart->shadoesmart_transformer = $item['transformer_price'];
                        }if ($item['solar_price'] != null) {
                            $cart->solar_panel = $item['solar_price'];
                        }if ($item['plugin_price'] != null) {
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
                        $cart->user_id = $sellerUser->id;
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
            });

        } catch (\Exception $e) {
            $success = false;
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
                "trace" => $e->getTraceAsString(),
            ]);
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
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $get_order_no - 1,
            ]);
        } else {
            return response()->json([
                "success" => false,
                "message" => "Not able to create new order. Try again",
            ]);
        }

    }

}