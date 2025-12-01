<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresasSeeder extends Seeder
{
    public function run(): void
    {
        $empresas = [
            // Brasil (B3) - As mais negociadas e conhecidas
            ['codigo' => 'PETR4', 'nome' => 'Petróleo Brasileiro S.A. - Petrobras', 'setor' => 'Petróleo e Gás'],
            ['codigo' => 'VALE3', 'nome' => 'Vale S.A.', 'setor' => 'Mineração'],
            ['codigo' => 'ITUB4', 'nome' => 'Itaú Unibanco Holding S.A.', 'setor' => 'Bancos'],
            ['codigo' => 'BBDC4', 'nome' => 'Banco Bradesco S.A.', 'setor' => 'Bancos'],
            ['codigo' => 'ABEV3', 'nome' => 'Ambev S.A.', 'setor' => 'Bebidas'],
            ['codigo' => 'B3SA3', 'nome' => 'B3 - Brasil, Bolsa, Balcão', 'setor' => 'Serviços Financeiros'],
            ['codigo' => 'BBAS3', 'nome' => 'Banco do Brasil S.A.', 'setor' => 'Bancos'],
            ['codigo' => 'ELET3', 'nome' => 'Eletrobras', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'RENT3', 'nome' => 'Localiza Rent a Car S.A.', 'setor' => 'Locação de Veículos'],
            ['codigo' => 'WEGE3', 'nome' => 'WEG S.A.', 'setor' => 'Maquinário Industrial'],
            ['codigo' => 'GGBR4', 'nome' => 'Gerdau S.A.', 'setor' => 'Siderurgia'],
            ['codigo' => 'CSNA3', 'nome' => 'Companhia Siderúrgica Nacional', 'setor' => 'Siderurgia'],
            ['codigo' => 'SUZB3', 'nome' => 'Suzano S.A.', 'setor' => 'Papel e Celulose'],
            ['codigo' => 'KLBN11', 'nome' => 'Klabin S.A.', 'setor' => 'Papel e Celulose'],
            ['codigo' => 'EQTL3', 'nome' => 'Equatorial Energia S.A.', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'CPFE3', 'nome' => 'CPFL Energia S.A.', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'RAIL3', 'nome' => 'Rumo S.A.', 'setor' => 'Logística'],
            ['codigo' => 'VBBR3', 'nome' => 'Vibra Energia S.A.', 'setor' => 'Distribuição de Combustíveis'],
            ['codigo' => 'HAPV3', 'nome' => 'Hapvida Participações e Investimentos', 'setor' => 'Saúde'],
            ['codigo' => 'RDOR3', 'nome' => 'Rede D’Or São Luiz S.A.', 'setor' => 'Saúde'],
            ['codigo' => 'MGLU3', 'nome' => 'Magazine Luiza S.A.', 'setor' => 'Varejo'],
            ['codigo' => 'LREN3', 'nome' => 'Lojas Renner S.A.', 'setor' => 'Varejo'],
            ['codigo' => 'AMER3', 'nome' => 'Americanas S.A.', 'setor' => 'Varejo'],
            ['codigo' => 'PRIO3', 'nome' => 'PetroRio S.A.', 'setor' => 'Petróleo e Gás'],
            ['codigo' => 'CMIG4', 'nome' => 'CEMIG', 'setor' => 'Energia Elétrica'],

            // Gigantes globais (EUA + outras)
            ['codigo' => 'AAPL', 'nome' => 'Apple Inc.', 'setor' => 'Tecnologia'],
            ['codigo' => 'MSFT', 'nome' => 'Microsoft Corporation', 'setor' => 'Tecnologia'],
            ['codigo' => 'GOOGL', 'nome' => 'Alphabet Inc. (Google)', 'setor' => 'Tecnologia'],
            ['codigo' => 'AMZN', 'nome' => 'Amazon.com Inc.', 'setor' => 'Comércio Eletrônico'],
            ['codigo' => 'NVDA', 'nome' => 'NVIDIA Corporation', 'setor' => 'Semicondutores'],
            ['codigo' => 'META', 'nome' => 'Meta Platforms, Inc. (Facebook)', 'setor' => 'Tecnologia'],
            ['codigo' => 'TSLA', 'nome' => 'Tesla, Inc.', 'setor' => 'Automóveis'],
            ['codigo' => 'BRK.B', 'nome' => 'Berkshire Hathaway Inc.', 'setor' => 'Conglomerado'],
            ['codigo' => 'JPM', 'nome' => 'JPMorgan Chase & Co.', 'setor' => 'Bancos'],
            ['codigo' => 'JNJ', 'nome' => 'Johnson & Johnson', 'setor' => 'Saúde'],
            ['codigo' => 'V', 'nome' => 'Visa Inc.', 'setor' => 'Pagamentos'],
            ['codigo' => 'PG', 'nome' => 'Procter & Gamble Co.', 'setor' => 'Bens de Consumo'],
            ['codigo' => 'MA', 'nome' => 'Mastercard Incorporated', 'setor' => 'Pagamentos'],
            ['codigo' => 'UNH', 'nome' => 'UnitedHealth Group', 'setor' => 'Saúde'],
            ['codigo' => 'HD', 'nome' => 'Home Depot Inc.', 'setor' => 'Varejo'],
            ['codigo' => 'DIS', 'nome' => 'The Walt Disney Company', 'setor' => 'Entretenimento'],
            ['codigo' => 'NFLX', 'nome' => 'Netflix, Inc.', 'setor' => 'Streaming'],
            ['codigo' => 'ADBE', 'nome' => 'Adobe Inc.', 'setor' => 'Software'],
            ['codigo' => 'PYPL', 'nome' => 'PayPal Holdings, Inc.', 'setor' => 'Pagamentos'],
            ['codigo' => 'INTC', 'nome' => 'Intel Corporation', 'setor' => 'Semicondutores'],
            ['codigo' => 'CSCO', 'nome' => 'Cisco Systems, Inc.', 'setor' => 'Redes'],
            ['codigo' => 'KO', 'nome' => 'The Coca-Cola Company', 'setor' => 'Bebidas'],
            ['codigo' => 'PEP', 'nome' => 'PepsiCo, Inc.', 'setor' => 'Bebidas'],
            ['codigo' => 'PFE', 'nome' => 'Pfizer Inc.', 'setor' => 'Farmacêutica'],
            ['codigo' => 'ABBV', 'nome' => 'AbbVie Inc.', 'setor' => 'Farmacêutica'],
            ['codigo' => 'MRK', 'nome' => 'Merck & Co., Inc.', 'setor' => 'Farmacêutica'],
            ['codigo' => 'TMUS', 'nome' => 'T-Mobile US, Inc.', 'setor' => 'Telecomunicações'],
            ['codigo' => 'VZ', 'nome' => 'Verizon Communications', 'setor' => 'Telecomunicações'],
            ['codigo' => 'CMCSA', 'nome' => 'Comcast Corporation', 'setor' => 'Mídia'],
            ['codigo' => 'XOM', 'nome' => 'Exxon Mobil Corporation', 'setor' => 'Petróleo e Gás'],
            ['codigo' => 'CVX', 'nome' => 'Chevron Corporation', 'setor' => 'Petróleo e Gás'],
            ['codigo' => 'WMT', 'nome' => 'Walmart Inc.', 'setor' => 'Varejo'],
            ['codigo' => 'COST', 'nome' => 'Costco Wholesale Corporation', 'setor' => 'Varejo'],
            ['codigo' => 'MCD', 'nome' => 'McDonald’s Corporation', 'setor' => 'Restaurantes'],
            ['codigo' => 'SBUX', 'nome' => 'Starbucks Corporation', 'setor' => 'Cafés'],
            ['codigo' => 'NKE', 'nome' => 'NIKE, Inc.', 'setor' => 'Vestuário'],
            ['codigo' => 'AMD', 'nome' => 'Advanced Micro Devices', 'setor' => 'Semicondutores'],
            ['codigo' => 'ORCL', 'nome' => 'Oracle Corporation', 'setor' => 'Software'],
            ['codigo' => 'ACN', 'nome' => 'Accenture plc', 'setor' => 'Consultoria'],
            ['codigo' => 'IBM', 'nome' => 'International Business Machines', 'setor' => 'Tecnologia'],
            ['codigo' => 'QCOM', 'nome' => 'Qualcomm Incorporated', 'setor' => 'Semicondutores'],

            // Mais empresas brasileiras populares
            ['codigo' => 'ITSA4', 'nome' => 'Itaúsa S.A.', 'setor' => 'Holding'],
            ['codigo' => 'SANB11', 'nome' => 'Banco Santander (Brasil)', 'setor' => 'Bancos'],
            ['codigo' => 'CSAN3', 'nome' => 'Cosan S.A.', 'setor' => 'Energia e Logística'],
            ['codigo' => 'EMBR3', 'nome' => 'Embraer S.A.', 'setor' => 'Aeronáutica'],
            ['codigo' => 'AZUL4', 'nome' => 'Azul S.A.', 'setor' => 'Aviação'],
            ['codigo' => 'GOLL4', 'nome' => 'Gol Linhas Aéreas', 'setor' => 'Aviação'],
            ['codigo' => 'TOTS3', 'nome' => 'Totvs S.A.', 'setor' => 'Tecnologia'],
            ['codigo' => 'FLRY3', 'nome' => 'Fleury S.A.', 'setor' => 'Saúde'],
            ['codigo' => 'RADL3', 'nome' => 'Raia Drogasil S.A.', 'setor' => 'Farmácias'],
            ['codigo' => 'BEEF3', 'nome' => 'Minerva Foods', 'setor' => 'Alimentos'],
            ['codigo' => 'BRFS3', 'nome' => 'BRF S.A.', 'setor' => 'Alimentos'],
            ['codigo' => 'JBSS3', 'nome' => 'JBS S.A.', 'setor' => 'Alimentos'],
            ['codigo' => 'MRFG3', 'nome' => 'Marfrig Global Foods', 'setor' => 'Alimentos'],
            ['codigo' => 'NTCO3', 'nome' => 'Natura &Co', 'setor' => 'Cosméticos'],
            ['codigo' => 'VIVA3', 'nome' => 'Vivara S.A.', 'setor' => 'Joalheria'],
            ['codigo' => 'PCAR3', 'nome' => 'Grupo Pão de Açúcar', 'setor' => 'Varejo Alimentício'],
            ['codigo' => 'CRFB3', 'nome' => 'Carrefour Brasil', 'setor' => 'Varejo Alimentício'],
            ['codigo' => 'ASAI3', 'nome' => 'Sendas Distribuidora (Assaí)', 'setor' => 'Atacarejo'],
            ['codigo' => 'LWSA3', 'nome' => 'Locaweb', 'setor' => 'Tecnologia'],
            ['codigo' => 'CASH3', 'nome' => 'Méliuz', 'setor' => 'Cashback'],
            ['codigo' => 'ENEV3', 'nome' => 'Eneva S.A.', 'setor' => 'Energia'],
            ['codigo' => 'TAEE11', 'nome' => 'Taesa', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'BBSE3', 'nome' => 'BB Seguridade', 'setor' => 'Seguros'],
            ['codigo' => 'EGIE3', 'nome' => 'Engie Brasil', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'CPLE6', 'nome' => 'Copel', 'setor' => 'Energia Elétrica'],
            ['codigo' => 'TRPL4', 'nome' => 'Transmissora Aliança de Energia', 'setor' => 'Transmissão de Energia'],
        ];

        foreach ($empresas as $empresa) {
            Empresa::updateOrCreate(
                ['codigo' => $empresa['codigo']],
                [
                    'nome'  => $empresa['nome'],
                    'setor' => $empresa['setor'],
                ]
            );
        }
    }
}