<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_parts(Request $request)
    {
        $sort_search = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $parts = Product::where('is_parts', 1)->where('archived', 0)->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $parts = $parts->where('name', 'like', '%'.$sort_search.'%');
        }
        $parts = $parts->get();
        // dd($parts);
        return view('backend.product.parts.index', compact('parts', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.product.parts.create');
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
        $rec = new Product();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->unit_price = $request->price;}
        if($request->has('part_code')) {$rec->part_code = $request->part_code;}
        if($request->has('description')) {$rec->description = $request->description;}
        if($request->has('specification')) {$rec->specification = $request->specification;}
        if($request->has('state')) {$rec->state = $request->state;}
        if($request->hasFile('thumbnail_img')) {
            $file = $request->file('thumbnail_img');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/parts/images', $name); 
            $rec->thumbnail_img = $name;
        }
        $rec->category_id = 7;
        $rec->is_parts = 1;
        $rec->save();
        
        return redirect()->route('parts.admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $part = Product::where('id', $id)->first();
        return view('backend.product.parts.edit', compact('part'));
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
        $rec = Product::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->unit_price = $request->price;}
        if($request->has('part_code')) {$rec->part_code = $request->part_code;}
        if($request->has('description')) {$rec->description = $request->description;}
        if($request->has('specification')) {$rec->specification = $request->specification;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('thumbnail_img')) {
            if(file_exists(public_path('parts/images'.'/'.$rec->thumbnail_img))) {
                unlink(public_path('parts/images'.'/'.$rec->thumbnail_img));
            }
            $file = $request->file('thumbnail_img');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/parts/images', $name); 
            $rec->thumbnail_img = $name;
        }

        $rec->save();
        
        return redirect()->route('parts.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = Product::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('parts.admin');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = Product::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('parts.admin');
    }

    public function recover($id) {
        // dd($status);
        $rec = Product::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('parts.admin');
    }
}
