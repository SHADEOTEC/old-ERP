<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztManualCts;
use App\Models\XztMotorCts;
use App\Models\XztWidMotors;

class ControltypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_manual(Request $request)
    {
        $sort_search = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $controltypes = XztManualCts ::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $controltypes = $controltypes->where('name', 'like', '%'.$sort_search.'%');
        }
        $controltypes = $controltypes->paginate(15);
        // dd($controltypes);
        return view('backend.controltype.manual.index', compact('controltypes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_manual()
    {
        //
        return view('backend.controltype.manual.add_manual');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_manual(Request $request)
    {
        // dd($request->input());
        $rec = new XztManualCts();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/controltype/manual/images', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('controltype.manual.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_manual($id)
    {
        $controltype = XztManualCts ::where('id', $id)->first();
        return view('backend.controltype.manual.edit_manual', compact('controltype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_manual(Request $request, $id)
    {
        // dd($request->input());
        $rec = XztManualCts ::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('/controltype/manual/images'.'/'.$rec->image))) {
                unlink(public_path('/controltype/manual/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/controltype/manual/images', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('controltype.manual.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_manual($id)
    {
        $del = XztManualCts ::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('controltype.manual.list');
    }
    
    public function visibility_manual($id, $status) {
        // dd($status);
        $rec = XztManualCts ::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('controltype.manual.list');
    }

    public function recover_manual($id) {
        // dd($status);
        $rec = XztManualCts ::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('controltype.manual.list');
    }
    
    // public function seller_manual_list(Request $request) {
    //     $sort_search = null;
    //     // $customers = Customer::orderBy('created_at', 'desc');
    //     $controltypes = XztManualCts ::where('show_in_gallery', 'Yes')->orderBy('created_at', 'desc');
    //     if ($request->has('search')){
    //         $sort_search = $request->search;
    //         $controltypes = $controltypes->where('name', 'like', '%'.$sort_search.'%');
    //     }
    //     $controltypes = $controltypes->paginate(15);
    //     // dd($controltypes);
    //     return view('frontend.user.seller.controltype.manual.controltypes', compact('controltypes', 'sort_search'));
    // }
    
    //  Motorization
    public function index_motor(Request $request)
    {
        $sort_search = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $controltypes = XztMotorCts ::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $controltypes = $controltypes->where('name', 'like', '%'.$sort_search.'%');
        }
        $controltypes = $controltypes->paginate(15);
        // dd($controltypes);
        return view('backend.controltype.motor.index', compact('controltypes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_motor()
    {
        //
        return view('backend.controltype.motor.add_motor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_motor(Request $request)
    {
        // dd($request->input());
        $rec = new XztMotorCts();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        // if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('length') && $request->length != null) {$rec->length = $request->length;}
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('controltype.motor.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_motor($id)
    {
        $controltype = XztMotorCts ::where('id', $id)->first();
        return view('backend.controltype.motor.edit_motor', compact('controltype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_motor(Request $request, $id)
    {
        // dd($request->input());
        $rec = XztMotorCts ::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        // if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->has('length')) {
            $rec->length = $request->length;
        }else {
            $rec->length = "0 ft.";
        }
        $rec->save();
        
        return redirect()->route('controltype.motor.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_motor($id)
    {
        $del = XztMotorCts ::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('controltype.motor.list');
    }
    
    public function visibility_motor($id, $status) {
        // dd($status);
        $rec = XztMotorCts ::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('controltype.motor.list');
    }

    public function recover_motor($id) {
        // dd($status);
        $rec = XztMotorCts ::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('controltype.motor.list');
    }

    ///
    ///
    ///
    public function index_wid_motor(Request $request)
    {
        $sort_search = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $controltypes = XztWidMotors ::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $controltypes = $controltypes->where('name', 'like', '%'.$sort_search.'%');
        }
        $controltypes = $controltypes->paginate(15);
        // dd($controltypes);
        return view('backend.controltype.wid_motor.index', compact('controltypes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_wid_motor()
    {
        //
        return view('backend.controltype.wid_motor.add_wid_motor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_wid_motor(Request $request)
    {
        // dd($request->input());
        $rec = new XztWidMotors();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('controltype.wid_motor.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_wid_motor($id)
    {
        $controltype = XztWidMotors ::where('id', $id)->first();
        return view('backend.controltype.wid_motor.edit_wid_motor', compact('controltype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_wid_motor(Request $request, $id)
    {
        // dd($request->input());
        $rec = XztWidMotors ::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('ct_code')) {$rec->ct_code = $request->ct_code;}
        if($request->has('min_wid')) {$rec->min_wid = $request->min_wid;}
        if($request->has('max_wid')) {$rec->max_wid = $request->max_wid;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        
        $rec->save();
        
        return redirect()->route('controltype.wid_motor.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_wid_motor($id)
    {
        $del = XztWidMotors ::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('controltype.wid_motor.list');
    }
    
    public function visibility_wid_motor($id, $status) {
        // dd($status);
        $rec = XztWidMotors ::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('controltype.wid_motor.list');
    }

    public function recover_wid_motor($id) {
        // dd($status);
        $rec = XztWidMotors ::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('controltype.wid_motor.list');
    }



}
