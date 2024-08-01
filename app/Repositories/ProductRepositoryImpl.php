<?php

namespace App\Repositories;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ProductRepository;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Database\Eloquent\Relations\BelongsTo as QueryBuilder;

class ProductRepositoryImpl implements ProductRepository
{
    public function getProducts(array $input): Result
    {
        try {
            $db = Product::with(['images', 'stock'])->where('TipoPSO', 'Produto')->orderBy('Cod');
            if (!empty($input['CodCat'])) {
                $db->where('CodCat', $input['CodCat']);
            }
            if (!empty($input['CodSubCat'])) {
                $db->where('CodSubCat', $input['CodSubCat']);
            }
            if (!empty($input['filter'])) {
                $searchTerm = '%' . $input['filter'] . '%';
                $db->whereRaw('LOWER(`Produto`) LIKE ?', [$searchTerm]);
            }
            $products = $db->get();
            return Result::success(['products' => $products]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'ProductRepositoryImpl > getProducts',
                    'Erro ao buscar produtos:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    public function getCategories(): Result
    {
        try {
            $categories = ProductCategory::with('subCategory')->orderBy('Categoria')->get();
            return Result::success(['categories' => $categories]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'UserRepository > getCategories',
                    'Erro ao buscar categorias',
                    500,
                )
            );
        }
    }

    /**
     *
     * @param array $input
     * @return \App\Helpers\Result
     */
    public function getCategory(string $category): Result
    {
        try {
            $db = ProductCategory::orderBy('Codigo');
            if (!empty($category))
                $db->where('Codigo', $category);

            $category = $db->first();
            return Result::success(['category' => $category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'UserRepository > getCategory',
                    'Erro ao buscar categoria: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    /**
     *
     * @param array $input
     * @return \App\Helpers\Result
     */
    public function getSubCategory(string $subcategory): Result
    {
        try {
            $db = ProductSubCategory::with('category')->orderBy('Codigo');
            if (!empty($subcategory))
                $db->where('Codigo', $subcategory);

            $category = $db->first();
            return Result::success(['category' => $category]);
        } catch (\Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'UserRepository > getCategory',
                    'Erro ao buscar categoria: ' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
