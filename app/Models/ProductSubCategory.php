<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $table = 'tbprodutos_subcat';
    protected $primaryKey = 'Codigo';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Codigo', 'SubCategoria', 'CodCat', 'Categoria', 'ec_Codigo', 'ec_CodigoCat'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'CodCat');
    }

}
