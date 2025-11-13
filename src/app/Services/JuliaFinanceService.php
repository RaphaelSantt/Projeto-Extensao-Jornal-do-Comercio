<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post('https://google.serper.dev/search', [
                'q' => "resumo detalhado e notícias recentes sobre a empresa {$empresa} incluindo desempenho financeiro, resultados, ações e investimentos site:infomoney.com.br OR site:valor.globo.com OR site:exame.com"


            ]);

            if (!$response->successful()) {
                return ['erro' => true, 'mensagem' => $response->body()];
            }

            $data = $response->json();

            // Podemos filtrar as primeiras 3 fontes relevantes
            $resultados = collect($data['organic'] ?? [])->take(3)->map(function ($item) {
                return [
                    'titulo' => $item['title'] ?? '',
                    'fonte' => $item['source'] ?? '',
                    'link' => $item['link'] ?? '',
                    'descricao' => $item['snippet'] ?? ''
                ];
            });

            return [
                'erro' => false,
                'empresa' => $empresa,
                'resultados' => $resultados
            ];

        } catch (\Throwable $e) {
    Log::error("Erro na JuliaFinanceService: " . $e->getMessage());
    return [
        'erro' => true,
        'mensagem' => 'Falha ao coletar dados da empresa. Detalhes registrados no log.'
    ];
}
    }
}
