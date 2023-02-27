<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztMount;
use App\Models\XztMountposition;

class MountController extends Controller
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
        $mounts = XztMount::where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $mounts = $mounts->where('name', 'like', '%'.$sort_search.'%');
        }
        $mounts = $mounts->paginate(15);
        // dd($mounts);
        return view('backend.mount.index', compact('mounts', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.mount.add_mount');
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
        $rec = new XztMount();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/mount/images', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('mount.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mount = XztMount::where('id', $id)->first();
        return view('backend.mount.edit_mount', compact('mount'));
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
        $rec = XztMount::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('mount/images'.'/'.$rec->image))) {
                unlink(public_path('mount/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/mount/images', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('mount.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $del = XztMount::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('mount.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztMount::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('mount.list');
    }

    public function recover($id) {
        // dd($status);
        $rec = XztMount::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('mount.list');
    }

    // public function seller_mount_list(Request $request) {
    //     $sort_search = null;
    //     // $customers = Customer::orderBy('created_at', 'desc');
    //     $mounts = XztMount::where('show_in_gallery', 'Yes')->orderBy('created_at', 'desc');
    //     if ($request->has('search')){
    //         $sort_search = $request->search;
    //         $mounts = $mounts->where('name', 'like', '%'.$sort_search.'%');
    //     }
    //     $mounts = $mounts->paginate(15);
    //     // dd($mounts);
    //     return view('frontend.user.seller.mount.mounts', compact('mounts', 'sort_search'));
    // }
    public function index_position(Request $request)
    {
        $sort_search = null;
        $mounts = XztMountposition::where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $mounts = $mounts->where('position', 'like', '%'.$sort_search.'%');
        }
        $mounts = $mounts->paginate(15);
        return view('backend.mount.position.index', compact('mounts', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_position()
    {
        //
        return view('backend.mount.position.add_mountposition');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_position(Request $request)
    {
        // dd($request->input());
        $rec = new XztMountposition();
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/mount/images/position', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('mountposition.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_position($id)
    {
        $mount = XztMountposition::where('id', $id)->first();
        return view('backend.mount.position.edit_mountposition', compact('mount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_position(Request $request, $id)
    {
        // dd($request->input());
        $rec = XztMountposition::find($id);
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('mount/images'.'/'.$rec->image))) {
                unlink(public_path('mount/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/mount/images/position', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('mountposition.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_position($id)
    {
        $del = XztMountposition::find($id);
        $del->archived = 1;
        $del->state = 'Inactive';
        $del->save();
        return redirect()->route('mountposition.list');
    }
    
    public function visibility_position($id, $status) {
        // dd($status);
        $rec = XztMountposition::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('mountposition.list');
    }

    public function recover_position($id) {
        // dd($status);
        $rec = XztMountposition::find($id);
        $rec->archived = 0;
        $rec->state = 'Active';
        $rec->save();
        return redirect()->route('mountposition.list');
    }


}

