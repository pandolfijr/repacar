<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    use HasFactory;

    protected $table = 'tbestoque';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Cod', 'codigo', 'Quantidade', 'Valor', 'Venda', 'VendaMinima', 'Comissao', 'Minimo', 'Margem', 'MargemMinima', 'pIPI', 'pICMS',
        'CSTICMS', 'CF', 'ProdutoPromocao', 'Frete', 'DifIcms', 'setor', 'DescVenda', 'DescCusto', 'NPC', 'pMVAST', 'pRedBC', 'NovoCusto',
        'CSTPis', 'CSTCofins', 'pPIS', 'pCofins', 'CSTIpi', 'pCredSN', 'modBC', 'modBCST', 'pRedBCST', 'pISS', 'SequenciaIni', 'SequenciaFi',
        'pICMSST', 'NaoSomar', 'ISS', 'pIPICusto', 'SubTribCusto', 'TributacaoECF', 'ValorLocacao', 'IvaStCusto', 'IcCusto', 'IcmsManual',
        'ProdutoText', 'UsarLegenda', 'Largura', 'Altura', 'ProdutoMontado', 'pLeiTransparencia', 'PromoDataINI', 'PromoDataFI', 'PromoValor',
        'PromoPDesc', 'Data_Sync', 'nSites', 'CodEFO', 'ExibirNoSite', 'PromoDesc', 'Comprimento', 'Diametro', 'Legenda', 'Ambiente',
        'Maximo', 'Galpao', 'Rua', 'Torre', 'Nivel', 'Vao', 'pPerda', 'PromoMargem', 'QtdCancelada', 'UsarAmbiente', 'VendaTabela1',
        'VendaTabela2', 'VendaTabela3', 'VendaTabela4', 'VendaTabela5', 'VendaTabela6', 'NaoUsarGrade', 'ValorBc', 'ValorBcST', 'vICOutros',
        'QtdAcima', 'MargemAcimaQtd', 'VendaAcimaQtd', 'LegendaEN', 'Validade', 'SubDividir', 'QtdSoInt', 'ProdutoPorEncomenda',
        'vFreteNacional', 'vFreteInternacional', 'pIOFNacional', 'pIOFInternacional', 'Fator', 'CustoInicialDolar', 'Medio', 'UltimaDataDeVenda',
        'UltimaQuantidadeDeVenda', 'UltimaCustoCompra', 'UltimaNovoCustoCompra', 'UltimaDataCompra', 'pComP1Vendedor', 'pComP2Vendedor',
        'pComP3Vendedor', 'pComP1Cliente', 'pComP2Cliente', 'pComP3Cliente', 'Markup_pDespesas', 'pDiferimento', 'SetorRetirada', 'MarcaID_EZ',
        'Quantidade_ML', 'Enviar_ML', 'Codigo_ML', 'Categoria_ML', 'Tipo_Anun_ML', 'EnviarEZ', 'FFP_qtd_incluso', 'Markup_vCustoMedio', 'Grupo',
        'QtdVendidaRE', 'UltimaQuantidadeCompra', 'UltimaVendaAntesCompra', 'Markup_vPrejuizo', 'Markup_vDesc', 'Markup_pDesc', 'CFOP',
        'DataUpdate', 'AU_Valor', 'AU_Venda', 'AU_VendaMinima', 'AU_NovoCusto', 'AU_Margem', 'AU_MargemMinima', 'DataReajuste', 'ec_Enviar',
        'ec_Enviado', 'Lote', 'QtdMinimaFx', 'Markup_pDescSR1', 'Markup_pDescSR2', 'NaoPermMovEstIgualMenor0', 'NumeroSerie', 'RegistroAnvisa', 'GrauRisco'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'codigo', 'Codigo');
    }
}
