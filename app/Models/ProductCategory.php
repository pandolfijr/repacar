<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'tbprodutos_cat';
    protected $primaryKey = 'Codigo';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Codigo', 'Categoria', 'ec_Codigo'
    ];

    public function subCategory()
    {
        return $this->hasMany(ProductSubCategory::class, 'CodCat');
    }
}
