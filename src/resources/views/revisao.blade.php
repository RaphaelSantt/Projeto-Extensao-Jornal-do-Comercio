<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Revisão - {{ $analise->empresa->nome }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
  <div class="max-w-4xl mx-auto">
    <a href="{{ route('dashboard') }}" class="text-blue-600 mb-4 inline-block">&larr; Voltar</a>
    <h1 class="text-2xl font-bold mb-4">Revisão: {{ $analise->empresa->nome }} ({{ $analise->empresa->codigo }})</h1>

    {{-- 📊 DADOS FINANCEIROS --}}
    <section class="mb-4 bg-white p-4 rounded shadow">
      @php
          $dadosFinanceiros = json_decode($analise->dados_financeiros, true);
      @endphp

      <h2 class="font-semibold mb-2">
          📊 Júlia encontrou {{ count($dadosFinanceiros ?? []) }} fontes relevantes
      </h2>

      @if(is_array($dadosFinanceiros) && count($dadosFinanceiros) > 0)
          <ul class="divide-y divide-gray-200">
              @foreach($dadosFinanceiros as $item)
                  <li class="py-3">
                      <p class="font-semibold text-gray-800">{{ $item['titulo'] ?? 'Sem título' }}</p>
                      <p class="text-sm text-gray-600 mb-1">{{ $item['descricao'] ?? 'Sem descrição disponível.' }}</p>
                      @if(!empty($item['link']))
                          <a href="{{ $item['link'] }}" target="_blank" class="text-blue-600 hover:underline">
                              🔗 Acessar fonte
                          </a>
                      @endif
                  </li>
              @endforeach
          </ul>
      @else
          <p class="text-gray-500 text-sm">Nenhum dado financeiro disponível.</p>
      @endif
    </section>

    {{-- 💬 SENTIMENTO --}}
    <section class="mb-4 bg-white p-4 rounded shadow">
      <h2 class="font-semibold mb-2">Sentimento de mercado</h2>
      <p>{{ $analise->sentimento_mercado }}</p>
    </section>

    {{-- ✍️ CONTEÚDO --}}
    <form action="{{ route('aprovar', $analise->id) }}" method="POST">
      @csrf
      <section class="mb-4 bg-white p-4 rounded shadow">
        <h2 class="font-semibold mb-2">Conteúdo gerado (edite se precisar)</h2>
        <textarea name="conteudo" rows="12" class="w-full border p-2">{{ $analise->conteudo_gerado }}</textarea>
      </section>

      <div class="flex gap-2">
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Aprovar e publicar</button>
        <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>
