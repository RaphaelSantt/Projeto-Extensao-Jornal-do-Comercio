<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KeyRedacaoService
{
    protected $geminiApiKey;

    public function __construct()
    {
        $this->geminiApiKey = env('AIzaSyCG0UqxHZQ7oTqFauGHmJaT39lhuHD_a6s');
    }

    public function redigirMateria(array $dadosJulia, array $dadosPedro, string $empresa): string
    {
        try {
            $prompt = $this->montarPrompt($dadosJulia, $dadosPedro, $empresa);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$this->geminiApiKey}"
,
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]
            );

            if (!$response->successful()) {
                return "Erro ao gerar conteúdo com Key (Gemini): " . $response->body();
            }

            $json = $response->json();

            return $json['candidates'][0]['content']['parts'][0]['text']
                ?? "Erro: Gemini não retornou texto.";

        } catch (\Throwable $e) {
            return "Erro Key: " . $e->getMessage();
        }
    }


    private function montarPrompt(array $julia, array $pedro, string $empresa): string
    {
        $noticiasJulia = $julia['resultados'] ?? [];
        $discussoesPedro = $pedro['discussoes'] ?? [];
        $sentimento = $pedro['sentimento_geral'] ?? "Indefinido";

        // Notícias da Júlia
        $blocoNoticias = "";
        foreach ($noticiasJulia as $n) {
            $blocoNoticias .= "- {$n['titulo']}: {$n['descricao']}\n";
        }

        // Discussões do Pedro
        $blocoDiscussoes = "";
        foreach ($discussoesPedro as $d) {
            $blocoDiscussoes .= "- {$d['topico']} → {$d['resumo']}\n";
        }

        return "
Você é KEY, jornalista profissional no estilo InfoMoney, Exame e Valor Econômico.

📌 Regra absoluta: NÃO mencione Júlia, Pedro, IA, algoritmos ou buscas.

Escreva como um jornalista humano.

Seu objetivo: criar uma matéria jornalística completa, fluida, informativa e bem estruturada sobre **{$empresa}**, usando APENAS as informações abaixo.

---

### Dados financeiros relevantes
{$blocoNoticias}

---

### Discussões atuais do mercado
Sentimento geral: {$sentimento}

{$blocoDiscussoes}

---

### Instruções de escrita
- Produza uma matéria com subtítulos jornalísticos.
- Evite sensacionalismo.
- Não invente dados.
- Não use datas precisas que não estão no texto.
- Foque em clareza, contexto e análise.
- Não mencione que o texto foi gerado artificialmente.

Agora produza a matéria completa.
";
    }
}
