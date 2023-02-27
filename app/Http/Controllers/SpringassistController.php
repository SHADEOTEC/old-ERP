<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztSpringassist;

class SpringassistController extends Controller
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
        $springassists = XztSpringassist::where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $springassists = $springassists->where('name', 'like', '%'.$sort_search.'%');
        }
        $springassists = $springassists->paginate(15);
        // dd($springassists);
        return view('backend.springassist.index', compact('springassists', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.springassist.add_springassist');
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
        $rec = new XztSpringassist();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('option_code')) {$rec->option_code = $request->option_code;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {$rec->state = $request->state;}
        if($request->has('width_limit')) {$rec->width_limit = $request->width_limit;}

        $rec->save();
        
        return redirect()->route('springassist.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $springassist = XztSpringassist::where('id', $id)->first();
        return view('backend.springassist.edit_springassist', compact('springassist'));
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
        $rec = XztSpringassist::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('option_code')) {$rec->option_code = $request->option_code;}
        if($request->has('width_limit')) {$rec->width_limit = $request->width_limit;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        $rec->save();
        
        return redirect()->route('springassist.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztSpringassist::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('springassist.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztSpringassist::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('springassist.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztSpringassist::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('springassist.list');
    }
}
