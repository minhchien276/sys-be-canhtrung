<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateCategoryProductRequest;
use App\Http\Requests\UpdateProductDetailsRequest;
use App\Http\Requests\UpdateProductRequest;
use App\ServicesAdmin\ProductAdmin\CreateProduct;
use App\ServicesAdmin\ProductAdmin\EditProduct;
use App\ServicesAdmin\ProductAdmin\IndexProduct;
use App\ServicesAdmin\ProductAdmin\ListProducts;
use App\ServicesAdmin\ProductAdmin\ProductCategories;
use App\ServicesAdmin\ProductAdmin\ProductDetails;
use App\ServicesAdmin\ProductAdmin\ProductDiscount;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $indexProduct;
    private $createProduct;
    private $editProduct;
    private $productDetails;
    private $productCategories;
    private $productDiscount;
    private $listProducts;

    public function __construct(
        IndexProduct $indexProduct,
        CreateProduct $createProduct,
        EditProduct $editProduct,
        ProductDetails $productDetails,
        ProductCategories $productCategories,
        ProductDiscount $productDiscount,
        ListProducts $listProducts,
    ) {
        $this->indexProduct = $indexProduct;
        $this->createProduct = $createProduct;
        $this->editProduct = $editProduct;
        $this->productDetails = $productDetails;
        $this->productCategories = $productCategories;
        $this->productDiscount = $productDiscount;
        $this->listProducts = $listProducts;
    }

    public function index()
    {
        return $this->indexProduct->index();
    }

    public function create()
    {
        return $this->createProduct->create();
    }

    public function store(CreateProductRequest $request)
    {
        return $this->createProduct->store($request);
    }

    public function edit($id)
    {
        return $this->editProduct->edit($id);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        return $this->editProduct->update($request, $id);
    }

    public function productDetails($id)
    {
        return $this->productDetails->productDetails($id);
    }

    public function editProductDetails($id)
    {
        return $this->productDetails->editProductDetails($id);
    }

    public function updateOrInsert(UpdateProductDetailsRequest $request, $id)
    {
        return $this->productDetails->updateOrInsert($request, $id);
    }

    public function createProductDetails(Request $request)
    {
        return $this->productDetails->createProductDetails($request);
    }

    public function storeDetail(UpdateProductDetailsRequest $request)
    {
        return $this->productDetails->storeDetail($request);
    }

    public function createCategory()
    {
        return $this->productCategories->createCategory();
    }

    public function storeCategory(CreateProductCategoryRequest $request)
    {
        return $this->productCategories->storeCategory($request);
    }

    public function namGioi()
    {
        return $this->listProducts->namGioi();
    }

    public function nuGioi()
    {
        return $this->listProducts->nuGioi();
    }

    public function daVaLamDep()
    {
        return $this->listProducts->daVaLamDep();
    }

    public function meVaBe()
    {
        return $this->listProducts->meVaBe();
    }

    public function tuoiDayThi()
    {
        return $this->listProducts->tuoiDayThi();
    }

    public function listCategories()
    {
        return $this->productCategories->listCategories();
    }

    public function editCategory($id)
    {
        return $this->productCategories->editCategory($id);
    }

    public function updateCategory(UpdateCategoryProductRequest $request, $id)
    {
        return $this->productCategories->updateCategory($request, $id);
    }

    public function discounting()
    {
        return $this->productDiscount->discounting();
    }
}
