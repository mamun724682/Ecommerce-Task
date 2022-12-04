<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImportRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Product Import
     *
     * @route /api/v1/products-import
     * @param ProductImportRequest $request
     * @return JsonResponse
     */
    public function import(ProductImportRequest $request)
    {
        // Import csv file
        $this->productService->import($request->csv_file);

        return response()->success('The CSV file has been queued. Processing products import...');
    }

    /**
     * Paginated product list
     * @route /api/v1/products
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->success(
            'Product List.',
            new ProductResource($this->productService->getPaginate())
        );
    }
}
