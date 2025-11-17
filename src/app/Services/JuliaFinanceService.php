<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JuliaFinanceService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('SERPER_API_KEY');
    }

    public function obterDadosFinanceiros(string $empresa): array
    {
        try {

            // 🔹 1 — CONSULTAS NOTICIAS (máximo 4)
            $consultasNoticias = [
                "{$empresa} últimas notícias empresa ações economia site:infomoney.com.br",
                "{$empresa} desempenho ações análise empresa site:valor.globo.com",
                "{$empresa} empresa ações mercado financeiro site:exame.com",
            ];

            $noticias = [];

            foreach ($consultasNoticias as $query) {
                $response = Http::withHeaders([
                    'X-API-KEY' => $this->apiKey,
                    'Content-Type' => 'application/json'
                ])->post('https://google.serper.dev/search', [
                    'q'  => $query,
                    'num' => 5
                ]);

                if (!$response->successful()) {
                    continue;
                }

                $data = $response->json();

                foreach ($data['organic'] ?? [] as $item) {
                    $noticias[] = [
                        'titulo'    => $item['title'] ?? '',
                        'fonte'     => $item['source'] ?? '',
                        'link'      => $item['link'] ?? '',
                        'descricao' => $item['snippet'] ?? ''
                    ];
                }
            }

            // 🔄 Remove duplicatas
            $noticias = collect($noticias)
                ->unique('link')
                ->take(4)
                ->values()
                ->toArray();


            // 🔹 2 — CONSULTA TÉCNICA (apenas 1 fonte)
            $consultaTecnica = "{$empresa} empresa análise técnica indicadores balanço fundamentalista site:investing.com";

            $resTecnico = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post('https://google.serper.dev/search', [
                'q'  => $consultaTecnica,
                'num' => 1
            ]);

            $fonteTecnica = null;

            if ($resTecnico->successful()) {
                $tdata = $resTecnico->json();
                $t = $tdata['organic'][0] ?? null;

                if ($t) {
                    $fonteTecnica = [
                        'titulo'    => $t['title'] ?? '',
                        'fonte'     => $t['source'] ?? '',
                        'link'      => $t['link'] ?? '',
                        'descricao' => $t['snippet'] ?? ''
                    ];
                }
            }


            // 🔹 3 — MINI RESUMO AUTOMÁTICO POR NOTÍCIA
            foreach ($noticias as $i => $n) {
                $noticias[$i]['resumo_julia'] = $this->miniResumo($n['descricao']);
            }


            return [
                'erro'       => false,
                'empresa'    => $empresa,
                'resultados' => $noticias,
                'tecnico'    => $fonteTecnica
            ];

        } catch (\Throwable $e) {
            return [
                'erro'     => true,
                'mensagem' => $e->getMessage()
            ];
        }
    }

    // 🔹 MINI RESUMO SIMPLES — sem IA, rápido e eficiente
    private function miniResumo(string $texto): string
    {
        if (strlen($texto) <= 120) {
            return $texto;
        }

        return substr($texto, 0, 140) . "...";
    }
}
