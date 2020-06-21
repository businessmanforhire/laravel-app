<?php

namespace App\Imports;

use App\BusinessCategory;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Validators\Failure;


class CategoryImport implements WithHeadingRow, WithValidation, SkipsOnFailure,OnEachRow
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $cat_id = null;

    public function __construct(  $cat_id) {
        $this->cat_id = $cat_id;
    }

    public function onRow(Row $row)
    {
        $row=$row->toArray();

        Category::create([

            'name' => $row['name'],
            'image' => $row['image'],
            'business_category_id' => $this->cat_id,
            'user_create_id' => Auth::id(),
        ]);

    }

    public function rules(): array
    {
        return [
            'name'=>'required',
            'image'=>'required',
        ];
    }
}
