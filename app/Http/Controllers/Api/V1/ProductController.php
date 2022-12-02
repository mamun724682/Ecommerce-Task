<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImportRequest;
use App\Imports\ProductsImport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * @route /api/v1/products-import
     * @param ProductImportRequest $request
     * @return JsonResponse
     */
    public function import(ProductImportRequest $request)
    {
        // import csv file
        Excel::import(new ProductsImport, $request->csv_file);

        return response()->success('The CSV file has been queued. Processing products import...');
    }
}
