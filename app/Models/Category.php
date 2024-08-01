<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tbcategorias';
    protected $primaryKey = 'CodSubCat';
    public $incrementing = true;
    protected $keyType = 'string';
}
