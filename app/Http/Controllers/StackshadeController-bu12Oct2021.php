<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\XztStack;

class StackshadeController extends Controller
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
        $stacks = XztStack::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $stacks = $stacks->where('name', 'like', '%'.$sort_search.'%');
        }
        $stacks = $stacks->paginate(15);
        // dd($stacks);
        return view('backend.stack.index', compact('stacks', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.stack.add_stack');
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
        $rec = new XztStack();
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/stack/images', $name); 
            $rec->image = $name;
        }
        if($request->has('state')) {$rec->state = $request->state;}
        
        $rec->save();
        
        return redirect()->route('stack.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stack = XztStack::where('id', $id)->first();
        return view('backend.stack.edit_stack', compact('stack'));
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
        $rec = XztStack::find($id);
        if($request->has('name')) {$rec->name = $request->name;}
        if($request->has('price')) {$rec->price = $request->price;}
        if($request->has('position')) {$rec->position = $request->position;}
        if($request->has('state')) {
            $rec->state = $request->state;
        }else {
            $rec->state = "Inactive";
        }
        if($request->hasFile('image')) {
            if(file_exists(public_path('stack/images'.'/'.$rec->image))) {
                unlink(public_path('stack/images'.'/'.$rec->image));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $name = time().'-'.$name;
            $file->move(public_path().'/stack/images', $name); 
            $rec->image = $name;
        }
        $rec->save();
        
        return redirect()->route('stack.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztStack::find($id);
        $del->delete();
        return redirect()->route('stack.list');
    }
    
    public function visibility($id, $status) {
        // dd($status);
        $rec = XztStack::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('stack.list');
    }
}
