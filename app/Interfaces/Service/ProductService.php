<?php

namespace App\Interfaces\Service;

use App\Helpers\Result;

interface ProductService
{
    public function getProducts(array $input): Result;
    public function getCategories(): Result;
    public function getCategory(string $category): Result;
    public function getSubCategory(string $subcategory): Result;
    public function getProductById(string $id): Result;
}
