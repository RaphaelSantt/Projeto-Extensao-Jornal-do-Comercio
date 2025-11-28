@extends('layouts.app')

@section('title', 'Dashboard - Análises Financeiras')

@section('body-bg', 'background: rgba(240, 239, 239, 1)')

@section('content')

       
<div class="max-w-6xl w-full fade-in space-y-14">

  <!-- HERO / APRESENTAÇÃO 
  <section class="relative w-full p-12 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden">

    <div class="absolute inset-0 opacity-[0.25] bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,.35),_transparent_60%)]"></div>

    <div class="relative z-10 text-white">

    
      <div class="flex items-center gap-5 mb-10">
        <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/10 shadow-lg">
          <svg width="40" height="40" viewBox="0 0 100 100" fill="none">
            <rect x="5" y="5" width="90" height="90" rx="18" stroke="white" stroke-width="6" opacity="0.35"/>
            <path d="M28 60 L45 40 L60 55 L75 30" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <div>
          <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
            IA Análises Financeiras
          </h1>
          <p class="text-gray-300 text-lg mt-1">Análises inteligentes para decisões corporativas</p>
        </div>
      </div>

     
      <div class="max-w-3xl space-y-4 text-gray-200 text-lg leading-relaxed">
        <p>A Júlia analisa dados financeiros complexos, identifica padrões e entrega diagnósticos detalhados com precisão e velocidade.
          <br><br> O pedro analisa o que o mercado e a mídia estão dizendo sobre a empresa.
          <br> <br>No final o Key gera um texto informativo completo usando os dados recolhidos por Júlia e Pedro.
        </p>

        <p>Plataforma corporativa desenvolvida para oferecer insights avançados, automação e inteligência de negócios para empresas de alta performance.</p>

        <p class="text-xl md:text-2xl font-semibold text-blue-300 mt-8">
          Análises profundas. Confiabilidade absoluta. Inteligência real.
        </p>
      </div>

    </div>
  </section>

  -->

  <!-- CARD: GERAR NOVA ANÁLISE -->
<div class=" p-10 rounded-3xl shadow-2xl overflow-hidden bg-gradient-to-br from-gray-900 via-gray-850 to-black">

  <div class="absolute inset-0 opacity-[0.25] bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,.35),_transparent_60%)]"></div>

  <div class="relative z-10">
    <h2 class="text-3xl font-bold mb-2 text-white">Gerar nova análise</h2>

    <p class="text-gray-300 mb-7 text-lg">
      Escolha uma empresa e permita que a Júlia prepare a análise financeira completa.
    </p>

    <form action="{{ route('gerar') }}" method="POST" class="space-y-5">
      @csrf
      <label class="block font-semibold text-gray-200">Empresa</label>

      <div class="flex flex-col md:flex-row gap-4">
        <select name="empresa_id" required
          class="p-3 w-full md:w-1/2 rounded-xl bg-gray-800 border border-gray-700 text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
          <option value="">-- escolha --</option>
          @foreach($empresas as $e)
            <option value="{{ $e->id }}">{{ $e->nome }} ({{ $e->codigo }})</option>
          @endforeach
        </select>

<button type="submit" class="w-auto py-4 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold text-lg shadow-lg transform hover:scale-[1.02] transition duration-200">
  Gerar análise
</button>
      </div>
    </form>

    <div id="loadingBar" class="hidden w-full h-2 bg-gray-700 rounded-full mt-6 overflow-hidden">
      <div class="h-full bg-blue-500 animate-[loading_1.8s_infinite]"></div>
    </div>

    <p id="loadingText" class="hidden text-gray-400 mt-3 italic text-sm flex items-center gap-2">
      🧠 A Júlia está analisando os dados financeiros... aguarde.
    </p>
  </div>
</div>



<!-- TÍTULO E TABELA DE ANÁLISES RECENTES -->
<div class="relative backdrop-blur-xl  rounded-3xl shadow-2xl p-10 bg-gradient-to-br from-gray-900 via-gray-850 to-black overflow-hidden">

  <div class="absolute inset-0 opacity-[0.25] bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,.35),_transparent_60%)]"></div>

  <div class="relative z-10">
    <h2 class="text-3xl font-bold text-white mb-6">Análises Recentes</h2>

  

    <table class="min-w-full text-gray-200">
      <thead>
        <tr class="bg-gray-800/60 text-gray-300 text-sm font-semibold border-b border-gray-700">
          <th class="p-4 text-left">Empresa</th>
          <th class="p-4 text-center">Status</th>
          <th class="p-4">Criado em</th>
          <th class="p-4">Ações</th>
        </tr>
      </thead>

      <tbody class="divide-y divide-gray-800">

        @forelse($analises as $a)
        <tr class="hover:bg-gray-800/40 transition">
          <td class="p-4 font-medium">{{ $a->empresa->nome }} ({{ $a->empresa->codigo }})</td>

          <td class="p-4 text-center">
            @if($a->aprovado)
              <span class="px-3 py-1 rounded-xl bg-green-700/30 text-green-300 font-semibold text-sm">
                ✔️ Publicada
              </span>
            @else
              <span class="px-3 py-1 rounded-xl bg-yellow-700/30 text-yellow-300 font-semibold text-sm">
                ⏳ Em revisão
              </span>
            @endif
          </td>

          <td class="p-4 text-gray-400 text-sm">{{ $a->created_at->format('d/m/Y H:i') }}</td>

          <td class="p-4">
            <a href="{{ route('revisao', $a->id) }}"
               class="text-blue-400 hover:text-blue-300 font-semibold text-sm underline">
              Ver / Revisar
            </a>
          </td>
        </tr>
        @empty

        <tr>
          <td colspan="4" class="p-6 text-center text-gray-500">
            Nenhuma análise disponível.
          </td>
        </tr>

        @endforelse
      </tbody>
    </table>
  </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const bar = document.getElementById("loadingBar");
    const text = document.getElementById("loadingText");

    form.addEventListener("submit", () => {
      bar.classList.remove("hidden");
      text.classList.remove("hidden");
    });
  });
</script>

    </div>
@endsection
