<?php

namespace App;

use App\Product;
use App\ProductStock;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;
use Maatwebsite\Excel\Facades\Excel;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class XztWrapPriceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows) {
        $canImport = true;
        if($canImport) {
            DB::beginTransaction();
            foreach ($rows as $row) {
                DB::table('xzt_wraps')
                    ->where('id', '=', $row['id'])
                    ->update([
                        'wrap_code' => $row['wrap_code'],
                        'name' => $row['name'],
                        'min_wid' => $row['min_wid'],
                        'max_wid' => $row['max_wid'],
                        'price' => $row['price'],
                        'state' => $row['state'],
                        'archived' => $row['archived'],
                    ]);
            }
            DB::commit();
            flash(translate('Wrap prices updated successfully'))->success();
        }
    }

}
