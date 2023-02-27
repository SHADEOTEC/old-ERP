<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztBracket;

class BracketController extends Controller
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
        $brackets = XztBracket::where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $brackets = $brackets->where('name', 'like', '%'.$sort_search.'%');
        }
        $brackets = $brackets->paginate(15);
        // dd($brackets);
        return view('backend.bracket.index', compact('brackets', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.bracket.add_bracket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rec = new XztBracket();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price') && $request->price != null) {
            $rec->price = $request->price;
        }
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/bracket/images', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('bracket.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bracket = XztBracket::where('id', $id)->first();
        return view('backend.bracket.edit_bracket', compact('bracket'));
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
        $rec = XztBracket::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price') && $request->price != null) {
            $rec->price = $request->price;
        }else {
            $rec->price = 0;
        }
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('bracket/images'.'/'.$rec->image))) {
                unlink(public_path('bracket/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/bracket/images', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('bracket.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztBracket::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('bracket.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztBracket::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('bracket.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztBracket::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('bracket.list');
    }

}
