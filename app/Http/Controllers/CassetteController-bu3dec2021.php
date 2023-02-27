<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztCassette;
use App\Category;

class CassetteController extends Controller
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
        $cassettes = XztCassette::with('category')->orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $cassettes = $cassettes->where('name', 'like', '%'.$sort_search.'%');
        }
        $cassettes = $cassettes->paginate(15);
        // dd($cassettes);
        return view('backend.cassette.index', compact('cassettes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('parent_id', 1)->get();
        // dd($categories);
        return view('backend.cassette.add_cassette', compact('categories'));
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
        $rec = new XztCassette();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('cassette_code')) {$rec->cassette_code = $request->cassette_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('state')) {$rec->state = $request->state;}
        if($request->has('category_id') && $request->category_id != null) {$rec->category_id = $request->category_id;}
        
        $rec->save();
        
        return redirect()->route('cassette.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cassette = XztCassette::where('id', $id)->first();
        $categories = Category::where('parent_id', 1)->get();
        return view('backend.cassette.edit_cassette', compact('cassette', 'categories'));
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
        $rec = XztCassette::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('cassette_code')) {$rec->cassette_code = $request->cassette_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('category_id')) {$rec->category_id = $request->category_id;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->has('category_id') && $request->category_id != null) {
            $rec->category_id = $request->category_id;
        }else {
            $rec->category_id = 0;
        }

        $rec->save();
        
        return redirect()->route('cassette.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztCassette::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('cassette.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztCassette::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('cassette.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztCassette::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('cassette.list');
    }
}
