<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Analise;
use Illuminate\Http\Request;
use App\Services\JuliaFinanceService;
use App\Services\PedroSentimentoService;
use App\Services\KeyRedacaoService;

class AnaliseController extends Controller
{
    public function dashboard()
    {
        $empresas = Empresa::orderBy('nome')->get();
        $analises = Analise::with('empresa')->latest()->limit(50)->get();
        return view('dashboard', compact('empresas', 'analises'));
    }

  public function gerar(Request $request)
{
    $request->validate(['empresa_id' => 'required|exists:empresas,id']);

    $empresa = Empresa::findOrFail($request->empresa_id);

    // Júlia
    $julia = new JuliaFinanceService();
    $dados = $julia->obterDadosFinanceiros($empresa->codigo);

    // Pedro
    $pedro = new PedroSentimentoService();
    $sentimentoMercado = $pedro->analisarMercado($empresa->nome);
    \Log::info('RETORNO_PEDRO', $sentimentoMercado);

    $key = new KeyRedacaoService();

    $conteudo = $key->redigirMateria(
    dadosJulia: $dados,
    dadosPedro: $sentimentoMercado,
    empresa: $empresa->nome
);



    // Conteúdo inicial

    $analise = Analise::create([
        'empresa_id' => $empresa->id,
        'dados_financeiros' => $dados,
        'sentimento_mercado' => $sentimentoMercado['sentimento_geral'] ?? 'Indefinido',
        'discussoes' => $sentimentoMercado['discussoes'] ?? [],
        'conteudo_gerado' => $conteudo,
        'aprovado' => false
    ]);

    return redirect()->route('revisao', $analise->id);
}



    public function revisao($id)
    {
        $analise = Analise::with('empresa')->findOrFail($id);

        // garantir que dados sejam array
        if (is_string($analise->dados_financeiros)) {
            $analise->dados_financeiros = json_decode($analise->dados_financeiros, true) ?? [];
        }

        return view('revisao', compact('analise'));
    }

    public function aprovar(Request $request, $id)
    {
        $analise = Analise::findOrFail($id);

        if ($request->has('conteudo')) {
            $analise->conteudo_gerado = $request->input('conteudo');
        }

        $analise->aprovado = true;
        $analise->save();

        return redirect()->route('dashboard')->with('sucesso', 'Matéria aprovada e publicada.');
    }
}
