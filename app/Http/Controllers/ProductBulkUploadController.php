<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\MotorsExport;
use App\ProductsExport;
use App\ProductsImport;
use App\UpdateMotorsPriceImport;
use App\UpdateProductsPriceImport;
use App\UpdateWidMotorsPriceImport;
use App\User;
use App\WidMotorsExport;
use App\XztCassettePriceImport;
use App\XztCassettePricesExport;
use App\XztWrapPriceImport;
use App\XztWrapPricesExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductBulkUploadController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_type == 'seller') {
            return view('frontend.user.seller.product_bulk_upload.index');
        } elseif (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('backend.product.bulk_upload.index');
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ProductsExport($request->shade_code), 'products.xlsx');
    }

    public function pdf_download_category()
    {
        $categories = Category::all();

        return Pdf::loadView('backend.downloads.category', ['categories' => $categories])->download('category.pdf');
    }

    public function pdf_download_brand()
    {
        $brands = Brand::all();

        return PDF::loadView('backend.downloads.brand', ['brands' => $brands])->download('brands.pdf');
    }

    public function pdf_download_seller()
    {
        $users = User::where('user_type', 'seller')->get();

        return PDF::loadView('backend.downloads.user', [
            'users' => $users,
        ], [], [])->download('user.pdf');

    }

    public function bulk_upload(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            $import = new ProductsImport;
            Excel::import($import, request()->file('bulk_file'));

            if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null &&
                \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated) {
                $seller = Auth::user()->seller;
                $seller->remaining_uploads -= $import->getRowCount();
                $seller->save();
            }
//            dd('Row count: ' . $import->getRowCount());
        }

        return back();
    }
    public function BulkUpdateProduct(Request $request)
    {
        try {
            if ($request->hasFile('bulk_file')) {
                Excel::import(new UpdateProductsPriceImport, request()->file('bulk_file'));
            }
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->withErrors(["msq" => $exception->getMessage()]);
        }

    }

    public function motorPricesexport(Request $request)
    {
        return Excel::download(new MotorsExport(), 'motors.xlsx');
    }
    public function BulkUpdateMotors(Request $request)
    {
        try {
            if ($request->hasFile('bulk_file_motors')) {
                $imported = Excel::import(new UpdateMotorsPriceImport(), request()->file('bulk_file_motors'));
            }
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->withErrors(["msq" => $exception->getMessage()]);
        }

    }

    public function widMotorPricesexport(Request $request)
    {
        return Excel::download(new WidMotorsExport(), 'wid_motors.xlsx');
    }
    public function widBulkUpdateMotors(Request $request)
    {
        try {
            if ($request->hasFile('bulk_file_motors')) {
                $imported = Excel::import(new UpdateWidMotorsPriceImport(), request()->file('bulk_file_motors'));
            }
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->withErrors(["msq" => $exception->getMessage()]);
        }

    }
    public function wrapPricesexport(Request $request)
    {
        return Excel::download(new XztWrapPricesExport(), 'wraps.xlsx');
    }
    public function BulkUpdateWrap(Request $request)
    {
        try {
            if ($request->hasFile('bulk_file_motors')) {
                $imported = Excel::import(new XztWrapPriceImport(), request()->file('bulk_file_motors'));
            }
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->withErrors(["msq" => $exception->getMessage()]);
        }

    }
    public function cassettePricesexport(Request $request)
    {
        return Excel::download(new XztCassettePricesExport(), 'cassettes.xlsx');
    }
    public function BulkUpdateCassette(Request $request)
    {
        try {
            if ($request->hasFile('bulk_file_motors')) {
                $imported = Excel::import(new XztCassettePriceImport(), request()->file('bulk_file_motors'));
            }
            return back();
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->back()->withErrors(["msq" => $exception->getMessage()]);
        }

    }

}