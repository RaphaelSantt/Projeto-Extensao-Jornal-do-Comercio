<?php
namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Analise;
use Illuminate\Http\Request;
use App\Services\JuliaFinanceService;


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

    // 📊 Aciona a Júlia
    $julia = new JuliaFinanceService();
    $dados = $julia->obterDadosFinanceiros($empresa->codigo);

    // ⚙️ Mantém o restante igual
    $sentimento = "Análises de mídia ainda não integradas.";
    $conteudo = "Com base nos dados coletados por Júlia, a empresa {$empresa->nome} apresenta indicadores financeiros que merecem acompanhamento. " .
            "A análise detalhada será complementada pelas percepções de mercado de Pedro e pela redação jornalística de Key.";

$analise = Analise::create([
    'empresa_id' => $empresa->id,
    'dados_financeiros' => json_encode($dados['resultados'], JSON_UNESCAPED_UNICODE),
    'sentimento_mercado' => $sentimento,
    'conteudo_gerado' => $conteudo,
    'aprovado' => false
]);

    return redirect()->route('revisao', $analise->id);
}




    public function revisao($id)
    {
        $analise = Analise::with('empresa')->findOrFail($id);
        return view('revisao', compact('analise'));
    }

    public function aprovar(Request $request, $id)
    {
        $analise = Analise::findOrFail($id);
        // opcional: atualizar o conteudo com edição do revisor
        if ($request->has('conteudo')) {
            $analise->conteudo_gerado = $request->input('conteudo');
        }
        $analise->aprovado = true;
        $analise->save();

        return redirect()->route('dashboard')->with('sucesso', 'Matéria aprovada e publicada.');
    }
}
