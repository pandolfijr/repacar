<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ProductRepository;
use App\Interfaces\Repository\UserRepository;
use App\Interfaces\Service\ProductService;

class ProductServiceImpl implements ProductService
{
    private $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(array $input): Result
    {
        return $this->productRepository->getProducts($input);
    }

    public function getCategories(): Result
    {
        return $this->productRepository->getCategories();
    }

    public function getCategory(string $category): Result
    {
        return $this->productRepository->getCategory($category);
    }

    public function getSubCategory(string $subcategory): Result
    {
        return $this->productRepository->getSubCategory($subcategory);
    }

    public function getProductById(string $id): Result
    {
        return $this->productRepository->getProductById($id);
    }

}
