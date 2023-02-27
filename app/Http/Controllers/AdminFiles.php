<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Download;
use App\Models\AllowedDownload;
use App\User;
use Auth;

class AdminFiles extends Controller
{
    public function index() {
        $files = Download::all();
        return view('backend.uploaded_files.index', compact('files'));
    }
    
    public function create() {
        $sellers = User::where('user_type', 'seller')->get();
        return view('backend.uploaded_files.create', compact('sellers'));
    }

    public function status(){
        return view('backend.orderstatus.order_status');
    }

    public function UploadFile(Request $request) {
        $file = $request->file('file_upl');
        $name = $file->getClientOriginalName();
        $name = time().'-'.$name;
        $file->move(public_path().'/download/', $name);
        $rec = new Download();
        $rec->user_id = Auth::user()->id;
        $rec->filename = $name;
        $rec->save();
        
        if($request->has('user_list')) {
            foreach($request->user_list as $item) {
                $rec_download = new AllowedDownload();
                $rec_download->download_id = $rec->id;
                $rec_download->user_id = $item;
                $rec_download->save();
            }
        }
        return redirect()->route('uploaded-files.list');
    }

    public function DelFile(Request $request, $id) {
        $rec = Download::find($id)->delete();
        $rec_download = AllowedDownload::where('download_id', $id)->delete();
        return redirect()->route('uploaded-files.list');
    } 
}
