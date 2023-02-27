<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztSmartoption;

class SmartoptionController extends Controller
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
        $smartoptions = XztSmartoption::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $smartoptions = $smartoptions->where('name', 'like', '%'.$sort_search.'%');
        }
        $smartoptions = $smartoptions->paginate(15);
        // dd($smartoptions);
        return view('backend.smartoption.index', compact('smartoptions', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.smartoption.add_smartoption');
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
        $rec = new XztSmartoption();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/smartoption/images', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('smartoptions.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $smartoption = XztSmartoption::where('id', $id)->first();
        return view('backend.smartoption.edit_smartoption', compact('smartoption'));
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
        $rec = XztSmartoption::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('smartoption/images'.'/'.$rec->image))) {
                unlink(public_path('smartoption/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/smartoption/images', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('smartoptions.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztSmartoption::find($id);
        $del->delete();
        return redirect()->route('smartoptions.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztSmartoption::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('smartoptions.list');
    }

    // public function seller_smartoption_list(Request $request) {
    //     $sort_search = null;
    //     // $customers = Customer::orderBy('created_at', 'desc');
    //     $smartoptions = XztSmartoption::where('show_in_gallery', 'Yes')->orderBy('created_at', 'desc');
    //     if ($request->has('search')){
    //         $sort_search = $request->search;
    //         $smartoptions = $smartoptions->where('name', 'like', '%'.$sort_search.'%');
    //     }
    //     $smartoptions = $smartoptions->paginate(15);
    //     // dd($smartoptions);
    //     return view('frontend.user.seller.smartoption.smartoptions', compact('smartoptions', 'sort_search'));
    // }



}
