<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztWrap;

class WrappedController extends Controller
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
        $wraps = XztWrap::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $wraps = $wraps->where('name', 'like', '%'.$sort_search.'%');
        }
        $wraps = $wraps->get();
        // dd($wraps);
        return view('backend.wrapped.index', compact('wraps', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.wrapped.add_wrap');
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
        $rec = new XztWrap();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('wrap_code')) {$rec->wrap_code = $request->wrap_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('wrapped.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wrap = XztWrap::where('id', $id)->first();
        return view('backend.wrapped.edit_wrap', compact('wrap'));
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
        $rec = XztWrap::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('wrap_code')) {$rec->wrap_code = $request->wrap_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }

        $rec->save();
        
        return redirect()->route('wrapped.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztWrap::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('wrapped.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztWrap::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('wrapped.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztWrap::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('wrapped.list');
    }
}
