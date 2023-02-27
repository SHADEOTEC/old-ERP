<?php

namespace App;

use App\Models\Price;
use App\Models\XztMotorCts;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MotorsExport implements FromCollection, WithMapping, WithHeadings
{

    function __construct() {
    }
    public function collection()
    {
        return XztMotorCts::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'ct_code',
            'name',
            'price',
            'length',
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
            $motors->ct_code,
            $motors->name,
            $motors->price,
            $motors->length,
            $motors->state,
            $motors->archived == 0 ? '0' : $motors->archived,
//            $product->current_stock,
            //$qty,
        ];
    }
}
