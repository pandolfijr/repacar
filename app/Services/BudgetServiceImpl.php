<?php

namespace App\Services;

use App\Helpers\ErrorApplication;
use App\Helpers\Result;
use App\Interfaces\Repository\ClientRepository;
use App\Interfaces\Repository\BudgetRepository;
use App\Interfaces\Repository\CompanyDataRepository;
use App\Interfaces\Service\BudgetService;
use App\Models\Budget;
use App\Models\CompanyData;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BudgetServiceImpl implements BudgetService
{
    private $budgetRepository;
    private $clientRepository;
    private $companyDataRepository;

    public function __construct(
        BudgetRepository $budgetRepository,
        ClientRepository $clientRepository,
        CompanyDataRepository $companyDataRepository
    ) {
        $this->budgetRepository = $budgetRepository;
        $this->clientRepository = $clientRepository;
        $this->companyDataRepository = $companyDataRepository;
    }
    public function saveBudget(array $input): Result
    {
        return DB::transaction(function () use ($input) {
            $result_company_data = $this->companyDataRepository->getCompanyData();
            if (!$result_company_data->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> getCompanyData',
                        $result_company_data->getError()->getMessage(),
                        400,
                    )
                );
            }

            $company_data = $result_company_data->getData()['company'];

            if(isset($input['client']['Cod']) && !empty($input['client']['Cod'])) {
                $id_client = $input['client']['Cod'];
            } else {
                $array_client = [
                    'CodEFO' => $company_data['CodEFO'],
                    'TipoCadastro' => 'Cliente',
                    'Indice' => 0,
                    'Entrada' => Carbon::now()->format('Y-m-d H:i:s'),
                    'Credito' => 0,
                    'ImprimirEtiqueta' => 0,
                    'desativado' => 0,
                    'tabelapreco' => 0,
                    'grupo' => 'Freedom.Clientes',
                    'Comissao' => 0,
                    'VSAV' => 0,
                    'usarlegenda' => 0,
                    'ClienteIsentoICMS' => 0,
                    'BloquearVenda' => 0,
                    'estrelas' => 0,
                    'ClienteProtestado' => 0,
                    'NaoContribuinteICMS' => 0,
                    'VenderDinheiro' => 0,
                    'VenderCartao' => 0,
                    'VenderCheque' => 0,
                    'AutorizarLogar' => 0,
                    'FreteCliente' => 0,
                    'VenderPagSeguro' => 0,
                    'Desconto' => 0,
                    'pComissaoIndicou' => 0,
                    'pComissaoCadastrou' => 0,
                    'AtivarComoParticipante' => 0,
                    'pComissaoIndicouCliente' => 0,
                    'pComissaoCadastrouCliente' => 0,
                    'VenderDeposito' => 0,
                    'VenderTransferencia' => 0,
                    'VenderFinanciamento' => 0,
                    'PermitirMovSoNoIntervaloData' => 0,
                    'VenderPix' => 0,
                    'VenderValeRefeicao' => 0,
                    'DescontoConceder' => 0,
                    'ClienteCalcularDIFAL' => 0,
                    'VenderBoleto' => 0,
                    'EnviarCRM' => 0,
                    'DescontoBoletoAteData' => 0,
                    'JanelaParaOBSemMovimentacoes' => 0,
                    'PrePgtoFixarDiaSemana' => 0,
                    'Data_Sync' => Carbon::now()->format('Y-m-d H:i:s'),
                ];

                $final_array = array_merge($input['client'], $array_client);
                $result = $this->clientRepository->saveClient($final_array);
                if (!$result->isSuccess()) {
                    return Result::error(
                        new ErrorApplication(
                            'BudgetServiceImpl > saveBudget -> saveClient',
                            $result->getError()->getMessage(),
                            400,
                        )
                    );
                }
                $id_client = $result->getData()['client'];
            }

            $result_last_cod = $this->budgetRepository->getLastCodDetailedBudget();
            if (!$result_last_cod->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> getLastCodDetailedBudget',
                        $result_last_cod->getError()->getMessage(),
                        400,
                    )
                );
            }
            $last_cod = $result_last_cod->getData()['last_cod'];

            $result_company_data = $this->companyDataRepository->getCompanyData();
            if (!$result_company_data->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> getCompanyData',
                        $result_company_data->getError()->getMessage(),
                        400,
                    )
                );
            }

            $company_data = $result_company_data->getData()['company'];
            $id_budget = $company_data['CodEFO'] . '.' . CompanyData::SITECODE . '.' . $last_cod + 1;

            $result_budget = $this->createArrayAndInsertBudget($last_cod,  $input['cart'], $company_data, $id_client, $id_budget);
            if (!$result_budget->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> createArrayAndInsertBudget',
                        $result_budget->getError()->getMessage(),
                        400,
                    )
                );
            }


            $result_products_budget = $this->budgetRepository->getProductsByIdBudget($id_budget);
            if (!$result_products_budget->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> getProductsByIdBudget',
                        $result_products_budget->getError()->getMessage(),
                        400,
                    )
                );
            }
            $products_budget = $result_products_budget->getData()['products'];


            $result_budget_det = $this->createArrayAndInsertBudgetDet($company_data, $id_client, $id_budget, $products_budget, $input, $last_cod);
            if (!$result_budget_det->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> createArrayAndInsertBudgetDet',
                        $result_budget_det->getError()->getMessage(),
                        400,
                    )
                );
            }

            return Result::success();
        });
    }

    private function createArrayAndInsertBudget(string $last_cod, array $cart, CompanyData $company_data, string $id_client, string $id_budget): Result
    {
        try {
            $counter = 1;


            foreach ($cart as $product) {
                $array = [
                    'Pedido' => $id_budget,
                    'CodEFO' => $company_data['CodEFO'],
                    'Data' => Carbon::now()->format('Y-m-d H:i:s'),
                    'Cliente' => $id_client,
                    'Vendedor' => CompanyData::SITECODE,
                    'modo' => 'Orçamento.Site',
                    'OrigemAplicativo' => 'Site',
                    'ST' => 1,
                    'vBCST' => 0,
                    'VBCISS' => 0,
                    'vBCIPI' => 0,
                    'vBCPIS' => 0,
                    'vBCCOFINS' => 0,
                    'vBCSTRet' => 0,
                    'vICMSST' => 0,
                    'vISS' => 0,
                    'vPIS' => 0,
                    'vCOFINS' => 0,
                    'vICMSSTRet' => 0,
                    'vCredICMSSN' => 0,
                    'vSEGURO' => 0,
                    'vDesconto' => 0,
                    'vOutras' => 0,
                    'nItem' => $counter,
                    'TipoMov' => 'Movimentação',
                    'GF' => 0,
                    'AC' => 0,
                    'AF' => 0,
                    'NC' => 0,
                    'ES' => 'Nenhum',
                    'Quan' => $product['quantity'],
                    'ncm' => $product['NCM'],
                    'Origem' => $product['origem'],
                    'Unidade' => $product['unidade'],
                    'codigo' => $product['stock']['codigo'],
                    'Compra' => $product['stock']['NovoCusto'] ?? 0,
                    'Venda' => $product['stock']['Venda'] ?? 0,
                    'CSTICMS' => $product['stock']['CSTICMS'],
                    'CSTPis' => $product['stock']['CSTPis'],
                    'CSTCofins' => $product['stock']['CSTCofins'],
                    'pPIS' => $product['stock']['pPIS'],
                    'CSTIpi' => $product['stock']['CSTIpi'],
                    'pCredSN' => $product['stock']['pCredSN'],
                    'modBC' => $product['stock']['modBC'],
                    'modBCST' => $product['stock']['modBCST'],
                    'pRedBCST' => $product['stock']['pRedBCST'],
                    'pISS' => $product['stock']['pISS'],
                    'pICMSST' => $product['stock']['pICMSST'],
                    'ISS' => $product['stock']['ISS'],
                    'IcmsManual' => $product['stock']['IcmsManual'],
                    'pLeiTransparencia' => $product['stock']['pLeiTransparencia'],
                    'QuantidadeEmEstoque' => $product['stock']['Quantidade'],
                    'Desc1' => 0,
                    'Comissao' => 0,
                    'pIPI' => $product['stock']['pIPI'],
                    'pICMS' => $product['stock']['pICMS'],
                    'VendaMinima' => $product['stock']['VendaMinima'],
                    'pMVAST' => $product['stock']['pMVAST'],
                    'pRedBC' => $product['stock']['pRedBC'],
                    'pCofins' => $product['stock']['pCofins'],
                    'NaoSomar' => 0,
                    'ValorLocacao' => $product['stock']['ValorLocacao'],
                    'vAcrescRAT' => 0,
                    'vDescsRAT' => 0,
                    'vComissao' => 0,
                    'ProdPromo' => $product['stock']['ProdutoPromocao'],
                    'NaoImpRomaneio' => 0,
                    'VendaOriginalEstoque' => $product['stock']['Venda'],
                    'TabelaVenda' => 0,
                    'vLargura' => $product['stock']['Largura'],
                    'vComprimento' => $product['stock']['Comprimento'],
                    'vAltura' => $product['stock']['Altura'],
                    'vTotalServico' => 0,
                    'TipoComissao' => 'opUComiPV',
                    'Exp_iQtdRetE' => 1,
                    'vCustosOperacionaisRAT' => 0,
                    'ProdutoPorEncomenda' => $product['stock']['ProdutoPorEncomenda'],
                    'ProdutoMontado' => $product['stock']['ProdutoMontado'],
                    'Embalagem' => $product['Embalagem'] ?? 0,
                    'TabelaVendaNome' => 'Padrão',
                    'UnidadeTrib' => $product['UnidadeTrib'] ?? 'UN',
                    'vDescUnitRAT' => 0
                ];

                $result_budget = $this->budgetRepository->saveBudget($array);
                if (!$result_budget->isSuccess()) {
                    return Result::error(
                        new ErrorApplication(
                            'BudgetServiceImpl > saveBudget -> createArrayAndInsert',
                            $result_budget->getError()->getMessage(),
                            400,
                        )
                    );
                }
                $counter++;
            }
            return Result::success();
        } catch (Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetServiceImpl > createArrayAndInsert',
                    'Erro ao gerar orçamento:' . $e->getMessage(),
                    500,
                )
            );
        }
    }

    private function createArrayAndInsertBudgetDet(CompanyData $company_data, string $id_client, string $id_budget, Collection $products_budget, array $input, string $last_cod): Result
    {
        try {
            $result_client = $this->clientRepository->getClientByCod($id_client);
            if (!$result_client->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> createArrayAndInsertBudgetDet -> getClientByCod',
                        $result_client->getError()->getMessage(),
                        400,
                    )
                );
            }
            $client = $result_client->getData()['client'];

            $array = [
                'Data' => Carbon::now()->format('Y-m-d H:i:s'),
                'Pedido' => $id_budget,
                'Cliente' => $id_client,
                'Vendedor' => CompanyData::SITECODE,
                'Modo' => 'Orçamento.Site',
                'Frete' => 0,
                'DescTotal' =>  0,
                'Total' => $products_budget->sum('Venda'),
                'OBS' => $input['client']['observation'] ?? '',
                'Transportadora' => 0,
                'Hora' => Carbon::now()->format('H:i:s'),
                'ValorSeguro' => 0,
                'OutrasDespesas' => 0,
                'vTotProd' => $products_budget->sum('Venda'),
                'FretePC' => 0,
                'VtotServ' => 0,
                'vBCST' => 0,
                'VBCISS' => 0,
                'vBCIPI' => 0,
                'vBCPIS' => 0,
                'vBCCOFINS' => 0,
                'vICMSST' => 0,
                'vISS' => 0,
                'vPIS' => 0,
                'vCOFINS' => 0,
                'CodEFO' => $company_data['CodEFO'],
                'vTotCusto' => $products_budget->sum('Compra'),
                'GF' => 0,
                'AC' => 0,
                'AF' => 0,
                'NC' => 0,
                'ES' => 'Nenhum',
                'SerieNfe' => $company_data['NFSerie'],
                'PedidoSeq' => $last_cod + 2,
                'FeitoPeloFreedom' => 0,
                'LegendaModo' => 'Orçamento.Site',
                'ConfirmaPGTO' => 0,
                'OrigemAplicativo' => 'Site',
                'PreencherFretePadrao' => 1,
                'EnderecoPadraoUnidade' => 'Padrão',
                'EnderecoPadraoTipo' =>  'Padrão',
                'EnderecoPadraoCep' => $client['Cep'],
                'EnderecoPadraoEndereco' => $client['endereco'],
                'EnderecoPadraoNumero' => $client['numero'],
                'EnderecoPadraoComplemento' => $client['complemento'],
                'EnderecoPadraoBairro' => $client['bairro'],
                'EnderecoPadraoEstado' => $client['Estado'],
                'EnderecoPadraoCidade' => $client['cidade'],
                'EnderecoPadraoTelefone' => $client['telefone'],
                'EnderecoPadraoEmail' => $client['email'],
                'TipoMov' => "Movimentação",
                'ComportarComoOrcamento' => "1",
                'DataCriacao' => Carbon::now()->format('Y-m-d H:i:s'),
                'st' => 1,
                'TipoPgto' => 'SF',
                'TipoJuros' => 'Não selecionou juros',
                'DescPercentual' => 0,
                'ConfirmadoNoCaixa' => 1,
                'ImpCircular' => 0,
                'DescontoTotalNosItens' => 0,
                'EnderecoEntregaTipo' => 'Padrão',
                'EnderecoCobrancaTipo' => 'Padrão',
                'vDescTotalEspeciePgto' => 0,
                'ComportarComoDevolucao' => 0,
                'CustosOperacionais' => 0,
                'ComportarComoConsignado' => 0,


            ];
            $result_budget_det = $this->budgetRepository->saveBudgetDet($array);
            if (!$result_budget_det->isSuccess()) {
                return Result::error(
                    new ErrorApplication(
                        'BudgetServiceImpl > saveBudget -> saveBudgetDet',
                        $result_budget_det->getError()->getMessage(),
                        400,
                    )
                );
            }

            return Result::success();
        } catch (Exception $e) {
            return Result::error(
                new ErrorApplication(
                    'BudgetServiceImpl > createArrayAndInsert',
                    'Erro ao criar orçamento detalhado:' . $e->getMessage(),
                    500,
                )
            );
        }
    }
}
