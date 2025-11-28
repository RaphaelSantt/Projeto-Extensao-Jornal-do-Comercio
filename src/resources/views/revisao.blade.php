@extends('layouts.app')

@section('title', 'Revisão - Análises Financeiras')

@section('body-bg', 'background: rgba(240, 240, 240, 1)')

@section('content')

<div class="min-h-screen p-8 flex justify-center">



  <div class="max-w-6xl w-full mx-auto fade-in space-y-12">

    <!-- Botão Voltar -->
    
<a href="{{ route('dashboard') }}" 
   class="inline-flex items-center gap-3 px-10 py-4 rounded-xl 
          bg-white hover:bg-purple-500
          border border-gray-700 
          text-black font-bold hover:text-white
          shadow-xl backdrop-blur-sm
          transform hover:scale-105 transition-all duration-300">
  ← Voltar ao Dashboard
</a>
    

    <!-- HERO Júlia -->
    <section class="relative p-12 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,.35),_transparent_60%)]"></div>

      <div class="relative z-10 text-center text-white">
        <div class="flex justify-center mb-6">
          <div class="p-5 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/10">
            <svg width="56" height="56" viewBox="0 0 100 100" fill="none" stroke="white">
              <rect x="8" y="8" width="84" height="84" rx="20" stroke-width="5" opacity="0.4"/>
              <path d="M25 65 L40 45 L55 60 L75 35" stroke-width="7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-3">
          Júlia concluiu a análise
        </h1>
        <p class="text-2xl text-gray-300">
          Relatório financeiro completo de <span class="text-blue-300 font-bold">{{ $analise->empresa->nome }}</span>
          <span class="text-gray-400">({{ $analise->empresa->codigo }})</span>
        </p>
        <p class="mt-6 text-xl text-gray-400 italic">
          “Análise concluída com base nas tendências mais recentes do mercado.”
        </p>
      </div>
    </section>

    <!-- Notícias e Dados Financeiros (Júlia) -->
    <section class="relative p-10 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_bottom_left,_rgba(99,102,241,.3),_transparent_60%)]"></div>
      <div class="relative z-10">
        <h2 class="text-3xl font-bold text-white mb-8 flex items-center gap-3">
          Notícias e dados financeiros encontrados
        </h2>

        @php
          $dados = $analise->dados_financeiros ?? [];
          $resultados = $dados['resultados'] ?? $dados ?? [];
        @endphp

        @if(count($resultados) > 0)
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($resultados as $noticia)
              <div class="p-6 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition">
                <h3 class="text-xl font-bold text-white mb-3">{{ $noticia['titulo'] }}</h3>

                @if(!empty($noticia['fonte']))
                  <p class="text-sm text-gray-400 mb-3">Fonte: {{ $noticia['fonte'] }}</p>
                @endif

                <p class="text-gray-300 leading-relaxed mb-4">{{ $noticia['descricao'] }}</p>

                @if(isset($noticia['resumo']))
                  <div class="p-4 rounded-xl bg-blue-900/30 border border-blue-500/30">
                    <p class="text-sm text-blue-200 italic">Resumo da Júlia: {{ $noticia['resumo'] }}</p>
                  </div>
                @endif

                <a href="{{ $noticia['link'] }}" target="_blank"
                   class="inline-block mt-4 text-blue-400 hover:text-blue-300 text-sm font-medium">
                  Ler matéria completa →
                </a>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-gray-400 text-lg">Nenhuma notícia encontrada para esta empresa.</p>
        @endif
      </div>
    </section>

    <!-- Cabeçalho Pedro -->
    <section class="relative p-12 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden text-center">
      <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_top_left,_rgba(34,211,238,.35),_transparent_60%)]"></div>
      <div class="relative z-10 text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Pedro analisou o mercado</h1>
        <p class="text-2xl text-gray-300">
          Percepções da mídia e do mercado sobre <span class="text-cyan-300 font-bold">{{ $analise->empresa->nome }}</span>
        </p>

        @php
          $sentimento = strtolower($analise->sentimento_mercado);
          $cores = [
            'positivo' => 'from-green-500 to-emerald-600',
            'negativo' => 'from-red-500 to-rose-600',
            'neutro'   => 'from-gray-500 to-gray-600'
          ];
          $gradiente = $cores[$sentimento] ?? 'from-gray-500 to-gray-600';
        @endphp

        <div class="mt-6 inline-block px-6 py-3 rounded-full text-lg font-bold bg-gradient-to-r {{ $gradiente }} text-white shadow-lg">
          Sentimento do mercado: {{ ucfirst($analise->sentimento_mercado) }}
        </div>

        @if(isset($analise->discussoes) && is_array($analise->discussoes))
          @php
            $temas = array_unique(array_map(fn($d) => $d['topico'] ?? '', $analise->discussoes));
          @endphp
          <div class="mt-6 flex flex flex-wrap justify-center gap-3">
            @foreach($temas as $t)
              <span class="px-4 py-2 rounded-full bg-cyan-900/40 border border-cyan-500/40 text-cyan-200 text-sm">
                {{ Str::limit($t, 40) }}
              </span>
            @endforeach
          </div>
        @endif
      </div>
    </section>

    <!-- Discussões do Pedro -->
    <section class="relative p-10 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden">
      <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_bottom_right,_rgba(34,211,238,.3),_transparent_60%)]"></div>
      <div class="relative z-10">
        <h2 class="text-3xl font-bold text-white mb-8">Discussões detectadas por Pedro</h2>

        @php
          $discussoes = $analise->discussoes ?? [];
          if (is_string($discussoes)) {
            $discussoes = json_decode($discussoes, true) ?? [];
          }
        @endphp

        @if(count($discussoes) > 0)
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            @foreach($discussoes as $d)
              @php
                $cor = $d['impacto'] === 'positivo' ? 'from-green-500 to-emerald-600' :
                       ($d['impacto'] === 'negativo' ? 'from-red-500 to-rose-600' : 'from-gray-500 to-gray-600');
              @endphp
              <div class="p-6 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 hover:border-white/20 transition">
                <h3 class="text-xl font-bold text-white mb-3">{{ $d['topico'] }}</h3>
                <p class="text-gray-300 mb-4 leading-relaxed">{{ $d['resumo'] }}</p>
                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold bg-gradient-to-r {{ $cor }} text-white">
                  Impacto: {{ ucfirst($d['impacto']) }}
                </span>
              </div>
            @endforeach
          </div>
        @else
          <p class="text-gray-400 text-lg">Nenhuma discussão registrada por Pedro.</p>
        @endif
      </div>
    </section>

    <!-- Revisão final e aprovação -->
<form action="{{ route('aprovar', $analise->id) }}" method="POST" class="relative p-10 rounded-3xl bg-gradient-to-br from-gray-900 via-gray-850 to-black shadow-2xl overflow-hidden">
  @csrf 

  <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_center,_rgba(99,102,241,.35),_transparent_60%)]"></div>
  <div class="relative z-10 space-y-8">
    <h2 class="text-3xl font-bold text-white">Conteúdo final gerado (revise se necessário)</h2>

    <textarea name="conteudo" rows="12"
      class="w-full p-5 rounded-2xl bg-gray-800/60 border border-gray-700 text-black-100 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y text-lg leading-relaxed backdrop-blur-sm">
{{ $analise->conteudo_gerado }}</textarea>

    <div class="flex justify-end gap-5 pt-6">
      <a href="{{ route('dashboard') }}"
         class="px-8 py-4 rounded-xl bg-gray-800/60 hover:bg-gray-800 border border-gray-700 text-gray-300 font-semibold transition">
        Cancelar
      </a>
      <button type="submit" class="w-auto py-4 px-6 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold text-lg shadow-lg transform hover:scale-[1.02] transition duration-200">
        Aprovar e Publicar
      </button>
    </div>
  </div>
</form>

  </div>
        </div>

        @endsection