<?php

namespace App;

use App\Product;
use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $shade_code;
    function __construct($shade_code) {
        $this->shade_code = $shade_code;
    }
    public function collection()
    {
        return Price::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'cat_id',
            'shade_code',
            'price_code',
            'width',
            'length',
            'price',
            'square_cassette',
            'fabric_wrap',
            'purchase_price',
            'std_r_cassette',
            'wid_diff',
            'len_diff',
            'round_cassette',
            'motor_array',
        ];
    }

    /**
    * @var Product $product
    */
    public function map($product): array
    {
        //$qty = 0;
        //foreach ($product->stocks as $key => $stock) {
          //  $qty += $stock->qty;
        //}
        return [
            $product->id,
            $product->cat_id,
            $product->shade_code,
            $product->price_code,
            $product->width,
            $product->length,
            $product->price,
            $product->square_cassette,
            $product->fabric_wrap,
            $product->purchase_price,
            $product->std_r_cassette,
            $product->wid_diff,
            $product->len_diff,
            $product->motor_array,
//            $product->current_stock,
            //$qty,
        ];
    }
}
