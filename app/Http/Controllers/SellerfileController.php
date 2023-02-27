<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AllowedDownload;
use DB;
use Auth;

class SellerfileController extends Controller
{
    public function index(Request $request) {
        $allow = AllowedDownload::where('user_id', Auth::user()->id)->pluck('download_id');
        $files = DB::table('downloads')->select('*')->whereIn('id', $allow);
        $files = $files->paginate(15);
        return view('frontend.user.seller_files', compact('files'));
    }

    public function show_download($file_name) {
        $file_path = public_path('download/'.$file_name);
        return response()->download($file_path);
    }
}
