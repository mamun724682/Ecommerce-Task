<?php

namespace App\Services;

use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;

class ProductService extends BaseService
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $file_path
     * @return void
     */
    public function import(string $file_path): void
    {
        Excel::import(new ProductsImport, $file_path);
    }

    /**
     * Get paginated data
     *
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return $this->model::paginate();
    }
}
