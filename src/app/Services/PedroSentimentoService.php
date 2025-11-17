<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PedroSentimentoService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('SERPER_API_KEY');
    }

    public function analisarMercado(string $empresa): array
    {
        try {

            // 🔍 1. Busca notícias relacionadas à opinião do mercado
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post('https://google.serper.dev/search', [
                'q' =>
                    "{$empresa} ações análises de mercado opinião analistas tendência projeções investidores hoje",
                'num' => 10
            ]);

            if (!$response->successful()) {
                return ['erro' => true, 'mensagem' => $response->body()];
            }

            $dados = $response->json();

            // Extrai até 6 notícias relevantes
            $noticias = collect($dados['organic'] ?? [])
                ->take(6)
                ->map(function ($n) {
                    return [
                        'titulo' => $n['title'] ?? '',
                        'descricao' => $n['snippet'] ?? '',
                        'fonte' => $n['source'] ?? '',
                        'link' => $n['link'] ?? ''
                    ];
                })
                ->toArray();

            // ---------------------------------------
            // 2️⃣ IDENTIFICAÇÃO DE TÓPICOS (Pedro de verdade)
            // ---------------------------------------
            $temas = [];
            foreach ($noticias as $n) {
                $texto = strtolower($n['titulo'] . ' ' . $n['descricao']);

                if (str_contains($texto, 'alta') || str_contains($texto, 'subiu') || str_contains($texto, 'ganho')) {
                    $temas[] = "expectativa de alta";
                }

                if (str_contains($texto, 'queda') || str_contains($texto, 'caiu') || str_contains($texto, 'baixa')) {
                    $temas[] = "pressão de baixa";
                }

                if (str_contains($texto, 'dividendo') || str_contains($texto, 'provento')) {
                    $temas[] = "foco em dividendos";
                }

                if (str_contains($texto, 'investigação') || str_contains($texto, 'risco') || str_contains($texto, 'problema')) {
                    $temas[] = "alertas ou riscos";
                }

                if (str_contains($texto, 'comprar') || str_contains($texto, 'recomendação')) {
                    $temas[] = "recomendações de compra";
                }
            }

            $temas = array_unique($temas);

            // ---------------------------------------
            // 3️⃣ SENTIMENTO DO MERCADO
            // ---------------------------------------
            $textoCompleto = strtolower(implode(" ", array_column($noticias, 'descricao')));

            $positivo =
                substr_count($textoCompleto, 'alta') +
                substr_count($textoCompleto, 'ganho') +
                substr_count($textoCompleto, 'subiu');

            $negativo =
                substr_count($textoCompleto, 'queda') +
                substr_count($textoCompleto, 'baixa') +
                substr_count($textoCompleto, 'caiu');

            $sentimentoGeral =
                $positivo > $negativo ? 'Positivo' :
                ($negativo > $positivo ? 'Negativo' : 'Neutro');

            // ---------------------------------------
            // 4️⃣ RESUMO consolidado
            // ---------------------------------------
            $resumo = "O mercado demonstra um sentimento **{$sentimentoGeral}** em relação a {$empresa}. 
            Os principais temas recorrentes entre mídias e analistas incluem: " . 
            (count($temas) ? implode(', ', $temas) : 'nenhum tema dominante detectado') . ".";

            return [
                'erro' => false,
                'empresa' => $empresa,
                'noticias' => $noticias,
                'temas' => $temas,
                'sentimento_geral' => $sentimentoGeral,
                'resumo' => $resumo,
                'discussoes' => collect($noticias)->map(function ($n) {
                    return [
                        'topico' => $n['titulo'],
                        'impacto' => 'neutro',
                        'resumo' => $n['descricao']
                    ];
                })->toArray()
            ];

        } catch (\Throwable $e) {
            return ['erro' => true, 'mensagem' => $e->getMessage()];
        }
    }
}
