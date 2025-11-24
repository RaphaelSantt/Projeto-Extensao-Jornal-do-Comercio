<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KeyRedacaoService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY');
    }

    public function redigirMateria(array $dadosJulia, array $dadosPedro, string $empresa): string
    {
        try {
            $prompt = $this->montarPrompt($dadosJulia, $dadosPedro, $empresa);

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Content-Type' => 'application/json'
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'meta-llama/llama-3.1-70b-instruct',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Você é KEY, um jornalista profissional, estilo InfoMoney/Valor Econômico.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $prompt
                    ]
                ],
                'temperature' => 0.45,
                'max_tokens' => 1500
            ]);

            if (!$response->successful()) {
                return "Erro ao gerar conteúdo com Key (OpenRouter): " . $response->body();
            }

            $json = $response->json();

            return $json['choices'][0]['message']['content'] ?? "Erro: OpenRouter não retornou texto.";

        } catch (\Throwable $e) {
            return "Erro Key/OpenRouter: " . $e->getMessage();
        }
    }



    private function montarPrompt(array $julia, array $pedro, string $empresa): string
    {
        $noticiasJulia = $julia['resultados'] ?? [];
        $discussoesPedro = $pedro['discussoes'] ?? [];
        $sentimento = $pedro['sentimento_geral'] ?? "Indefinido";

        $blocoNoticias = "";
        foreach ($noticiasJulia as $n) {
            $blocoNoticias .= "- {$n['titulo']}: {$n['descricao']}\n";
        }

        $blocoDiscussoes = "";
        foreach ($discussoesPedro as $d) {
            $blocoDiscussoes .= "- {$d['topico']} → {$d['resumo']}\n";
        }

return "
Você é KEY, um jornalista sênior especializado em mercado financeiro, com estilo semelhante aos profissionais do InfoMoney, Valor Econômico e Exame.

REGRAS ABSOLUTAS
- Nunca mencione IA, algoritmos, buscas, modelos ou qualquer agente intermediário.
- Nunca mencione Júlia, Pedro ou Key como personagens.
- NÃO invente dados. Use somente as informações fornecidas abaixo.
- NÃO crie datas específicas; use apenas termos gerais como 'recentemente', 'no período recente', etc.
- Produza texto 100% jornalístico, impessoal, técnico e claro.

----------------------------------------------------------------------
Dados financeiros e notícias relevantes
(use APENAS isso como base factual)

{$blocoNoticias}

----------------------------------------------------------------------
Discussões do mercado e sentimento
Sentimento geral: {$sentimento}

{$blocoDiscussoes}

----------------------------------------------------------------------

ESTRUTURA OBRIGATÓRIA DA MATÉRIA

A matéria deve conter, obrigatoriamente,com pelo menos 6 linhas cada, os sessões abaixo:


Panorama Geral
- Uma introdução contextualizando a empresa {$empresa}.
- Breve resumo sobre o momento atual do mercado para essa companhia.

Indicadores Financeiros e Movimentações Recentes
- Interpretar as notícias financeiras listadas.
- Destacar indicadores, tendências, projeções, movimentos relevantes.
- Conectar fatos: variação da ação, dividendos, desempenho anual, fundamentos.

Sentimento do Mercado e Reações dos Investidores
- Explicar o que o sentimento geral indica.
- Conectar os tópicos discutidos pelo mercado.
- Mostrar equilíbrio jornalístico (pontos positivos x riscos/pressões).

Perspectivas e Pontos de Atenção
- Descrever possíveis caminhos futuros com cautela analítica.
- Destacar fatores que investidores estão observando.
- Nada de previsões certeiras — apenas análise responsável.

----------------------------------------------------------------------

ESTILO OBRIGATÓRIO
- Texto fluido, profissional e coeso.
- Subtítulos claros.
- Parágrafos curtos.
- Linguagem técnica, porém acessível.
- Tons equilibrados e analíticos, sem dramatização.
- Nada de bullet points no texto final — apenas em caso de resumos dentro da narrativa.

Agora, escreva a matéria completa seguindo TODAS as regras acima.
";

    }
}
