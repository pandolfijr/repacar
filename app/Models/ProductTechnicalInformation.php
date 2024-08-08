<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTechnicalInformation extends Model
{
    use HasFactory;

    protected $table = 'tbinfotecnicas';
    protected $primaryKey = 'ID';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'ID', 'Codigo', 'Descritivo', 'Descricao', 'Sequencia', 'FormatarDescricao', 'DescritivoEN', 'DescricaoEN', 'ItensInclusos', 'MensagemAdicional', 'TempoGarantia', 'Disponibilidade'
    ];
}
