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
class UpdateProductsPriceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows) {
        $canImport = true;
        if($canImport) {
            DB::beginTransaction();
            foreach ($rows as $row) {
                DB::table('price')
                    ->where('id', '=', $row['id'])
                    ->update([
                        'cat_id' => $row['cat_id'],
                        'shade_code' => $row['shade_code'],
                        'price_code' => $row['price_code'],
                        'width' => $row['width'],
                        'length' => $row['length'],
                        'price' => $row['price'],
                        'square_cassette' => $row['square_cassette'],
                        'fabric_wrap' => $row['fabric_wrap'],
                        'std_r_cassette' => $row['std_r_cassette'],
                        'wid_diff' => $row['wid_diff'],
                        'len_diff' => $row['len_diff'],
                        'round_cassette' => $row['round_cassette'],
                        'motor_array' => $row['motor_array'],
                    ]);
            }
            DB::commit();
            flash(translate('Products prices updated successfully'))->success();
        }
    }

}
