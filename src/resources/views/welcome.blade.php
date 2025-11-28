@extends('layouts.app')

@section('title', 'Bem-vindo - IA Análises')

@section('body-bg', '
    background: linear-gradient(to bottom right, #030712, #111827, #000000);
    background-size: 200% 200%;
    animation: gradient 15s ease infinite;
')

@section('content')


<div class="min-h-screen flex items-center justify-center px-6">
  <div class="max-w-7xl w-full fade-in">

    <!-- CONTAINER GRID COM DUAS COLUNAS -->
    <div class="grid md:grid-cols-2 overflow-hidden rounded-3xl shadow-3xl">

      <!-- ==== LADO ESQUERDO - HERO (seu conteúdo atual) ==== -->
      <section class="relative p-6 bg-gradient-to-br from-gray-900 via-gray-850 to-black overflow-hidden">

        <div class="absolute inset-0 opacity-25 bg-[radial-gradient(circle_at_top_right,rgba(99,102,241,.35),transparent_60%)]"></div>

        <div class="relative z-10 text-white h-full flex flex-col justify-center">

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

          <div class="max-w-3xl space-y-5 text-gray-200 text-lg leading-relaxed">
            <p>A Júlia analisa dados financeiros complexos, identifica padrões e entrega diagnósticos detalhados com precisão e velocidade.<br><br>
               O Pedro analisa o que o mercado e a mídia estão dizendo sobre a empresa.<br><br>
               No final o Key gera um texto informativo completo usando os dados recolhidos por Júlia e Pedro.</p>

            <p>Plataforma corporativa desenvolvida para oferecer insights avançados, automação e inteligência de negócios para empresas de alta performance.</p>

            <p class="text-xl md:text-2xl font-semibold text-indigo-300 mt-8">
              Análises profundas. Confiabilidade absoluta. Inteligência real.
            </p>
          </div>
        </div>
      </section>

      <!-- ==== LADO DIREITO - LOGIN (fundo azul/indigo escuro) ==== -->
<section class="relative bg-white p-6 lg:p-16 flex flex-col justify-center overflow-hidden">
        <!-- Brilho radial azul/violeta no canto superior esquerdo -->
        <div class="absolute inset-0 opacity-40 bg-[radial-gradient(circle_at_top_left,rgba(99,102,241,0.5),transparent_70%)] pointer-events-none"></div>

        <div class="relative z-10 w-full max-w-md">
          <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-black mb-2">Bem-vindo de volta</h2>
            <p class="text-black">Acesse sua conta corporativa</p>
          </div>

          <form id="loginForm" name="loginForm" autocomplete="on" class="space-y-6">
            <div>
              <label for="email" class="block text-sm font-medium text-black mb-2">E-mail corporativo</label>
              <input type="email" class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 backdrop-blur-md text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="seunome@empresa.com">
            </div>

            <div>
              <label for="password" class="block text-sm font-medium text-black mb-2">Senha</label>
              <input type="password" class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/20 backdrop-blur-md text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition " placeholder="••••••••">
            </div>

            <div class="mt-10">
            <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold text-lg shadow-lg transform hover:scale-[1.02] transition duration-200" >
              Entrar na plataforma
            </button>

            <div id="message" class="text-sm text-red-600 hidden" role="status" aria-live="polite"></div>

            </div>

            <div class="text-center mt-6">
              <a href="#" class="text-indigo-300 hover:text-white text-sm transition">Esqueceu a senha?</a>
            </div>
          </form>
        </div>
      </section>

    </div>
  </div>
</div>
@endsection