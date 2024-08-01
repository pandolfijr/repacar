<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailedBudget extends Model
{
    use HasFactory;

    protected $table = 'tbsaidadet';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Cod', 'nFatura', 'Data', 'Pedido', 'NotaSituacao', 'Nota', 'GF', 'Cliente', 'Vendedor', 'modo', 'Frete', 'DescTotal',
        'Total', 'OBS', 'st', 'TipoPgto', 'Transportadora', 'Volumes', 'FormaPgto', 'Grupo', 'Impresso', 'MsgCredito', 'Hora',
        'DescricaoOS', 'Situacao', 'ValorSeguro', 'OutrasDespesas', 'Emissao', 'Entrada', 'cfop', 'iest', 'vBC', 'vICMS', 'vBCST',
        'vICMSST', 'vIPI', 'vTotProd', 'vTotGeral', 'FretePC', 'Quant', 'Especie', 'Marca', 'Numero', 'PesoB', 'PesoL', 'TipoNF',
        'OBSDadosAdicionais', 'vTotServ', 'JustificaCancelada', 'Placa', 'UFPlaca', 'LoteNumero', 'chNota', 'LoteSituacao', 'LoteMsg',
        'LoteRecibo', 'NotaNumero', 'NotaMsg', 'NotaDigVal', 'NotaCstat', 'NotaNumeroAutorizacao', 'NotaDataAutorizacao', 'DanfeEmitido',
        'rsp0', 'rsp1', 'rsp2', 'rsp3', 'rsp4', 'rsp5', 'rsp6', 'rsp7', 'rsp8', 'rsp9', 'Npedido', 'Natureza', 'vBCISS', 'vBCIPI', 'vBCPIS',
        'vBCCOFINS', 'vISS', 'vPIS', 'vCOFINS', 'vII', 'CampoOsPers1', 'CampoOsPers2', 'CampoOsPers3', 'CampoOsPers4', 'LegendaCliente',
        'DescricaoOSInterna', 'CampoOsPers5', 'CampoOsPers6', 'CampoOsPers7', 'CampoOsPers8', 'CampoOsPers9', 'CampoOsPers10', 'pIndicador',
        'CodEFO', 'vTotCusto', 'CampoDadosAddPer1', 'CampoDadosAddPer2', 'CampoDadosAddPer3', 'DataRetiradaLocacao', 'DataDevolucaoLocacao',
        'InstrucoesLocacao', 'CondicoesLocacao', 'nContrato', 'UltimaDataSenhaExpiraAlterada', 'NFeIndex', 'vTotComissao', 'AC', 'AF',
        'NC', 'ES', 'TipoJuros', 'CreditoUsado', 'SerieNFe', 'FechoCaixaPDV', 'TerminalPDV', 'DescPercentual', 'VorPdesc', 'ConfirmaPedido',
        'DevolucaoAmarrada', 'FinalizouDevo', 'PeriodoDev', 'NFeClienteNome', 'NFeClienteCnpj', 'NFeClienteEndereco', 'NFeClienteBairro',
        'NFeClienteCep', 'NFeClienteCidade', 'NFeClienteTelefone', 'NFeClienteEstado', 'NFeClientePais', 'NFeClienteIE', 'NFeClienteIS',
        'NFeClienteEmail', 'NFeEmpresaRazao', 'NFeEmpresaFantasia', 'NFeEmpresaCnpj', 'NFeEmpresaEndereco', 'NFeEmpresaBairro',
        'NFeEmpresaCep', 'NFeEmpresaCidade', 'NFeEmpresaTelefone', 'NFeEmpresaEstado', 'NFeEmpresaPais', 'NFeEmpresaIE', 'NFeEmpresaIEST',
        'NFeEmpresaIM', 'NFeEmpresaCodCidade', 'NFeEmpresaCNAE', 'NFeEmpresaRegime', 'NFeTransporteNome', 'NFeTransporteCnpj', 'NFeTransporteIE',
        'NFeTransporteEndereco', 'NFeTransporteCidade', 'NFeTransporteEstado', 'NFeClienteCidadeCod', 'NFeClientePaisCod', 'NFeEmpresaPaisCod',
        'TotalPontos', 'CorPedidoTotal', 'PedidoSeq', 'DataUpdate', 'FeitoPeloFreedom', 'NaoPermitirEdicaoModo', 'vTrocoPDV', 'nPedidoAglutinado',
        'NFeEmpresaRegEspTributacao', 'NFeEmpresaNumero', 'FFP_AF', 'FFP_Controle', 'FFP_TipoControle', 'FFP_Troco', 'FechouCaixaPorTerminal',
        'Terminal', 'Usuario', 'FFP_vGarcom', 'VisualizadoData', 'LegendaModo', 'FFP_Pago', 'ConfirmaPGTO', 'DataGerouECF', 'NFeEmpresaVersaoSistema',
        'vTotalTaxaCartao', 'vTotalTaxaATCartao', 'NFeClienteNumero', 'NFeClienteNumeroPassaporte', 'FinanceiroAglutinado', 'ConfirmadoNoCaixa',
        'NFeClienteEndeEnt', 'NFeClienteCidadeEnt', 'NFeClienteCidadeEntCod', 'NFeClienteUFE', 'NFeClienteNumeroEntrega', 'NFeClienteBairroEnt',
        'NFeClienteCepEnt', 'NFeTipoNFe', 'ManifestoEntrega', 'OrigemAplicativo', 'StatusPagamento', 'IdStatusPagamento', 'Participante1',
        'Participante2', 'Participante3', 'vTotalComP1', 'vTotalComP2', 'vTotalComP3', 'FechoCaixaFormaPGTO', 'CampoDadosAddPer4', 'CampoDadosAddPer5',
        'nInVoice', 'TotalDolar', 'CotacaoDolar', 'FreteDolar', 'vTotProdDolar', 'DocumentoDuplicado', 'CodProfissional', 'CodRepresenta',
        'pComProfissional', 'pComRepresenta', 'PreencherFretePadrao', 'CampoDadosAddPer0', 'NFeEnterCFOP', 'ECF_Modelo', 'ECF_Numero_Serie',
        'ECF_Contador_Reinicio_Operacao', 'ECF_Ultimo_COO', 'ECF_Numero_COO', 'ECF_CNPJ_Cliente', 'ECF_Nome_Cliente', 'ECF_Data_Reducao_Z',
        'ECF_Numero_Caixa', 'ECF_Numero_Reducao_Z', 'DataImpressao', 'TotalTroco', 'TotalPago', 'ImpCircular', 'EnderecoPadraoUnidade',
        'EnderecoPadraoTipo', 'EnderecoPadraoCep', 'EnderecoPadraoEndereco', 'EnderecoPadraoNumero', 'EnderecoPadraoComplemento',
        'EnderecoPadraoBairro', 'EnderecoPadraoEstado', 'EnderecoPadraoCidade', 'EnderecoPadraoTelefone', 'EnderecoPadraoEmail', 'EnderecoEntregaUnidade',
        'EnderecoEntregaTipo', 'EnderecoEntregaCep', 'EnderecoEntregaEndereco', 'EnderecoEntregaNumero', 'EnderecoEntregaComplemento', 'EnderecoEntregaBairro',
        'EnderecoEntregaEstado', 'EnderecoEntregaCidade', 'EnderecoEntregaTelefone', 'EnderecoEntregaEmail', 'EnderecoCobrancaUnidade', 'EnderecoCobrancaTipo',
        'EnderecoCobrancaCep', 'EnderecoCobrancaEndereco', 'EnderecoCobrancaNumero', 'EnderecoCobrancaComplemento', 'EnderecoCobrancaBairro', 'EnderecoCobrancaEstado',
        'EnderecoCobrancaCidade', 'EnderecoCobrancaTelefone', 'EnderecoCobrancaEmail', 'idVoucher', 'CodigoIndicou', 'CodigoCadastrou', 'pComissaoIndicou',
        'pComissaoCadastrou', 'DescontoTotalNosItens', 'DataFechoCaixa', 'Devolucao_PedidoDevolucao', 'Devolucao_PedidoVenda', 'Devolucao_TotalDevolucao',
        'Devolucao_TotalVenda', 'vDescTotalEspeciePgto', 'CondicaoPgtoMobile', 'pComP1Vendedor', 'pComP2Vendedor', 'pComP3Vendedor', 'pComP1Cliente',
        'pComP2Cliente', 'pComP3Cliente', 'vComP1Vendedor', 'vComP2Vendedor', 'vComP3Vendedor', 'vComP1Cliente', 'vComP2Cliente', 'vComP3Cliente',
        'CodigoP1Vendedor', 'CodigoP2Vendedor', 'CodigoP3Vendedor', 'CodigoP1Cliente', 'CodigoP2Cliente', 'CodigoP3Cliente', 'TipoComissao', 'CodigoIndicouVendedor',
        'CodigoCadastrouVendedor', 'pComissaoIndicouVendedor', 'pComissaoCadastrouVendedor', 'vComissaoIndicouVendedor', 'vComissaoCadastrouVendedor',
        'pComissaoIndicouRealVendedor', 'pComissaoCadastrouRealVendedor', 'CodigoIndicouCliente', 'CodigoCadastrouCliente', 'pComissaoIndicouCliente',
        'pComissaoCadastrouCliente', 'vComissaoIndicouCliente', 'vComissaoCadastrouCliente', 'pComissaoIndicouRealCliente', 'pComissaoCadastrouRealCliente',
        'imprimiuDanfe', 'iExpedido', 'Exp_iExpedido', 'Exp_iQtdPacote', 'Exp_iQtdPatio', 'pDescPontos', 'NotaFiscal_Auditoria_Status', 'PassouPeloConfirmaCaixa',
        'Devolucao_TrocoOrCredito', 'ComportarComoDevolucao', 'PedidoID_EZ', 'StatusID_EZ', 'PontualizzeSend', 'CustosOperacionais', 'nPedidoCompEncomenda',
        'Ficha', 'FFP_Divisao', 'imprimiuSAT', 'imprimiuNFCe', 'PedidoCompraSistema', 'CompraSistema', 'Status', 'DescTotalDev', 'DespesaTotalDev',
        'ComportarComoConsignado', 'NFeClienteEmailCobranca', 'NFePreview', 'PedidoTray', 'StatusPedidoTray', 'EnviadoCorreios', 'Separado', 'CodigoRastreio',
        'seller_Nome', 'seller_CNPJ', 'seller_ID', 'ComoClienteVeio', 'TipoMov', 'PedidoPalm', 'ComportarComoOrcamento', 'SolicitarNotaOutroSetor', 'idCel',
        'ec_pedido', 'ec_statusPedido', 'imprimiuPadrao', 'LevarMaquinaCartao', 'CampoOsPers11', 'CampoOsPers12', 'CampoOsPers13', 'CampoOsPers14',
        'CampoOsPers15', 'CampoOsPers16', 'CampoOsPers17', 'CampoOsPers18', 'CampoOsPers19', 'CampoOsPers20', 'CampoOsPers21', 'CampoOsPers22',
        'CampoOsPers23', 'CampoOsPers24', 'DataCriacao', 'NFContigencia', 'ModeloSAT', 'Solicitante', 'NFeClienteWhatsAppNome', 'NFeClienteWhatsAppNumero',
        'JustificaDevolucao', 'NFeClienteComplemento', 'NFeClienteComplementoEnt', 'NFeTransporteNumero', 'NFeTransporteBairro', 'LocacaoDDH', 'LocacaoHoraInicio',
        'LocacaoHoraFinal', 'Prioridade'
    ];
}
