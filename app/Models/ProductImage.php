<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'tbestoqueimagens';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
       'ID', 'codigo', 'Imagem', 'numero', 'padrao', 'ImagemName', 'Caminho', 'DataUP', 'CaminhoSmall', 'CaminhoMini', 'CaminhoZoom', 'Grade', 'LinkVideo'
    ];

}
