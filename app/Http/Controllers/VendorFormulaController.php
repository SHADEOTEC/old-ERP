<?php

namespace App\Http\Controllers;

use App\Models\XztVendor;
use Illuminate\Http\Request;

class VendorFormulaController extends Controller
{

    public function index(Request $request)
    {
        $sort_search = null;
        $vendors = XztVendor::orderBy("state", "desc")->orderBy('id', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $vendors = $vendors->where('vendor', 'like', '%' . $sort_search . '%');
        }
        $vendors = $vendors->get();
        // dd($vendors);
        return view('backend.vendor.index', compact('vendors', 'sort_search'));
    }

    public function create()
    {
        return view('backend.vendor.add_vendor');
    }

    public function store(Request $request)
    {
        $rec = new XztVendor();
        if ($request->has('vendor')) {$rec->vendor = $request->vendor;}
        if ($request->has('formula')) {$rec->formula = $request->formula;}
        if ($request->has('shades')) {$rec->shades = $request->shades;}
        if ($request->has('fascia')) {$rec->fascia = $request->fascia;}
        if ($request->has('tube')) {$rec->tube = $request->tube;}
        if ($request->has('bottom_rail')) {$rec->bottom_rail = $request->bottom_rail;}
        if ($request->has('bottom_tube')) {$rec->bottom_tube = $request->bottom_tube;}
        if ($request->has('fabric_width')) {$rec->fabric_width = $request->fabric_width;}
        if ($request->has('fabric_height')) {$rec->fabric_height = $request->fabric_height;}
        if ($request->has('blind_width')) {$rec->blind_width = $request->blind_width;}
        if ($request->has('state')) {$rec->state = $request->state;}

        $rec->save();

        return redirect()->route('vend_formula.index');
    }

    public function edit($id)
    {
        $vendor = XztVendor::where('id', $id)->first();
        return view('backend.vendor.edit_vendor', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->input());
        $rec = XztVendor::find($id);
        if ($request->has('vendor')) {$rec->vendor = $request->vendor;}
        if ($request->has('formula')) {$rec->formula = $request->formula;}
        if ($request->has('shades')) {$rec->shades = $request->shades;}
        if ($request->has('fascia')) {$rec->fascia = $request->fascia;}
        if ($request->has('tube')) {$rec->tube = $request->tube;}
        if ($request->has('bottom_rail')) {$rec->bottom_rail = $request->bottom_rail;}
        if ($request->has('bottom_tube')) {$rec->bottom_tube = $request->bottom_tube;}
        if ($request->has('fabric_width')) {$rec->fabric_width = $request->fabric_width;}
        if ($request->has('fabric_height')) {$rec->fabric_height = $request->fabric_height;}
        if ($request->has('blind_width')) {$rec->blind_width = $request->blind_width;}
        if ($request->has('state')) {
            $rec->state = $request->state;
        } else {
            $rec->state = 0;
        }

        $rec->save();

        return redirect()->route('vend_formula.index');
    }

    public function destroy($id)
    {
        $del = XztVendor::find($id);
        $del->archived = 1;
        $del->state = 0;
        $del->save();
        return redirect()->route('vend_formula.index');
    }

    public function visibility($id, $status)
    {
        // dd($status);
        $rec = XztVendor::find($id);
        $rec->state = $status;
        $rec->save();
        return redirect()->route('vend_formula.index');
    }

    public function recover($id)
    {
        // dd($status);
        $rec = XztVendor::find($id);
        $rec->archived = 0;
        $rec->state = 1;
        $rec->save();
        return redirect()->route('vend_formula.index');
    }

}