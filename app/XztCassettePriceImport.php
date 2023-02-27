<?php

namespace App;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

//class ProductsImport implements ToModel, WithHeadingRow, WithValidation
class XztCassettePriceImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $canImport = true;
        if ($canImport) {
            DB::beginTransaction();
            foreach ($rows as $row) {
                DB::table('xzt_cassettes')
                    ->where('id', '=', $row['id'])
                    ->update([
                        'cassette_code' => $row['cassette_code'],
                        'name' => $row['name'],
                        'category_id' => $row['category_id'],
                        'min_wid' => $row['min_wid'],
                        'max_wid' => $row['max_wid'],
                        'price' => $row['price'],
                        'state' => $row['state'],
                        'archived' => $row['archived'],
                    ]);
            }
            DB::commit();
            flash(translate('Cassete prices updated successfully'))->success();
        }
    }

}