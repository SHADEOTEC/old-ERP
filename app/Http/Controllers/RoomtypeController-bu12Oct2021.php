<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztRoomtype;

class RoomtypeController extends Controller
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
        $roomtypes = XztRoomtype::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $roomtypes = $roomtypes->where('name', 'like', '%'.$sort_search.'%');
        }
        $roomtypes = $roomtypes->paginate(15);
        // dd($roomtypes);
        return view('backend.roomtype.index', compact('roomtypes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.roomtype.add_roomtype');
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
        $rec = new XztRoomtype();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('roomtype.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roomtype = XztRoomtype::where('id', $id)->first();
        return view('backend.roomtype.edit_roomtype', compact('roomtype'));
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
        $rec = XztRoomtype::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        $rec->save();
        
        return redirect()->route('roomtype.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztRoomtype::find($id);
        $del->delete();
        return redirect()->route('roomtype.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztRoomtype::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('roomtype.list');
    }
}
