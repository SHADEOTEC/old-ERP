<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Seller;
use App\User;
use App\Shop;
use App\Product;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmailVerificationNotification;
use App\Models\DiscountSeller;
use App\Models\SellerBank;
use App\Models\SellerBillAddr;
use App\Models\SellerShipAddr;
use App\Models\Destination;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $approved = null;
        $sellers = User::where('user_type', 'seller')->select();
        
        if ($request->has('search')) {
            $sort_search = $request->search;
            $sellers = $sellers->where('name', 'like', '%' . $sort_search . '%')->orWhere('email', 'like', '%' . $sort_search . '%');
        }
        $sellers = $sellers->paginate(15);
        return view('backend.sellers.index', compact('sellers', 'sort_search', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $destinations = Destination::select('country', 'country_code')->distinct()->get();
        return view('backend.sellers.create', compact('destinations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (User::where('email', $request->email)->first() != null) {
            flash(translate('Email already exists!'))->error();
            return back();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;

        $user->company_name = $request->company_name;
        $user->phone = $request->phone;
        $user->website = $request->website;
        $user->twitter = $request->twitter;
        $user->facebook = $request->facebook;
        $user->tax_id = $request->tax_id;

        $user->user_type = "seller";
        
        $user->password = Hash::make($request->password);

        if ($user->save()) {
            $rec = new DiscountSeller();
            $rec->user_id = $user->id;
            $rec->cs_mark = 'CSM-'.substr($request->name,0,3).'-'.$user->id;
            $rec->disc_percent = $request->disc_percent;
            $rec->save();

            $billing_rec = new SellerBillAddr();
            $billing_rec->user_id = $user->id;
            $billing_rec->bill_name = $request->bill_name;
            $billing_rec->bill_email = $request->bill_email;
            $billing_rec->bill_addr = $request->bill_addr;
            $billing_rec->bill_addr2 = $request->bill_addr2;
            $billing_rec->bill_country = $request->bill_country;
            $billing_rec->bill_city = $request->bill_city;
            $billing_rec->bill_zip = $request->bill_zip;
            $billing_rec->save();

            $shipping_rec = new SellerShipAddr();
            $shipping_rec->user_id = $user->id;
            $shipping_rec->ship_name = $request->ship_name;
            $shipping_rec->ship_email = $request->ship_email;
            $shipping_rec->ship_addr = $request->ship_addr;
            $shipping_rec->ship_addr2 = $request->ship_addr2;
            $shipping_rec->ship_country = $request->ship_country;
            $shipping_rec->ship_city = $request->ship_city;
            $shipping_rec->ship_zip = $request->ship_zip;
            $shipping_rec->save();

            $bank_rec = new SellerBank();
            $bank_rec->user_id = $user->id;
            $bank_rec->bank_name = $request->bank_name;
            $bank_rec->bank_acc_name = $request->bank_acc_name;
            $bank_rec->bank_acc_no = $request->bank_acc_no;
            $bank_rec->bank_routing_no = $request->bank_routing_no;
            $bank_rec->save();

            if (get_setting('email_verification') != 1) {
                $user->email_verified_at = date('Y-m-d H:m:s');
            } else {
                $user->notify(new EmailVerificationNotification());
            }
            $user->save();

            $seller = new Seller;
            $seller->user_id = $user->id;

            if ($seller->save()) {
                $shop = new Shop;
                $shop->user_id = $user->id;
                $shop->slug = 'demo-shop-' . $user->id;
                $shop->save();

                
            }
            flash(translate('Seller has been inserted successfully'))->success();
            return redirect()->route('backend.sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seller = User::findOrFail($id);
        // dd($seller);
        $destinations = Destination::select('country', 'country_code')->distinct()->get();
        $discount = DiscountSeller::where('user_id', $id)->first();
        $bill = SellerBillAddr::where('user_id', $id)->first();
        $ship = SellerShipAddr::where('user_id', $id)->first();
        $bank = SellerBank::where('user_id', $id)->first();
        return view('backend.sellers.edit_seller', compact('seller', 'destinations', 'discount', 'bill', 'ship', 'bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->input());
        $seller = User::findOrFail($id);
        if($request->has('name')) { $seller->name = $request->name ;}
        if($request->has('email')) { $seller->email = $request->email ;}
        if($request->has('password') && $request->password != null) { $seller->password = Hash::make($request->password) ;}
        if($request->has('company_name')) { $seller->company_name = $request->company_name ;}
        if($request->has('phone')) { $seller->phone = $request->phone ;}
        if($request->has('website')) { $seller->website = $request->website ;}
        if($request->has('twitter')) { $seller->twitter = $request->twitter ;}
        if($request->has('facebook')) { $seller->facebook = $request->facebook ;}
        if($request->has('tax_id')) { $seller->tax_id = $request->tax_id ;}
        $seller->save();
        
        $ship = SellerShipAddr::where('user_id', $id)->first();
        if($request->has('ship_name')) {$ship->ship_name = $request->ship_name ; }
        if($request->has('ship_email')) {$ship->ship_email = $request->ship_email ; }
        if($request->has('ship_addr')) {$ship->ship_addr = $request->ship_addr ; }
        if($request->has('ship_addr2')) {$ship->ship_addr2 = $request->ship_addr2 ; }
        if($request->has('ship_country')) {$ship->ship_country = $request->ship_country ; }
        if($request->has('ship_city')) {$ship->ship_city = $request->ship_city ; }
        if($request->has('ship_zip')) {$ship->ship_zip = $request->ship_zip ; }
        $ship->save();
        
        $bill = SellerBillAddr::where('user_id', $id)->first();
        if($request->has('bill_name')) {$bill->bill_name = $request->bill_name ; }
        if($request->has('bill_email')) {$bill->bill_email = $request->bill_email ; }
        if($request->has('bill_addr')) {$bill->bill_addr = $request->bill_addr ; }
        if($request->has('bill_addr2')) {$bill->bill_addr2 = $request->bill_addr2 ; }
        if($request->has('bill_country')) {$bill->bill_country = $request->bill_country ; }
        if($request->has('bill_city')) {$bill->bill_city = $request->bill_city ; }
        if($request->has('bill_zip')) {$bill->bill_zip = $request->bill_zip ; }
        $bill->save();

        $bank = SellerBank::where('user_id', $id)->first();
        if($request->has('bank_name')) {$bank->bank_name = $request->bank_name ; }
        if($request->has('bank_acc_name')) {$bank->bank_acc_name = $request->bank_acc_name ; }
        if($request->has('bank_acc_no')) {$bank->bank_acc_no = $request->bank_acc_no ; }
        if($request->has('bank_routing_no')) {$bank->bank_routing_no  = $request->bank_routing_no ; }
        $bank->save();
        
        $discount = DiscountSeller::where('user_id', $id)->first();
        if($request->has('disc_percent')) {$discount->disc_percent = $request->disc_percent ; }
        $discount->save();
        // if ($user->save()) {
        //     if ($seller->save()) {
        //         //flash(translate('Seller has been updated successfully'))->success();
        //         return redirect()->route('sellers.index');
        //     }
        // }

        //flash(translate('Something went wrong'))->error();
        return redirect()->route('backend.sellers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $seller = Seller::findOrFail($id);

        Shop::where('user_id', $seller->user_id)->delete();

        Product::where('user_id', $seller->user_id)->delete();

        $orders = Order::where('user_id', $seller->user_id)->get();
        Order::where('user_id', $seller->user_id)->delete();

        foreach ($orders as $key => $order) {
            OrderDetail::where('order_id', $order->id)->delete();
        }

        User::destroy($seller->user->id);

        if (Seller::destroy($id)) {
            flash(translate('Seller has been deleted successfully'))->success();
            return redirect()->route('sellers.index');
        } else {
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    public function bulk_seller_delete(Request $request)
    {
        if ($request->id) {
            foreach ($request->id as $seller_id) {
                $this->destroy($seller_id);
            }
        }

        return 1;
    }

    public function show_verification_request($id)
    {
        $seller = Seller::findOrFail($id);
        return view('backend.sellers.verification', compact('seller'));
    }

    public function approve_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 1;
        if ($seller->save()) {
            flash(translate('Seller has been approved successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function reject_seller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->verification_status = 0;
        $seller->verification_info = null;
        if ($seller->save()) {
            flash(translate('Seller verification request has been rejected successfully'))->success();
            return redirect()->route('sellers.index');
        }
        flash(translate('Something went wrong'))->error();
        return back();
    }


    public function payment_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('backend.sellers.payment_modal', compact('seller'));
    }

    public function profile_modal(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        return view('backend.sellers.profile_modal', compact('seller'));
    }

    public function updateApproved(Request $request)
    {
        $seller = Seller::findOrFail($request->id);
        $seller->verification_status = $request->status;
        if ($seller->save()) {
            return 1;
        }
        return 0;
    }

    public function login($id)
    {
        $seller = Seller::findOrFail(decrypt($id));

        $user  = $seller->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id)
    {
        $seller = Seller::findOrFail($id);

        if ($seller->user->banned == 1) {
            $seller->user->banned = 0;
            flash(translate('Seller has been unbanned successfully'))->success();
        } else {
            $seller->user->banned = 1;
            flash(translate('Seller has been banned successfully'))->success();
        }

        $seller->user->save();
        return back();
    }

    public function return_states(Request $request) {
        $states = Destination::where('country_code', $request->country)->get();
        foreach($states as $item) {
            echo "<option value='".$item->state."' data-state-code='".$item->state_code."' >".$item->state."</option>";
        }
    }



}
