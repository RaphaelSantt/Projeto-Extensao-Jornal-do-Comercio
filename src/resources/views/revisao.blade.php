<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Painel de Revisão - {{ $analise->empresa->nome }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start p-6">

  <!-- Barra de carregamento animada -->
  <div class="fixed top-0 left-0 w-full h-1 bg-gray-300 rounded-full overflow-hidden">
    <div class="h-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-600 animate-pulse rounded-full w-3/4"></div>
  </div>

  <!-- Container principal -->
  <div class="w-full max-w-5xl mt-10">
    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline mb-6 inline-block">&larr; Voltar</a>

    <!-- Cabeçalho -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6 text-center border border-gray-200">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-2">🧠 Júlia concluiu a análise</h1>
      <p class="text-gray-600 text-lg">
        Relatório financeiro gerado para <strong>{{ $analise->empresa->nome }}</strong>
        <span class="text-sm text-gray-500">({{ $analise->empresa->codigo }})</span>
      </p>
      <p class="mt-3 text-gray-500 italic">“Análise concluída com base nas tendências mais recentes do mercado.”</p>
    </div>

    <!-- Notícias encontradas -->
    <section class="mb-6">
      <h2 class="text-2xl font-semibold text-gray-800 mb-4">📊 Notícias e dados financeiros</h2>

@php
    $dados = $analise->dados_financeiros ?? [];
    $resultados = $dados['resultados'] ?? $dados ?? [];
@endphp


      @if(count($resultados) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          @foreach($resultados as $noticia)
            <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all border border-gray-200">
              <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $noticia['titulo'] }}</h3>
              
              <!-- Fonte -->
              @if(!empty($noticia['fonte']))
                <p class="text-sm text-gray-500 mb-2">📰 Fonte: {{ $noticia['fonte'] }}</p>
              @endif

              <!-- Resumo / Descrição -->
              <p class="text-gray-700 mb-3 leading-relaxed">
                {{ $noticia['descricao'] }}
              </p>

              <!-- Resumo da Júlia (se disponível futuramente) -->
              @if(isset($noticia['resumo']))
                <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded-md mb-2">
                  <p class="text-sm text-gray-700 italic">💡 <strong>Resumo da Júlia:</strong> {{ $noticia['resumo'] }}</p>
                </div>
              @endif

              <a href="{{ $noticia['link'] }}" target="_blank" class="text-indigo-600 text-sm hover:underline">
                🔗 Ler matéria completa
              </a>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-gray-600">Nenhuma notícia encontrada para esta empresa.</p>
      @endif
    </section>


<!-- Cabeçalho Pedro -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6 text-center border border-gray-200">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-2">📡 Pedro analisou o mercado</h1>

    <p class="text-gray-600 text-lg">
        Percepções do mercado e mídia sobre 
        <strong>{{ $analise->empresa->nome }}</strong>
    </p>

    <!-- Sentimento com cor dinâmica -->
    @php
        $sentimento = strtolower($analise->sentimento_mercado);
        $cores = [
            'positivo' => 'text-green-600 bg-green-100',
            'negativo' => 'text-red-600 bg-red-100',
            'neutro'   => 'text-gray-600 bg-gray-200'
        ];
        $classeCor = $cores[$sentimento] ?? 'text-gray-600 bg-gray-200';
    @endphp

    <div class="mt-3 inline-block px-4 py-1 rounded-full text-sm font-semibold {{ $classeCor }}">
        Sentimento: {{ ucfirst($analise->sentimento_mercado) }}
    </div>

    <!-- Temas detectados -->
    @if(isset($analise->discussoes) && is_array($analise->discussoes))
        @php
            $temas = array_unique(array_map(fn($d) => $d['topico'] ?? '', $analise->discussoes));
        @endphp

        <div class="mt-4 flex flex-wrap justify-center gap-2">
            @foreach($temas as $t)
                <span class="bg-blue-50 text-blue-700 border border-blue-200 px-3 py-1 rounded-full text-xs">
                    {{ Str::limit($t, 30) }}
                </span>
            @endforeach
        </div>
    @endif

    <!-- Resumo simples -->
    <p class="mt-4 text-gray-500 italic">
        “{{ $analise->resumo_pedro ?? 'Resumo do Pedro será aprimorado em versões futuras.' }}”
    </p>
</div>


    <!-- Discussões do Pedro -->
<section class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">🧩 Discussões de mercado (Pedro)</h2>

    @php
        $discussoes = $analise->discussoes ?? [];
        if (is_string($discussoes)) {
            $discussoes = json_decode($discussoes, true) ?? [];
        }
    @endphp

    @if(count($discussoes) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($discussoes as $d)
                <div class="bg-white rounded-2xl p-6 shadow hover:shadow-lg transition-all border border-gray-200">
                    
                    <h3 class="text-lg font-bold text-gray-800 mb-2">
                        🔹 {{ $d['topico'] }}
                    </h3>

                    <p class="text-gray-700 mb-3 leading-relaxed">
                        {{ $d['resumo'] }}
                    </p>

                    <span class="inline-block px-3 py-1 text-sm rounded-full
                        @if($d['impacto'] === 'positivo')
                            bg-green-100 text-green-700
                        @elseif($d['impacto'] === 'negativo')
                            bg-red-100 text-red-700
                        @else
                            bg-gray-200 text-gray-700
                        @endif
                    ">
                        Impacto: <strong>{{ ucfirst($d['impacto']) }}</strong>
                    </span>

                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Nenhuma discussão registrada por Pedro.</p>
    @endif
</section>


    <!-- Conteúdo final -->
    <form action="{{ route('aprovar', $analise->id) }}" method="POST" class="space-y-6">
      @csrf
      <section class="bg-white p-6 rounded-2xl shadow-md border border-gray-200">
        <h2 class="font-semibold mb-3 text-gray-800">📝 Conteúdo gerado (revise se necessário)</h2>
        <textarea name="conteudo" rows="10" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-400 outline-none resize-y text-gray-800">{{ $analise->conteudo_gerado }}</textarea>
      </section>

      <div class="flex justify-end gap-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-xl transition-all">
          Cancelar
        </a>
        <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-6 py-2 rounded-xl shadow">
          ✅ Aprovar e publicar
        </button>
      </div>
    </form>
  </div>
</body>
</html>
