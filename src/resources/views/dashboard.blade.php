<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>Dashboard - Análises</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen p-8">
  <div class="max-w-5xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Análises Financeiras (MVP)</h1>

    @if(session('sucesso'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('sucesso') }}</div>
    @endif

    <form action="{{ route('gerar') }}" method="POST" class="mb-6 bg-white p-4 rounded shadow">
      @csrf
      <label class="block font-semibold mb-2">Selecione a empresa</label>
      <div class="flex gap-2">
        <select name="empresa_id" required class="p-2 border rounded w-1/2">
          <option value="">-- escolha --</option>
          @foreach($empresas as $e)
            <option value="{{ $e->id }}">{{ $e->nome }} ({{ $e->codigo }})</option>
          @endforeach
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Gerar análise</button>
      </div>
    </form>

    <!-- 🌀 Barra de carregamento (inicialmente oculta) -->
<div id="loadingBar" class="hidden w-full h-2 bg-gray-200 rounded-full mt-4 overflow-hidden">
  <div class="h-full bg-blue-600 rounded-full animate-loading"></div>
</div>

<!-- 🧠 Script que ativa a barra quando o formulário é enviado -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const loadingBar = document.getElementById("loadingBar");

    if (form && loadingBar) {
      form.addEventListener("submit", () => {
        loadingBar.classList.remove("hidden");
      });
    }
  });
</script>

<!-- 💅 Animação suave -->
<style>
@keyframes progress {
  0% { width: 0%; }
  50% { width: 75%; }
  100% { width: 100%; }
}

.animate-loading {
  animation: progress 3s ease-in-out infinite alternate;
}
</style>

<p id="loadingText" class="hidden text-gray-600 mt-2 italic">🧠 Júlia está analisando as fontes financeiras, aguarde um instante...</p>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");
    const loadingText = document.getElementById("loadingText");

    if (form && loadingText) {
      form.addEventListener("submit", () => {
        loadingText.classList.remove("hidden");
      });
    }
  });
</script>

    
    <h2 class="text-xl font-semibold mb-3">Análises recentes</h2>
    <div class="bg-white shadow rounded">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="p-3 text-left">Empresa</th>
            <th class="p-3">Status</th>
            <th class="p-3">Criado em</th>
            <th class="p-3">Ações</th>
          </tr>
        </thead>
        <tbody>
          @forelse($analises as $a)
            <tr class="border-t">
              <td class="p-3">{{ $a->empresa->nome }} ({{ $a->empresa->codigo }})</td>
              <td class="p-3 text-center">{{ $a->aprovado ? '? Publicada' : '?? Em revisão' }}</td>
              <td class="p-3">{{ $a->created_at->format('d/m/Y H:i') }}</td>
              <td class="p-3"><a href="{{ route('revisao', $a->id) }}" class="text-blue-600">Ver / Revisar</a></td>
            </tr>
          @empty
            <tr><td colspan="4" class="p-4">Nenhuma análise ainda.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
