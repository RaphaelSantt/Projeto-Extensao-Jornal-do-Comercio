<header class="relative w-full px-10 py-6 rounded-none border-b border-gray-800 shadow-2xl 
    bg-gradient-to-br from-gray-900 via-gray-850 to-black backdrop-blur-xl overflow-hidden">


  <div class="absolute inset-0 opacity-[0.25] 
      bg-[radial-gradient(circle_at_top_right,_rgba(99,102,241,.35),_transparent_60%)] pointer-events-none"></div>

  <div class="relative z-10 flex justify-between items-center">
    
    
    <div class="flex items-center gap-3">
      <svg width="32" height="32" viewBox="0 0 100 100" fill="none">
        <rect x="5" y="5" width="90" height="90" rx="18" stroke="white" stroke-width="6" opacity="0.35"/>
        <path d="M28 60 L45 40 L60 55 L75 30" stroke="white" stroke-width="6" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>

      <span class="text-white text-xl font-bold">IA Análises</span>
    </div>

    <nav class="relative z-10 flex gap-6">
      <a href="{{ route('home') }}" 
         class="text-gray-300 hover:text-white font-medium 
                {{ request()->routeIs('dashboard') ? 'underline underline-offset-4' : '' }}">
        Inicio 
      </a>
    


  </div>
</header>
