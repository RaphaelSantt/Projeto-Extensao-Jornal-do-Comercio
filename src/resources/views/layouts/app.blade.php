<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <style>
    .fade-in { animation: fadeIn .45s ease-out; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes gradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}
  </style>

  @stack('styles')
</head>

<body class="min-h-screen" style="@yield('body-bg')">

  {{-- HEADER GLOBAL --}}
  @include('partials.header')

  {{-- CONTEÚDO DA PÁGINA --}}
  <div class="p-10 flex justify-center fade-in">
    @yield('content')

    
  </div>

  @stack('scripts')

 @include('partials.footer')
</body>
 
</html>
