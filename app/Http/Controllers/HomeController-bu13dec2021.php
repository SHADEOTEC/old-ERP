<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Hash;
use App\Category;
use App\FlashDeal;
use App\Brand;
use App\Product;
use App\PickupPoint;
use App\CustomerPackage;
use App\CustomerProduct;
use App\User;
use App\Address;
use App\Seller;
use App\Shop;
use App\Color;
use App\Order;
use App\BusinessSetting;
use App\Http\Controllers\SearchController;
use ImageOptimizer;
use Cookie;
use Illuminate\Support\Str;
use App\Mail\SecondEmailVerifyMailManager;
use Mail;
use App\Utility\TranslationUtility;
use App\Utility\CategoryUtility;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\Fabric;
use App\Models\Price;
use App\Models\ShadeOptions;
use App\Models\FabricOptions;
use App\Models\Xztcart;
use App\Models\Coupon;
Use \Carbon\Carbon;
use App\Models\DiscountSeller;
use App\Models\Destination;
use App\Models\ProductMount;
use App\Models\ProductCassette;
use App\Models\ProductFabric;
use App\Models\ProductBracket;
use App\Models\ProductSpringassist;
use App\Models\ProductRoomtype;
use App\Models\ProductStack;
use App\Models\ProductControltype;
use App\Models\XztCassette;
use App\Models\XztWrap;
use App\Models\ProductWrap;
use App\Models\XztMountposition;
use App\Models\XztManualCts;
use App\Models\XztMotorCts;
use App\Models\XztWidMotors;
use App\Models\CassetteColor;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('frontend.user_login');
    }

    public function registration(Request $request)
    {
        if(Auth::check()){
            return redirect()->route('home');
        }
        if($request->has('referral_code') &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {

            try {
                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }

                Cookie::queue('referral_code', $request->referral_code, $cookie_minute);
                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            } catch (\Exception $e) {

            }
        }
        return view('frontend.user_registration');
    }

    public function cart_login(Request $request)
    {
        $user = User::whereIn('user_type', ['customer', 'seller'])->where('email', $request->email)->orWhere('phone', $request->email)->first();
        if($user != null){
            if(Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }
                else{
                    auth()->login($user, false);
                }
            }
            else {
                flash(translate('Invalid email or password!'))->warning();
            }
        }
        return back();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_dashboard()
    {
        $dealers = count(User::where('user_type','seller')->get());
        $orders = count(Xztcart::get());
        $categories = count(Category::get());
        $products = count(Product::get());
        return view('backend.dashboard', compact('dealers', 'orders', 'categories', 'products'));
    }

    /**
     * Show the customer/seller dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $total_orders = 0;
        $t_orders_pending = 0;
        $t_orders_cancelled = 0;
        $t_orders_success = 0;
        $t_products = 0;
        
        $total_orders = count(Xztcart::where('user_id', Auth::user()->id)->get());
        $t_orders_pending = count(Xztcart::where('status', 'Pending')->where('user_id', Auth::user()->id)->get());
        $t_orders_cancelled = count(Xztcart::where('status', 'Cancelled')->where('user_id', Auth::user()->id)->get());
        $t_orders_success = count(Xztcart::where('status', 'Ready')->where('user_id', Auth::user()->id)->get());
        $t_products = count(Product::where('state', 'Active')->get());
        // dd($t_orders_pending);

        if(Auth::user()->user_type == 'seller'){
            return view('frontend.user.seller.dashboard', compact('total_orders', 't_orders_pending', 't_orders_cancelled', 't_orders_success', 't_products'));
        }
        // if(Auth::user()->user_type == 'seller'){

        //     return view('frontend.user.seller.dashboard', compact('total_orders', 't_orders_pending', 't_orders_cancelled', 't_orders_success', 't_products'));
        // }
        // elseif(Auth::user()->user_type == 'customer'){
        //     return view('frontend.user.customer.dashboard');
        // }
        // elseif(Auth::user()->user_type == 'delivery_boy'){
        //     return view('delivery_boys.frontend.dashboard');
        // }
        // else {
        //     abort(404);
        // }
    }

    public function profile(Request $request)
    {
        if(Auth::user()->user_type == 'customer'){
            return view('frontend.user.customer.profile');
        }
        elseif(Auth::user()->user_type == 'delivery_boy'){
            return view('delivery_boys.frontend.profile');
        }
        elseif(Auth::user()->user_type == 'seller'){
            $profile_data = User::where('id', Auth::user()->id)->first();
            // dd($profile_data);
            return view('frontend.user.seller.profile', compact('profile_data'));
        }
    }

    public function customer_update_profile(Request $request)
    {
        if(env('DEMO_MODE') == 'On'){
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = Auth::user();
        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;

        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        if($user->save()){
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }


    public function seller_update_profile(Request $request)
    {
        if(env('DEMO_MODE') == 'On'){
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }
        // $user = Auth::user();
        // $user->name = $request->name;
        // $user->address = $request->address;
        // $user->country = $request->country;
        // $user->city = $request->city;
        // $user->postal_code = $request->postal_code;
        // $user->phone = $request->phone;
        $user = User::where('id', Auth::user()->id)->first();
        // dd($_POST);
        if ($request->has('website')) {
            $user->website = $request->website;
        }
        if ($request->has('facebook')) {
            $user->facebook = $request->facebook;
        }
        if ($request->has('twitter')) {
            $user->twitter = $request->twitter;
        }

        // if($request->new_password != null && ($request->new_password == $request->confirm_password)){
        //     $user->password = Hash::make($request->new_password);
        // }
        // $user->avatar_original = $request->photo;

        // $seller = $user->seller;
        // $seller->cash_on_delivery_status = $request->cash_on_delivery_status;
        // $seller->bank_payment_status = $request->bank_payment_status;
        // $seller->bank_name = $request->bank_name;
        // $seller->bank_acc_name = $request->bank_acc_name;
        // $seller->bank_acc_no = $request->bank_acc_no;
        // $seller->bank_routing_no = $request->bank_routing_no;

        // if($user->save() && $seller->save()){
        if($user->save()){
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
    }

    /**
     * Show the application frontend home.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user() == null) {
            return view('auth.login');
        }
        else if(Auth::user()->user_type == 'seller'){
            return view('frontend.user.seller.dashboard');
        }
        elseif(Auth::user()->user_type == 'customer'){
            return view('frontend.user.customer.dashboard');
        }
        elseif(Auth::user()->user_type == 'delivery_boy'){
            return view('delivery_boys.frontend.dashboard');
        }
        elseif(Auth::user()->user_type == 'admin'){
            return view('backend.dashboard');
        }
        else {
            abort(404);
        }
        // return view('frontend.index');
        // if(auth()->user() != null && (auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')){
        //     $redirect_route = 'dashboard';
        // }
        // else{
        //     $redirect_route = 'login'; // user.login
        // }
        // return redirect()->route($redirect_route);
    }

    public function flash_deal_details($slug)
    {
        $flash_deal = FlashDeal::where('slug', $slug)->first();
        if($flash_deal != null)
            return view('frontend.flash_deal_details', compact('flash_deal'));
        else {
            abort(404);
        }
    }

    public function load_featured_section(){
        return view('frontend.partials.featured_products_section');
    }

    public function load_best_selling_section(){
        return view('frontend.partials.best_selling_section');
    }

    public function load_home_categories_section(){
        return view('frontend.partials.home_categories_section');
    }

    public function load_best_sellers_section(){
        return view('frontend.partials.best_sellers_section');
    }

    public function trackOrder(Request $request)
    {
        if($request->has('order_code')){
            $order = Order::where('code', $request->order_code)->first();
            if($order != null){
                return view('frontend.track_order', compact('order'));
            }
        }
        return view('frontend.track_order');
    }

    public function product(Request $request, $slug)
    {
        $detailedProduct  = Product::where('slug', $slug)->where('approved', 1)->first();

        if($detailedProduct != null && $detailedProduct->published){
            //updateCartSetup();
            if($request->has('product_referral_code') &&
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first() != null &&
                    \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {

                $affiliate_validation_time = \App\AffiliateConfig::where('type', 'validation_time')->first();
                $cookie_minute = 30 * 24;
                if($affiliate_validation_time) {
                    $cookie_minute = $affiliate_validation_time->value * 60;
                }
                Cookie::queue('product_referral_code', $request->product_referral_code, $cookie_minute);
                Cookie::queue('referred_product_id', $detailedProduct->id, $cookie_minute);

                $referred_by_user = User::where('referral_code', $request->product_referral_code)->first();

                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliateStats($referred_by_user->id, 1, 0, 0, 0);
            }
            if($detailedProduct->digital == 1){
                return view('frontend.digital_product_details', compact('detailedProduct'));
            }
            else {
                return view('frontend.product_details', compact('detailedProduct'));
            }
            // return view('frontend.product_details', compact('detailedProduct'));
        }
        abort(404);
    }

    public function shop($slug)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null){
            $seller = Seller::where('user_id', $shop->user_id)->first();
            if ($seller->verification_status != 0){
                return view('frontend.seller_shop', compact('shop'));
            }
            else{
                return view('frontend.seller_shop_without_verification', compact('shop', 'seller'));
            }
        }
        abort(404);
    }

    public function filter_shop($slug, $type)
    {
        $shop  = Shop::where('slug', $slug)->first();
        if($shop!=null && $type != null){
            return view('frontend.seller_shop', compact('shop', 'type'));
        }
        abort(404);
    }

    public function all_categories(Request $request)
    {
//        $categories = Category::where('level', 0)->orderBy('name', 'asc')->get();
        $categories = Category::where('level', 0)->orderBy('order_level', 'desc')->get();
        return view('frontend.all_category', compact('categories'));
    }
    public function all_brands(Request $request)
    {
        $categories = Category::all();
        return view('frontend.all_brand', compact('categories'));
    }

    public function show_product_upload_form(Request $request)
    {
        if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
            if(Auth::user()->seller->remaining_uploads > 0){
                $categories = Category::where('parent_id', 0)
                    ->where('digital', 0)
                    ->with('childrenCategories')
                    ->get();
                return view('frontend.user.seller.product_upload', compact('categories'));
            }
            else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_upload', compact('categories'));
    }

    public function profile_edit(Request $request){
    }

    public function show_product_edit_form(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $lang = $request->lang;
        $tags = json_decode($product->tags);
        $categories = Category::where('parent_id', 0)
            ->where('digital', 0)
            ->with('childrenCategories')
            ->get();
        return view('frontend.user.seller.product_edit', compact('product', 'categories', 'tags', 'lang'));
    }

    public function show_product_cart_form(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $fabric = ProductFabric::with('xztfabric')->where('product_id','=', $id)->get();
        $mount = ProductMount::with('xztmount')->where('product_id','=', $id)->get();
        $cassette = ProductCassette::with('xztcassette')->where('product_id','=', $id)->get();
        $bracket = ProductBracket::with('xztbracket')->where('product_id','=', $id)->get();
        $springassist = ProductSpringassist::with('xztspringassist')->where('product_id','=', $id)->get();
        $roomtype = ProductRoomtype::with('xztroomtype')->where('product_id','=', $id)->get();
        $stack = ProductStack::with('xztstack')->where('product_id','=', $id)->get();
        $controltype = ProductControltype::where('product_id','=', $id)->get();
        $ct_manuals = ProductControltype::with('manual')->where('product_id','=', $id)->where('ct_manual_id','<>', null)->get();
        $ct_motors = ProductControltype::with('motor')->where('product_id','=', $id)->where('ct_motor_id','<>', null)->get();
        $ct_wid_motors = ProductControltype::with('width')->where('product_id','=', $id)->where('ct_widmotor_code','<>', null)->first();
        if(isset($ct_wid_motors->ct_widmotor_code)) { 
            $wid_motor_max = XztWidMotors::where('ct_code', $ct_wid_motors->ct_widmotor_code)->max('max_wid'); 
        }else {
            $wid_motor_max = '';
        }
        // dd($ct_wid_motors);

        // dd(stripos($ct_manuals[0]->manual->ct_code, 'chain'));
        $wrap = ProductWrap::with('xztwrap')->where('product_id','=', $id)->first();
        $mountpos = XztMountposition::all();
        
        $price_cat = Category::select('*')->where('id', $product->category_id)->first();

        $wid_len = Price::select('id', 'cat_id', 'price_code', 'width', 'length', 'price', 'square_cassette', 'fabric_wrap', 'std_r_cassette', 'wid_diff', 'len_diff', 'motor_array', 'round_cassette')
            ->where('cat_id', $product->category->parentCategory->id)
            ->where('shade_code', $product->shade_code)
            ->get();
        
        $price_arr = [];
        foreach($wid_len as $key => $item) {
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
        $coupons = Coupon::where('end_date','>', $today_date)->get();

        $coupon_arr = [];
        foreach($coupons as $key => $item) {
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

        $cust_discount = DiscountSeller::where('user_id', Auth::user()->id)->first();

        $destinations = Destination::select('country', 'country_code')->distinct()->get();

        return view('frontend.user.seller.product_cart', compact('product', 'categories', 'tags', 'lang', 'fabric','price_cat', 'price_arr', 'distinct_wid', 'distinct_len', 'fabric_all', 'shade_opt', 'fab_opt', 'coupon_arr', 'cust_discount', 'destinations', 'roomtype', 'mount', 'cassette', 'bracket', 'springassist', 'wrap', 'stack', 'mountpos', 'controltype', 'ct_manuals', 'ct_motors', 'ct_wid_motors', 'wid_motor_max'));
    }

    public function getmyprice(Request $request) {
        if($request->cassette_code == -1) {
            $cassette_price = 0;
        }else {
            $max = XztCassette::where('cassette_code', $request->cassette_code)->max('max_wid');
            $width = $request->width;
            $fraction = $request->fraction;
            if($fraction > 0 && $width < $max) {
                $width = $width + 1;
            }
            $price_table = XztCassette::select('min_wid', 'max_wid', 'price')->where('cassette_code', $request->cassette_code)->get();
            foreach($price_table as $item) {
                if($width >= $item->min_wid && $width <= $item->max_wid) {
                    $cassette_price = $item->price;
                }
            }
            // echo $cassette_price;
        }
        if($request->wrap_code == -1) {
            $wrap_price = 0;
        }else {
            $max = XztWrap::where('wrap_code', $request->wrap_code)->max('max_wid');
            $width = $request->width;
            $fraction = $request->fraction;
            if($fraction > 0 && $width < $max) {
                $width = $width + 1;
            }
            $price_table = XztWrap::select('min_wid', 'max_wid', 'price')->where('wrap_code', $request->wrap_code)->get();
            foreach($price_table as $item) {
                if($width >= $item->min_wid && $width <= $item->max_wid) {
                    $wrap_price = $item->price;
                }
            }
            // echo $wrap_price;
        }
        $return_arr = array();
        
        $return_arr[] = array(
            "cassette_price" => $cassette_price,
            "wrap_price" => $wrap_price
        ); 
        echo json_encode($return_arr);
    }

    public function seller_product_list(Request $request)
    {
        $search = null;
        $categories = Category::where('parent_id', 1)->get();
        $products = Product::with('category')->where('is_parts', 0)->where('state', 'Active')->where('archived', 0)->orderBy('created_at', 'desc');
        
        if ($request->has('search')) {
            $search = $request->search;
            $products = $products->where('name', 'like', '%'.$search.'%');
        }
        if ($request->has('searchsubcat') && $request->has('searchcat')){
            $searchsubcat = $request->searchsubcat;
            $products = $products->where('category_id', $searchsubcat);
        }
        
        $products = $products->paginate(10);
        return view('frontend.user.seller.products', compact('products', 'search', 'categories'));
    }

    public function ajax_search(Request $request)
    {
        $keywords = array();
        $products = Product::where('published', 1)->where('tags', 'like', '%'.$request->search.'%')->get();
        foreach ($products as $key => $product) {
            foreach (explode(',',$product->tags) as $key => $tag) {
                if(stripos($tag, $request->search) !== false){
                    if(sizeof($keywords) > 5){
                        break;
                    }
                    else{
                        if(!in_array(strtolower($tag), $keywords)){
                            array_push($keywords, strtolower($tag));
                        }
                    }
                }
            }
        }
        
        $products = filter_products(Product::query());
        
        $products = $products->where('published', 1)
                        ->where(function ($q) use($request) {
                            $q->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('tags', 'like', '%'.$request->search.'%');
                        })
                    ->get();

//        $products = filter_products(Product::where('published', 1)->where('name', 'like', '%'.$request->search.'%'))->orWhere('tags', 'like', '%'.$request->search.'%')->get()->take(3);

        $categories = Category::where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        $shops = Shop::whereIn('user_id', verified_sellers_id())->where('name', 'like', '%'.$request->search.'%')->get()->take(3);

        if(sizeof($keywords)>0 || sizeof($categories)>0 || sizeof($products)>0 || sizeof($shops) >0){
            return view('frontend.partials.search_content', compact('products', 'categories', 'keywords', 'shops'));
        }
        return '0';
    }

    public function listing(Request $request)
    {
        return $this->search($request);
    }

    public function listingByCategory(Request $request, $category_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category != null) {
            return $this->search($request, $category->id);
        }
        abort(404);
    }

    public function listingByBrand(Request $request, $brand_slug)
    {
        $brand = Brand::where('slug', $brand_slug)->first();
        if ($brand != null) {
            return $this->search($request, null, $brand->id);
        }
        abort(404);
    }

    public function search(Request $request, $category_id = null, $brand_id = null)
    {
        $query = $request->q;
        $sort_by = $request->sort_by;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
        $seller_id = $request->seller_id;

        $conditions = ['published' => 1];

        if($brand_id != null){
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }elseif ($request->brand != null) {
            $brand_id = (Brand::where('slug', $request->brand)->first() != null) ? Brand::where('slug', $request->brand)->first()->id : null;
            $conditions = array_merge($conditions, ['brand_id' => $brand_id]);
        }

        if($seller_id != null){
            $conditions = array_merge($conditions, ['user_id' => Seller::findOrFail($seller_id)->user->id]);
        }

        $products = Product::where($conditions);

        if($category_id != null){
            $category_ids = CategoryUtility::children_ids($category_id);
            $category_ids[] = $category_id;

            $products = $products->whereIn('category_id', $category_ids);
        }

        if($min_price != null && $max_price != null){
            $products = $products->where('unit_price', '>=', $min_price)->where('unit_price', '<=', $max_price);
        }


        switch ($sort_by) {
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $products->orderBy('created_at', 'asc');
                break;
            case 'price-asc':
                $products->orderBy('unit_price', 'asc');
                break;
            case 'price-desc':
                $products->orderBy('unit_price', 'desc');
                break;
            default:
                $products->orderBy('created_at', 'desc');
                break;
        }


        $non_paginate_products = filter_products($products)->get();

        //Attribute Filter

        $attributes = array();
        foreach ($non_paginate_products as $key => $product) {
            if($product->attributes != null && is_array(json_decode($product->attributes))){
                foreach (json_decode($product->attributes) as $key => $value) {
                    $flag = false;
                    $pos = 0;
                    foreach ($attributes as $key => $attribute) {
                        if($attribute['id'] == $value){
                            $flag = true;
                            $pos = $key;
                            break;
                        }
                    }
                    if(!$flag){
                        $item['id'] = $value;
                        $item['values'] = array();
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                $item['values'] = $choice_option->values;
                                break;
                            }
                        }
                        array_push($attributes, $item);
                    }
                    else {
                        foreach (json_decode($product->choice_options) as $key => $choice_option) {
                            if($choice_option->attribute_id == $value){
                                foreach ($choice_option->values as $key => $value) {
                                    if(!in_array($value, $attributes[$pos]['values'])){
                                        array_push($attributes[$pos]['values'], $value);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $selected_attributes = array();

        foreach ($attributes as $key => $attribute) {
            if($request->has('attribute_'.$attribute['id'])){
                foreach ($request['attribute_'.$attribute['id']] as $key => $value) {
                    $str = '"'.$value.'"';
                    $products = $products->where('choice_options', 'like', '%'.$str.'%');
                }

                $item['id'] = $attribute['id'];
                $item['values'] = $request['attribute_'.$attribute['id']];
                array_push($selected_attributes, $item);
            }
        }


        //Color Filter
        $all_colors = array();

        foreach ($non_paginate_products as $key => $product) {
            if ($product->colors != null) {
                foreach (json_decode($product->colors) as $key => $color) {
                    if(!in_array($color, $all_colors)){
                        array_push($all_colors, $color);
                    }
                }
            }
        }

        $selected_color = null;

        if($request->has('color')){
            $str = '"'.$request->color.'"';
            $products = $products->where('colors', 'like', '%'.$str.'%');
            $selected_color = $request->color;
        }
        
        if($query != null){
            $searchController = new SearchController;
            $searchController->store($request);
            
            $products = $products->where('name', 'like', '%'.$query.'%')->orWhere('tags', 'like', '%'.$query.'%');
        }


        $products = filter_products($products)->paginate(12)->appends(request()->query());

        return view('frontend.product_listing', compact('products', 'query', 'category_id', 'brand_id', 'sort_by', 'seller_id','min_price', 'max_price', 'attributes', 'selected_attributes', 'all_colors', 'selected_color'));
    }

    public function home_settings(Request $request)
    {
        return view('home_settings.index');
    }

    public function top_10_settings(Request $request)
    {
        foreach (Category::all() as $key => $category) {
            if(is_array($request->top_categories) && in_array($category->id, $request->top_categories)){
                $category->top = 1;
                $category->save();
            }
            else{
                $category->top = 0;
                $category->save();
            }
        }

        foreach (Brand::all() as $key => $brand) {
            if(is_array($request->top_brands) && in_array($brand->id, $request->top_brands)){
                $brand->top = 1;
                $brand->save();
            }
            else{
                $brand->top = 0;
                $brand->save();
            }
        }

        flash(translate('Top 10 categories and brands have been updated successfully'))->success();
        return redirect()->route('home_settings.index');
    }

    public function variant_price(Request $request)
    {
        $product = Product::find($request->id);
        $str = '';
        $quantity = 0;
        $tax = 0;
        $max_limit = 0;

        if($request->has('color')){
            $str = $request['color'];
        }

        if(json_decode($product->choice_options) != null){
            foreach (json_decode($product->choice_options) as $key => $choice) {
                if($str != null){
                    $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
                else{
                    $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
            }
        }

        $product_stock = $product->stocks->where('variant', $str)->first();
        $price = $product_stock->price;
        $quantity = $product_stock->qty;
        $max_limit = $product_stock->qty;
//        if($str != null && $product->variant_product){
//        }
//        else{
//            $price = $product->unit_price;
//            $quantity = $product->current_stock;
//        }

        if($quantity >= 1 && $product->min_qty <= $quantity){
            $in_stock = 1;
        }else{
            $in_stock = 0;
        }

        //Product Stock Visibility
        if($product->stock_visibility_state == 'text') {
            if($quantity >= 1 && $product->min_qty < $quantity){
                $quantity = translate('In Stock');
            }else{
                $quantity = translate('Out Of Stock');
            }            
        }

        //discount calculation
        $discount_applicable = false;

        if ($product->discount_start_date == null) {
            $discount_applicable = true;
        }
        elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
            strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        // taxes
        foreach ($product->taxes as $product_tax) {
            if($product_tax->tax_type == 'percent'){
                $tax += ($price * $product_tax->tax) / 100;
            }
            elseif($product_tax->tax_type == 'amount'){
                $tax += $product_tax->tax;
            }
        }

        $price += $tax;

        return array(
            'price' => single_price($price*$request->quantity),
            'quantity' => $quantity,
            'digital' => $product->digital,
            'variation' => $str,
            'max_limit' => $max_limit,
            'in_stock' => $in_stock
        );
    }

    public function sellerpolicy(){
        return view("frontend.policies.sellerpolicy");
    }

    public function returnpolicy(){
        return view("frontend.policies.returnpolicy");
    }

    public function supportpolicy(){
        return view("frontend.policies.supportpolicy");
    }

    public function terms(){
        return view("frontend.policies.terms");
    }

    public function privacypolicy(){
        return view("frontend.policies.privacypolicy");
    }

    public function get_pick_up_points(Request $request)
    {
        $pick_up_points = PickupPoint::all();
        return view('frontend.partials.pick_up_points', compact('pick_up_points'));
    }

    public function get_category_items(Request $request){
        $category = Category::findOrFail($request->id);
        return view('frontend.partials.category_elements', compact('category'));
    }

    public function premium_package_index()
    {
        $customer_packages = CustomerPackage::all();
        return view('frontend.user.customer_packages_lists', compact('customer_packages'));
    }

    public function seller_digital_product_list(Request $request)
    {
        $products = Product::where('user_id', Auth::user()->id)->where('digital', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.user.seller.digitalproducts.products', compact('products'));
    }
    public function show_digital_product_upload_form(Request $request)
    {
        if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
            if(Auth::user()->seller->remaining_digital_uploads > 0){
                $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
                $categories = Category::where('digital', 1)->get();
                return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
            }
            else {
                flash(translate('Upload limit has been reached. Please upgrade your package.'))->warning();
                return back();
            }
        }

        $business_settings = BusinessSetting::where('type', 'digital_product_upload')->first();
        $categories = Category::where('digital', 1)->get();
        return view('frontend.user.seller.digitalproducts.product_upload', compact('categories'));
    }

    public function show_digital_product_edit_form(Request $request, $id)
    {
        $categories = Category::where('digital', 1)->get();
        $lang = $request->lang;
        $product = Product::find($id);
        return view('frontend.user.seller.digitalproducts.product_edit', compact('categories', 'product', 'lang'));
    }

    // Ajax call
    public function new_verify(Request $request)
    {
        $email = $request->email;
        if(isUnique($email) == '0') {
            $response['status'] = 2;
            $response['message'] = 'Email already exists!';
            return json_encode($response);
        }

        $response = $this->send_email_change_verification_mail($request, $email);
        return json_encode($response);
    }


    // Form request
    public function update_email(Request $request)
    {
        $email = $request->email;
        if(isUnique($email)) {
            $this->send_email_change_verification_mail($request, $email);
            flash(translate('A verification mail has been sent to the mail you provided us with.'))->success();
            return back();
        }

        flash(translate('Email already exists!'))->warning();
        return back();
    }

    public function send_email_change_verification_mail($request, $email)
    {
        $response['status'] = 0;
        $response['message'] = 'Unknown';

        $verification_code = Str::random(32);

        $array['subject'] = 'Email Verification';
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = 'Verify your account';
        $array['link'] = route('email_change.callback').'?new_email_verificiation_code='.$verification_code.'&email='.$email;
        $array['sender'] = Auth::user()->name;
        $array['details'] = "Email Second";

        $user = Auth::user();
        $user->new_email_verificiation_code = $verification_code;
        $user->save();

        try {
            Mail::to($email)->queue(new SecondEmailVerifyMailManager($array));

            $response['status'] = 1;
            $response['message'] = translate("Your verification mail has been Sent to your email.");

        } catch (\Exception $e) {
            // return $e->getMessage();
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }

        return $response;
    }

    public function email_change_callback(Request $request){
        if($request->has('new_email_verificiation_code') && $request->has('email')) {
            $verification_code_of_url_param =  $request->input('new_email_verificiation_code');
            $user = User::where('new_email_verificiation_code', $verification_code_of_url_param)->first();

            if($user != null) {

                $user->email = $request->input('email');
                $user->new_email_verificiation_code = null;
                $user->save();

                auth()->login($user, true);

                flash(translate('Email Changed successfully'))->success();
                return redirect()->route('dashboard');
            }
        }

        flash(translate('Email was not verified. Please resend your mail!'))->error();
        return redirect()->route('dashboard');

    }

    public function reset_password_with_code(Request $request){
        if (($user = User::where('email', $request->email)->where('verification_code', $request->code)->first()) != null) {
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
                $user->email_verified_at = date('Y-m-d h:m:s');
                $user->save();
                event(new PasswordReset($user));
                auth()->login($user, true);

                flash(translate('Password updated successfully'))->success();

                if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'staff')
                {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('home');
            }
            else {
                flash("Password and confirm password didn't match")->warning();
                return redirect()->route('password.request');
            }
        }
        else {
            flash("Verification code mismatch")->error();
            return redirect()->route('password.request');
        }
    }


    public function all_flash_deals() {
        $today = strtotime(date('Y-m-d H:i:s'));

        $data['all_flash_deals'] = FlashDeal::where('status', 1)
                ->where('start_date', "<=", $today)
                ->where('end_date', ">", $today)
                ->orderBy('created_at', 'desc')
                ->get();

        return view("frontend.flash_deal.all_flash_deal_list", $data);
    }

    public function all_seller(Request $request) {
        $shops = Shop::whereIn('user_id', verified_sellers_id())
                ->paginate(15);

        return view('frontend.shop_listing', compact('shops'));
    }

    public function return_states(Request $request) {
        $states = Destination::where('country_code', $request->country)->get();
        foreach($states as $item) {
            echo "<option value='".$item->state."' data-state-code='".$item->state_code."' >".$item->state."</option>";
        }
    }
    
    public function parts_index(Request $request) {
        $search = null;
        // $products = Product::where('user_id', Auth::user()->id)->where('digital', 0)->orderBy('created_at', 'desc');
        // $categories = Category::where('parent_id', 1)
        //     ->with('childrenCategories')
        //     ->get();
        // $categories = Category::where('parent_id', 1)->get();
        $parts = Product::where('is_parts', 1)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $search = $request->search;
            $parts = $parts->where('name', 'like', '%'.$search.'%');
        }
        // if ($request->has('search_hidden')) {
        //     $searchcat = $request->search_hidden;
        //     $get_ids = Category::where('parent_id', $searchcat)->pluck('id', 'name');
        //     $parts = $parts->whereIn('category_id', $get_ids);
        // }
        $parts = $parts->paginate(10);
        // dd($parts);
        return view('frontend.user.seller.parts', compact('parts', 'search'));
    
    }

    public function parts_show_details(Request $request, $id)
    {
        $part = Product::findOrFail($id);
        $cust_discount = DiscountSeller::where('user_id', Auth::user()->id)->first();
        return view('frontend.user.seller.parts_detail', compact('part', 'cust_discount'));
        
    }

    public function get_widthmotor_price(Request $req){
        $price = 0;
        $width = $req->width;
        $code = $req->code;
        $fraction = $req->fraction;
        if($fraction > 0 && $width < $req->max) {
            $width = $width + 1;
        }
        $price_table = XztWidMotors::select('min_wid', 'max_wid', 'price')->where('ct_code', $code)->get();
        foreach($price_table as $item) {
            if($width >= $item->min_wid && $width <= $item->max_wid) {
                $price = $item->price;
            }
        }
        echo $price;
    }

    public function get_cassette_color(Request $req) {
        $cassette_id = $req->cass_id;
        $cass_color = CassetteColor::where('cassette_id', $cassette_id)->get();
        foreach($cass_color as $item) {
            echo "<option value='".$item->color."'>".$item->color."</option>";
        }
    }

}
