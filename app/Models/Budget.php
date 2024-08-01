<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'tbsaida';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Cod', 'Pedido', 'Data', 'codigo', 'Quan', 'Compra', 'Venda', 'Cliente', 'Vendedor', 'modo', 'Desc1', 'ST', 'grade', 'Grupo',
        'Comissao', 'pIPI', 'TipoGrade', 'pICMS', 'OrigemDoc', 'Desc2', 'VendaMinima', 'vBC', 'vICMS', 'vIPI', 'CSTICMS', 'uCFOP',
        'pMVAST', 'ProdutoDeletado', 'CF', 'Unidade', 'pRedBC', 'ncm', 'CodigoAmaraPMP', 'CSTPis', 'CSTCofins', 'pPIS', 'pCofins',
        'CSTIpi', 'NFEntrada', 'Origem', 'pCredSN', 'modBC', 'modBCST', 'pRedBCST', 'pISS', 'pICMSST', 'Sequencia', 'NaoSomar', 'ISS',
        'vBCST', 'VBCISS', 'vBCIPI', 'vBCPIS', 'vBCCOFINS', 'vBCSTRet', 'vICMSST', 'vISS', 'vPIS', 'vCOFINS', 'vICMSSTRet', 'vCredICMSSN',
        'vFrete', 'vSeguro', 'vDesconto', 'vOutras', 'CodEFO', 'TributacaoECF', 'LegendaProduto', 'ValorLocacao', 'DescValorLocacao',
        'IcmsManual', 'SubGrade', 'vAcrescRAT', 'vDescsRAT', 'vComissao', 'vCreditoRAT', 'pLeiTransparencia', 'FechoCaixaPDV', 'TerminalPDV',
        'ItemEmFalta', 'ReservadoFisco', 'QtdDevolveuLocacao', 'FinalizouDevo', 'DataDevProd', 'ProdPromo', 'CorPedido', 'Ambiente',
        'nItemPed', 'NPedidoCompra', 'NaoImpRomaneio', 'ObsItem', 'MetrosLinear', 'QtdPecas', 'FechouCaixaPorTerminal', 'Terminal',
        'Usuario', 'JaImprimiuBar', 'JaImprimiuCozinha', 'FFP_DescricaoPizza', 'VendaOriginalEstoque', 'QtdEntRet', 'QtdSaldo', 'QtdRE',
        'CorItem', 'UltimaQTDRet', 'UltimoTipoRetirada', 'ItemExcluido', 'OndeExcluiu', 'OrigemAplicativo', 'QuantidadeEmEstoque',
        'pICMS_Inter', 'vBCII', 'vII', 'pII', 'Participante1', 'Participante2', 'Participante3', 'pComP1', 'pComP2', 'pComP3', 'vComP1',
        'vComP2', 'vComP3', 'VendaDolar', 'CotacaoDolar', 'CodProfissional', 'CodRepresenta', 'pComProfissional', 'pComRepresenta',
        'OBSRetirada', 'TabelaVenda', 'pGLP', 'pGNn', 'pGNi', 'CodigoANP', 'DataFechoCaixa', 'Devolucao_QtdDevolveu', 'Devolucao_PedidoDevolucao',
        'Devolucao_PedidoVenda', 'vComprimento', 'vLargura', 'vAltura', 'QuemRetirou', 'RetServicos', 'vTotalServico', 'UsouDescQdtPorCodigo',
        'pComP1Vendedor', 'pComP2Vendedor', 'pComP3Vendedor', 'pComP1Cliente', 'pComP2Cliente', 'pComP3Cliente', 'vComP1Vendedor', 'vComP2Vendedor',
        'vComP3Vendedor', 'vComP1Cliente', 'vComP2Cliente', 'vComP3Cliente', 'CodigoP1Vendedor', 'CodigoP2Vendedor', 'CodigoP3Vendedor',
        'CodigoP1Cliente', 'CodigoP2Cliente', 'CodigoP3Cliente', 'TipoComissao', 'CodigoIndicouVendedor', 'CodigoCadastrouVendedor',
        'pComissaoIndicouVendedor', 'pComissaoCadastrouVendedor', 'vComissaoIndicouVendedor', 'vComissaoCadastrouVendedor', 'pComissaoIndicouRealVendedor',
        'pComissaoCadastrouRealVendedor', 'CodigoIndicouCliente', 'CodigoCadastrouCliente', 'pComissaoIndicouCliente', 'pComissaoCadastrouCliente',
        'vComissaoIndicouCliente', 'vComissaoCadastrouCliente', 'pComissaoIndicouRealCliente', 'pComissaoCadastrouRealCliente', 'QtdDevolveu',
        'pDiferimento', 'iExpedido', 'Exp_iQtdRetE', 'Exp_iQtdEntE', 'Exp_iQtdRetS', 'Exp_iQtdEntS', 'PedidoID_EZ', 'StatusID_EZ',
        'vCustosOperacionaisRAT', 'FFP_ProdOrigem', 'FFP_nItem', 'Exp_Status', 'QtdDevolveuTemp', 'nItem', 'UsouDescQdtPorGrupo', 'DescServExtras',
        'MontadoGridArray', 'DiasLocacao', 'ProdutoPorEncomenda', 'ProdutoMontado', 'Embalagem', 'CodEmbalagem', 'PedidoTray', 'TipoMov',
        'PedidoPalm', 'TabelaVendaNome', 'GF', 'AC', 'AF', 'NC', 'ES', 'nPedidoAglutinado', 'NumeroSerie', 'ec_pedido', 'mobileValorUnitario',
        'mobileAcrescimo', 'PesoLiq', 'vDescQtd', 'Acrescimo', 'CodBarrasGrade', 'LocacaoItemDDH', 'LocacaoItemPeriodo', 'LocacaoItemDataInicio',
        'LocacaoItemHoraInicio', 'LocacaoItemDataFinal', 'LocacaoItemHoraFinal', 'DescricaoANP', 'UnidadeTrib', 'pedido_vICMSST'
    ];
}
