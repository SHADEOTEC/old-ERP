<?php

namespace App;

use App\Models\Price;
use App\Models\XztCassette;
use App\Models\XztMotorCts;
use App\Models\XztWidMotors;
use App\Models\XztWrap;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class XztCassettePricesExport implements FromCollection, WithMapping, WithHeadings
{

    function __construct() {
    }
    public function collection()
    {
        return XztCassette::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'cassette_code',
            'name',
            'category_id',
            'min_wid',
            'max_wid',
            'price',
            'state',
            'archived',
        ];
    }

    /**
    * @var XztMotorCts $motors
    */
    public function map($motors): array
    {
        /*$qty = 0;
        foreach ($product->stocks as $key => $stock) {
            $qty += $stock->qty;
        }*/
        return [
            $motors->id,
            $motors->cassette_code,
            $motors->name,
            $motors->category_id,
            $motors->min_wid,
            $motors->max_wid,
            $motors->price,
            $motors->state,
            $motors->archived == 0 ? '0' : $motors->archived,
//            $product->current_stock,
            //$qty,
        ];
    }
}
