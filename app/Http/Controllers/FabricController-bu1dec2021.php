<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztFabric;
use App\Category;
use App\Models\ProductFabric;
use App\Product;

class FabricController extends Controller
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
        $fabrics = XztFabric::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $fabrics = $fabrics->where('name', 'like', '%'.$sort_search.'%');
        }
        $fabrics = $fabrics->paginate(15);
        // dd($fabrics);
        return view('backend.fabric.index', compact('fabrics', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.fabric.add_fabric');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $rec = new XztFabric();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('show_in_gallery')) {$rec->show_in_gallery = $request->show_in_gallery;}
        if($request->hasFile('fabric_image')) {
            $file = $request->file('fabric_image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/fabric/images', $name); 
            $rec->url = $name;
        }
        $rec->save();
        
        return redirect()->route('fabric.list');
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
        $fabric = XztFabric::where('id', $id)->first();
        return view('backend.fabric.edit_fabric', compact('fabric'));
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
        $rec = XztFabric::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('show_in_gallery')) {
            $rec->show_in_gallery = $request->show_in_gallery;
        }else {
            $rec->show_in_gallery = "No";
        }
        if($request->hasFile('fabric_image')) {
            if(file_exists(public_path('fabric/images'.'/'.$rec->url))) {
                unlink(public_path('fabric/images'.'/'.$rec->url));
            }
            $file = $request->file('fabric_image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/fabric/images', $name); 
            $rec->url = $name;
        }
        $rec->save();
        
        return redirect()->route('fabric.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztFabric::find($id);
        $del->archived = 1;
        $del->show_in_gallery = 'No';
        $del->save();
        return redirect()->route('fabric.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztFabric::find($id);
        $rec->show_in_gallery = $status;
        $rec->save();
        return redirect()->route('fabric.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztFabric::find($id);
        $rec->archived = 0;
        $rec->show_in_gallery = 'Yes';
        $rec->save();
        return redirect()->route('fabric.list');
    }

    public function seller_fabric_list(Request $request) {
        $sort_search = null;
        $searchcat = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $categories = Category::where('parent_id', 1)->get();
        $fabrics = XztFabric::where('show_in_gallery', 'Yes')->where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $fabrics = $fabrics->where('name', 'like', '%'.$sort_search.'%');
        }
        if ($request->has('searchcat')){
            $searchcat = $request->searchcat;
            $category = Category::where('parent_id', $searchcat)->pluck('id');
            $product = Product::whereIN('category_id', $category)->pluck('id');
            $fab_chk = ProductFabric::whereIN('product_id', $product)->pluck('fabric_id');
            $fabrics = $fabrics->whereIN('id', $fab_chk);
        }

        $fabrics = $fabrics->paginate(15);
        // dd($fabrics);
        return view('frontend.user.seller.fabric.fabrics', compact('fabrics', 'sort_search', 'categories', 'searchcat'));
    }

    public function bulk_customer_delete(Request $request) {
        if($request->id) {
            foreach ($request->id as $customer_id) {
                $this->destroy($customer_id);
            }
        }
        
        return 1;
    }

    public function login($id)
    {
        $customer = Customer::findOrFail(decrypt($id));

        $user  = $customer->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $customer = Customer::findOrFail($id);

        if($customer->user->banned == 1) {
            $customer->user->banned = 0;
            flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $customer->user->banned = 1;
            flash(translate('Customer Banned Successfully'))->success();
        }

        $customer->user->save();

        return back();
    }
}
