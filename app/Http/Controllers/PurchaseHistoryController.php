<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderDetail;
use Auth;
use DB;
use App\Models\Xztcart;
use App\Models\Download;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('code', 'desc')->paginate(9);
        // $pos = Xztcart::where('user_id', Auth::user()->id)->orderBy('order_number', 'desc')->paginate(9);
        
        $pos = DB::table('xztcarts')->orderBy('xztcarts.id', 'desc')
        ->join('products', 'xztcarts.product_id', '=', 'products.id')
        ->where('xztcarts.user_id', Auth::user()->id)
        ->select('xztcarts.*', 'products.name');
        $pos = $pos->paginate(15);
        
        return view('frontend.user.purchase_history', compact('orders', 'pos'));
        
    }

    public function digital_index(Request $request)
    {
        // $orders = DB::table('orders')
        //                 ->orderBy('code', 'desc')
        //                 ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        //                 ->join('products', 'order_details.product_id', '=', 'products.id')
        //                 ->where('orders.user_id', Auth::user()->id)
        //                 ->where('products.digital', '1')
        //                 ->where('order_details.payment_status', 'paid')
        //                 ->select('order_details.id')
        //                 ->paginate(15);
        $file_srch = '';
        
        $orders = DB::table('downloads')->select('*');
        if($request->has('file_srch')){
            $file_srch = $request->file_srch;
            $orders = $orders->where('filename','like', '%' . $file_srch . '%');
        }
        $orders = $orders->paginate(15);
        // dd($orders);
        return view('frontend.user.digital_purchase_history', compact('orders', 'file_srch'));
    }
    
    public function digital_download (Request $request) {
        $request->validate([
            'dl_file' => 'required|mimes:pdf|max:2048',
        ]);
        $fileName = $request->file('dl_file')->getClientOriginalName();  
        // $fileName = time().'.'.$request->dl_file->extension();  
   
        $request->dl_file->move(public_path('download'), $fileName);
        $rec = new Download();
        $rec->user_id = Auth::user()->id;
        $rec->filename = $fileName;
        $rec->save();
        // return view('frontend.user.digital_purchase_history');
        return back();
        //     ->with('success','You have successfully upload file.')
        //     ->with('file',$fileName);
    }
    
    public function show_download($file_name) {
        $file_path = public_path('download/'.$file_name);
        return response()->download($file_path);
    }

    public function purchase_history_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        return view('frontend.user.order_details_customer', compact('order'));
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
