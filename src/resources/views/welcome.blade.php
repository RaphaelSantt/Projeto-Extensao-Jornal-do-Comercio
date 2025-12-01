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

     
       <div class="text-center mb-28">
    <h2 class="text-3xl font-bold text-black mb-2">Bem-vindo!</h2>
    <p class="text-black mb-8">Acesse nossa plataforma gratuitamente</p> 
    
    <button type="button"
            onclick="window.location.href='{{ route('dashboard') }}'"
            class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold text-lg shadow-lg transform hover:scale-[1.02] transition duration-200">
       Começar
    </button>
</div>

           

        
        
        </div>
      </section>

    </div>
  </div>
</div>
@endsection