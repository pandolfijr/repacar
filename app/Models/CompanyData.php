<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyData extends Model
{
    use HasFactory;

    protected $table = 'tbdados';
    protected $primaryKey = 'Cod';
    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'Data', 'empresa', 'endereco', 'Cidade', 'Estado', 'Bairro', 'CGC', 'inscr', 'telefone', 'Cep', 'Ramo', 'HomePage', 'Email',
        'Numero', 'Contato', 'Fax', 'NFSerie', 'razao', 'im', 'cnae', 'EmailContador', 'edicao', 'nomecontador', 'CodEFO', 'tipoempresa',
        'IdNFSe', 'IdCartaCorrecaoE', 'obs', 'OBSaaaaaa', 'OBSbbbbbb', 'RegEspTributacao', 'dadosbancarios', 'DadosComerciais',
        'UsarFood', 'UsarPDV', 'UsarAGas', 'ExibirCob', 'diavence', 'FTP', 'SenhaFtp', 'UserFtp', 'LinkDownload', 'ServidorIMG',
        'PastaFtpIMG', 'IDNFe', 'IDCCe', 'SenhaSAT', 'SAT_SingAC', 'DataPegouPermissao', 'BloqueoPorTempoExcedido', 'EdicaoCor',
        'paDesktop', 'paWEB', 'paMobile', 'paNFE', 'paNFSE', 'paAtualizacoes', 'paConsultarCEPOnline', 'paConsultarCNPJOnline',
        'paMapas', 'paProducao', 'paEmissaoCupomFiscal', 'paEmissaoBoletos', 'paEmissaoEtiquetas', 'paFinanceiro', 'paRelatorioPersonalizados',
        'CobNasPermissoes', 'paNFCE', 'paNFSAT', 'UsarPizza', 'CnpjToScript', 'CodigoSegurancaNFCe', 'Cod', 'Manu', 'BCloud',
        'BHosting', 'BMobileServer3', 'paSMSFechaCXDia', 'opinaReceberSMSFCX', 'FormMovUse', 'IDManifesto', 'IDSpedFiscal', 'IDSpedPisConfins',
        'nomeUnidade', 'MsgBoasVindas', 'appIdML', 'secretKeyML', 'redirectURIML', 'paEDE', 'CodEmpresaGeral', 'TokenBrunelli',
        'ChaveLojaTrayCommerce', 'LinkAPITrayCommerce', 'TrayCommerce', 'Celular', 'paEnvioXMLContabilidade', 'ec_ChaveLoja', 'ec_LinkAPI',
        'ec_NumeroLoja', 'ec_Loja', 'paEcommerce', 'UsarOtica', 'paAgenda', 'paCRM'
    ];

    const SITECODE = 88;
}
