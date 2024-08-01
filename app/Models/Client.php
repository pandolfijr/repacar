<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'tbcliente';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Cod', 'TipoCadastro', 'Indice', 'cliente', 'razao', 'DestacarOBSemMovimentacoes', 'contato', 'endereco',
        'cidade', 'Estado', 'bairro', 'Cep', 'telefone', 'CIC', 'RG', 'Entrada', 'Aniversario', 'obs', 'pai',
        'mae', 'conjuge', 'trabalho', 'ende', 'fone', 'salario', 'admissao', 'rc1', 'rc2', 'Rp1', 'rp2', 'Credito',
        'homepage', 'email', 'EstadoCivil', 'Profissao', 'sexo', 'ComoConheceu', 'ImprimirEtiqueta', 'desativado',
        'tabelapreco', 'vendedor', 'transportadora', 'grupo', 'Comissao', 'modocli', 'tipoconsumidor', 'Pais',
        'VSAV', 'DtCasa', 'Email1', 'im', 'isuf', 'usarlegenda', 'ClienteIsentoICMS', 'VinculoNfe', 'CodEFO',
        'BloquearVenda', 'motivobloqueio', 'Celular', 'EndeCob', 'CidadeCob', 'UFC', 'BairroCob', 'CepCob',
        'FoneCob', 'EndeEnt', 'CidadeEnt', 'UFE', 'BairroEnt', 'CepEnt', 'FoneEnt', 'Data_Sync', 'EmailCob',
        'EmailEnt', 'SenhaSite', 'complemento', 'numero', 'PrePgtoTipo', 'PrePgtoDias', 'PrePgtoPriDia',
        'PrePgtoSegDia', 'PrePgtoTerDia', 'PrePgtoQuaDia', 'estrelas', 'DescrEstrelas', 'ClienteProtestado',
        'NaoContribuinteICMS', 'VenderDinheiro', 'VenderCartao', 'VenderCheque', 'AutorizarLogar', 'NumeroPassaporte',
        'NumeroEntrega', 'uslo', 'NumeroCob', 'profissional', 'FreteCliente', 'CepCasa', 'EnderecoCasa',
        'EstadoCasa', 'CidadeCasa', 'BairroCasa', 'TelefoneCasa', 'CRM', 'Especializacao', 'NumeroCasa',
        'AbrirTelaNotaFinalizaDoc', 'NomeProfissional', 'CodigoFornecedor', 'CreditoDevolucaoTemp', 'VenderPagSeguro',
        'ComplementoCob', 'ComplementoEnt', 'Desconto', 'CartaoFidelidade', 'PrePgtoEspeciePgto',
        'PrePgtoEspeciePgtoTipo', 'DataCadastro', 'CodigoIndicou', 'CodigoCadastrou', 'pComissaoIndicou',
        'pComissaoCadastrou', 'PrePgtoEspeciePgtoCodigo', 'AtivarComoParticipante', 'CodigoIndicouCliente',
        'pComissaoIndicouCliente', 'CodigoCadastrouCliente', 'pComissaoCadastrouCliente', 'pCreditosParticipante',
        'TipoCadQuemIndicou', 'TipoCadQuemCadastrou', 'Regiao', 'DataUpdate', 'VenderDeposito', 'VenderTransferencia',
        'VenderFinanciamento', 'PermitirMovSoNoIntervaloData', 'PermitirMovSoNoIntervaloDataINI', 'PermitirMovSoNoIntervaloDataFI',
        'UltimaMovimentacao', 'emailcobranca', 'F_Profissao', 'J_RamoAtuacao', 'VenderPix', 'VenderValeRefeicao',
        'DescontoConceder', 'WA_SendAnoNiver', 'ClienteCalcularDIFAL', 'VenderBoleto', 'EnviarCRM', 'DescontoBoletoAteData',
        'DadosAddNFe', 'PFIE', 'DadosBancariosBancoNumero', 'DadosBancariosBanco', 'DadosBancariosAgencia',
        'DadosBancariosConta', 'DadosBancariosFavorecido', 'DadosBancariosPix', 'PrePgtoPriFixDay', 'PrePgtoSegFixDay',
        'PrePgtoTerFixDay', 'PrePgtoQuaFixDay', 'PrePgtoPriFixDay1', 'PrePgtoPriFixDay2', 'PrePgtoPriFixDay3',
        'PrePgtoPriFixDay4', 'PrePgtoSegFixDay1', 'PrePgtoSegFixDay2', 'PrePgtoSegFixDay3', 'PrePgtoSegFixDay4',
        'PrePgtoTerFixDay1', 'PrePgtoTerFixDay2', 'PrePgtoTerFixDay3', 'PrePgtoTerFixDay4', 'PrePgtoQuaFixDay1',
        'PrePgtoQuaFixDay2', 'PrePgtoQuaFixDay3', 'PrePgtoQuaFixDay4', 'ObsAdm', 'JanelaParaOBSemMovimentacoes',
        'Convenio', 'PrePgtoFixarDiaSemana', 'PrePgtoDiaSemana', 'PrePgtoDataUnica', 'WhatsAppNome', 'WhatsAppNumero'
    ];
}
