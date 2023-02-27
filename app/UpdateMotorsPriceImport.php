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
class UpdateMotorsPriceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows) {
        $canImport = true;
        if($canImport) {
            DB::beginTransaction();
            foreach ($rows as $row) {
                DB::table('xzt_motor_cts')
                    ->where('id', '=', $row['id'])
                    ->update([
                        'ct_code' => $row['ct_code'],
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'length' => $row['length'],
                        'state' => $row['state'],
                        'archived' => $row['archived'],
                    ]);
            }
            DB::commit();
            flash(translate('Motor prices updated successfully'))->success();
        }
    }

}
