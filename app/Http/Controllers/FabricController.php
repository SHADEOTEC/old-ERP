<?php

namespace App\Http\Controllers;

use App\Category;
use App\Models\XztFabric;
use Illuminate\Http\Request;

class FabricController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $searchcat = null;

        $categories = Category::where('parent_id', 1)->get();
        $fabrics = XztFabric::where('archived', 0)->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $sort_search = $request->search;
            $fabrics = $fabrics->where('name', 'like', '%' . $sort_search . '%');
        }

        $searchcat = $request->searchcat;

        if ($request->has('searchcat') && $request->input('searchcat')) {
            $fabrics = $fabrics->where('shade_cat', $request->input('searchcat'));
        }
        $searchsubcat = $request->searchsubcat;
        if ($request->has('searchsubcat') && $request->input('searchsubcat')) {
            $fabrics = $fabrics->where('shade_subcat', $searchsubcat);
        }
        $fabrics = $fabrics->get();

        // dd($fabrics);
        return view('backend.fabric.index', compact('fabrics', 'searchcat', 'searchsubcat', 'sort_search', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 1)->get();
        $previousUrl = url()->previous();
        return view('backend.fabric.add_fabric', compact('categories', 'previousUrl'));
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
        $rec = new XztFabric();
        if ($request->has('name')) {$rec->name = $request->name;}
        if ($request->has('fab_code')) {$rec->fab_code = $request->fab_code;}
        if ($request->has('searchcat')) {$rec->shade_cat = $request->searchcat;}
        if ($request->has('searchsubcat')) {$rec->shade_subcat = $request->searchsubcat;}
        if ($request->has('fab_specs')) {$rec->fab_specs = $request->fab_specs;}
        if ($request->has('show_in_gallery')) {$rec->show_in_gallery = $request->show_in_gallery;}
        if ($request->hasFile('fabric_image')) {
            $file = $request->file('fabric_image');
            // $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // $name = time().'-'.$name;
            $name = time() . '.' . $ext;
            $file->move(public_path() . '/fabric/images', $name);
            $rec->url = $name;
        }
        if ($request->has("min_width") && (int) $request->has("min_width") > 0) {
            $rec->min_width = $request->min_width;
        }
        if ($request->has("max_width") && (int) $request->has("max_width") > 0) {
            $rec->max_width = $request->max_width;
        }
        $rec->save();

        $previousUrl = $request->previousUrl;
        if($previousUrl) {
            return redirect($previousUrl);
        }

        return redirect()->route('fabric.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $previousUrl = url()->previous();
        
        $fabric = XztFabric::where('id', $id)->first();
        $categories = Category::where('parent_id', 1)->get();
        $subcategories = Category::where('parent_id', $fabric->shade_cat)->get();
        return view('backend.fabric.edit_fabric', compact('fabric', 'categories', 'subcategories', 'previousUrl'));
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
        $rec = XztFabric::find($id);
        if ($request->has('name')) {$rec->name = $request->name;}
        if ($request->has('fab_code')) {$rec->fab_code = $request->fab_code;}
        if ($request->has('searchcat')) {$rec->shade_cat = $request->searchcat;}
        if ($request->has('searchsubcat')) {$rec->shade_subcat = $request->searchsubcat;}
        if ($request->has('fab_specs')) {$rec->fab_specs = $request->fab_specs;}
        if ($request->has('show_in_gallery')) {
            $rec->show_in_gallery = $request->show_in_gallery;
        } else {
            $rec->show_in_gallery = "No";
        }
        if ($request->hasFile('fabric_image')) {
            if (file_exists(public_path('fabric/images' . '/' . $rec->url))) {
                unlink(public_path('fabric/images' . '/' . $rec->url));
            }
            $file = $request->file('fabric_image');
            $ext = $file->getClientOriginalExtension();
            $name = time() . '.' . $ext;
            $file->move(public_path() . '/fabric/images', $name);
            $rec->url = $name;
        }

        //Min and Max width
        if ($request->has("min_width") && (int) $request->has("min_width") > 0) {
            $rec->min_width = $request->min_width;
        } else {
            $rec->min_width = null;
        }
        if ($request->has("max_width") && (int) $request->has("max_width") > 0) {
            $rec->max_width = $request->max_width;
        } else {
            $rec->max_width = null;
        }

        $rec->save();

        $previousUrl = $request->previousUrl;
        if($previousUrl) {
            return redirect($previousUrl);
        }

        return redirect()->route('fabric.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = XztFabric::find($id);
        $del->archived = 1;
        $del->show_in_gallery = 'No';
        $del->save();
        return back();
    }

    public function visibility($id, $status)
    {
        // dd($status);
        $rec = XztFabric::find($id);
        $rec->show_in_gallery = $status;
        $rec->save();
        return back();

    }

    public function recover($id)
    {
        // dd($status);
        $rec = XztFabric::find($id);
        $rec->archived = 0;
        $rec->show_in_gallery = 'Yes';
        $rec->save();
        return back();
    }

    public function seller_fabric_list(Request $request)
    {
        $sort_search = null;
        $searchcat = null;
        // $customers = Customer::orderBy('created_at', 'desc');
        $categories = Category::where('parent_id', 1)->get();
        $fabrics = XztFabric::where('show_in_gallery', 'Yes')->where('archived', 0)->orderBy('created_at', 'desc');
        if ($request->has('search')) {
            $sort_search = $request->search;
            $fabrics = $fabrics->where('name', 'like', '%' . $sort_search . '%');
        }
        $searchcat = $request->searchcat;

        if ($request->has('searchcat') && $request->input('searchcat')) {
            $fabrics = $fabrics->where('shade_cat', $request->input('searchcat'));
        }
        $searchsubcat = $request->searchsubcat;
        if ($request->has('searchsubcat') && $request->input('searchsubcat')) {
            $fabrics = $fabrics->where('shade_subcat', $searchsubcat);
        }

        $fabrics = $fabrics->get();

        // dd($fabrics);
        return view('frontend.user.seller.fabric.fabrics', compact('fabrics', 'searchsubcat', 'sort_search', 'categories', 'searchcat'));
    }

    public function shade_subcat(Request $request)
    {
        $subcategory = Category::where('parent_id', $request->parent_cat)->get();
        foreach ($subcategory as $item) {
            echo "<option value='" . $item->id . "' data-parent='" . $item->parent_id . "' >" . $item->name . "</option>";
        }
    }

}