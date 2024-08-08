<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'tbprodutos';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Cod', 'Entrada', 'Codigo', 'Produto', 'NCM', 'Embalagem', 'Tamanho', 'Cor', 'Grupo', 'Peso',
        'unidade', 'OBS', 'Fabricante', 'desativado', 'Complemento', 'EnviarPBalanca', 'CodigoFabricante',
        'Sugestoes', 'TipoPSO', 'Referencia', 'origem', 'cListServ', 'CodEAN', 'DescricaoEtiqueta', 'marca',
        'modelo', 'FabricacaoPropria', 'CodEFO', 'CodigoANP', 'Data_Sync', 'RefSite', 'ProdPesavel', 'Ciclo',
        'ObrigaSelTabelaValorPDV', 'CEST', 'MultiplicarEmbalagem', 'ImprimirBar', 'ImprimirCozinha', 'NaoUsarGrade',
        'pGLP', 'pGNn', 'pGNi', 'EmbalagemEntrada', 'Fraciona', 'SetorRetirada', 'EnviarEZ', 'EZ_Enviar',
        'EZ_Enviado', 'CodigoIntEz', 'Favorito', 'DataUpdate', 'CodBalanca', 'CodigoTrayCommerce', 'EnviarTray',
        'EnviadoTray', 'CodCliente', 'CodEmbalagem', 'PesoBruto', 'CodCat', 'CodSubCat', 'ec_Codigo', 'ec_CodCat',
        'ec_CodSubCat', 'CodigoSKU', 'CodigoDesenho', 'NumeroSerie', 'RegistroAnvisa', 'GrauRisco',
        'codigobalanca', 'DescricaoANP', 'UnidadeTrib'
    ];

    public function images()
    {
        // return $this->belongsTo(ProductImage::class, 'codigo', 'Codigo');
        return $this->hasMany(ProductImage::class, 'codigo', 'Codigo');
    }


    public function stock()
    {
        return $this->hasOne(ProductStock::class, 'codigo', 'Codigo');
    }

    public function details()
    {
        return $this->hasOne(ProductTechnicalInformation::class, 'Codigo', 'Codigo');
    }
}
