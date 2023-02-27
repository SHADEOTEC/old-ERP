<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use Schema;
use App\Models\XztCoupons;


class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $coupons = XztCoupons::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $coupons = $coupons->where('name', 'like', '%'.$sort_search.'%');
        }
        $coupons = $coupons->paginate(15);
        // dd($coupons);
        return view('backend.coupon.index', compact('coupons', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.coupon.add_coupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rec = new XztCoupons();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('discount')) {$rec->discount = $request->discount;}
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('coupon.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = XztCoupons::where('id', $id)->first();
        return view('backend.coupon.edit_coupon', compact('coupon'));
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
        $rec = XztCoupons::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('discount')) {$rec->discount = $request->discount;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        
        $rec->save();
        
        return redirect()->route('coupon.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztCoupons::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('coupon.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztCoupons::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('coupon.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztCoupons::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('coupon.list');
    }

}
