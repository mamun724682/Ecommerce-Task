<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProductsImport implements ToModel, SkipsEmptyRows, WithHeadingRow, WithValidation, SkipsOnFailure, WithChunkReading, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'name'  => $row['product_name'],
            'brand' => $row['brand'],
            'price' => str_replace('€', '', $row['price'])
        ]);
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @param $data
     * @param $index
     * @return mixed
     */
    public function prepareForValidation($data, $index)
    {
        $data['price'] = (double) str_replace('€', '', $data['price']);
        return $data;
    }

    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string'],
            'brand'        => ['required', 'string'],
            'price'        => ['required', 'numeric'],
        ];
    }

    /**
     * @param Failure ...$failures
     * @return void
     */
    public function onFailure(Failure ...$failures)
    {
        logger($failures);
    }
}
