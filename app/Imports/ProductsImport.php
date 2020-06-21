<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImport implements WithHeadingRow, WithValidation, SkipsOnFailure,OnEachRow
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function onRow(Row $row)
    {
        $row=$row->toArray();

           Product::create([

               'name' => $row['name'],
                'description' => $row['description'],
                'image' => $row['image'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
//                'category_id' => $row['category_id'],
                'category_id' => 12,
                'business_id' => Auth::id(),
                'user_create_id' => Auth::id(),
            ]);

    }

    public function rules(): array
    {
        return [
            'name'=>'required',
            'description'=>'required',
//            'image'=>'required',
            'price'=>'required',
            'quantity'=>'required',
//            'category_id' => 'required',
        ];
    }

}
