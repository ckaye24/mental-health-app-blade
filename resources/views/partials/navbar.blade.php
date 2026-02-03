@auth
<nav x-data="{ open: false, profileOpen: false }" class="sticky top-0 z-50 bg-[#F6F6F6]/90 backdrop-blur-md border-b border-gray-200 shadow-sm px-6 md:px-16 py-4">
    <div class="flex items-center justify-between">

        <div class="flex items-center space-x-3">
            <img src="{{ asset('pictures/icon.png') }}" class="w-8 h-8 md:w-12 md:h-12" alt="Logo">
            <span class="text-xl md:text-2xl font-bold text-[#1C1C84]">AI Self-Check</span>
        </div>

        <div class="hidden lg:flex items-center space-x-10 text-[#1C1C84] text-lg">
            <a href="{{ route('dashboard') }}" class="font-bold hover:underline underline-offset-8 transition decoration-2">Home</a>
            <a href="#" class="hover:underline underline-offset-8 transition decoration-2">Quiz</a>
            <a href="{{ route('chatbot') }}" class="hover:underline underline-offset-8 transition decoration-2">Chatbot</a>
            <a href="{{ route('about') }}" class="hover:underline underline-offset-8 transition decoration-2">About Us</a>
            <a href="{{ route('terms') }}" class="hover:underline underline-offset-8 transition decoration-2">Terms of Service</a>

            <div class="relative">
                <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 focus:outline-none transition-transform active:scale-95">
                    @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-[#1C1C84] shadow-sm">
                    @else
                    <div class="w-10 h-10 rounded-full bg-[#1C1C84] text-white flex items-center justify-center font-bold text-lg shadow-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    @endif
                </button>

                <div x-show="profileOpen"
                    @click.away="profileOpen = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50"
                    style="display: none;" x-cloak>

                    <div class="p-4 border-b border-gray-100 bg-gray-50">
                        <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Signed in as</p>
                        <p class="text-[#1C1C84] font-bold truncate">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="p-2 flex flex-col">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group text-[#3E5C66]">
                            <span>⚙️</span> <span class="font-medium">Profile Settings</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" onclick="sessionStorage.removeItem('privacy_accepted');" class="w-full flex items-center gap-3 p-3 rounded-xl hover:bg-red-50 text-red-600 transition group text-left">
                                <span>🚪</span> <span class="font-medium">Log Out</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:hidden flex items-center">
            <button @click="open = !open" class="text-[#1C1C84] focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="lg:hidden mt-4 pb-4 space-y-4 font-bold text-[#547B87] border-t border-gray-100 pt-4">
        <a href="{{ route('dashboard') }}" class="block text-[#1C1C84]">Home</a>
        <a href="#" class="block hover:text-[#1C1C84]">Quiz</a>
        <a href="#" class="block hover:text-[#1C1C84]">Chatbot</a>
        <a href="{{ route('about') }}" class="block hover:text-[#1C1C84]">About Us</a>
        <a href="{{ route('terms') }}" class="block hover:text-[#1C1C84]">Terms of Service</a>

        <div class="border-t border-gray-100 pt-4 mt-4">
            <div class="flex items-center gap-3 mb-4 px-2">
                @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="w-8 h-8 rounded-full object-cover">
                @else
                <div class="w-8 h-8 rounded-full bg-[#1C1C84] text-white flex items-center justify-center font-bold text-xs">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                @endif
                <span class="text-[#1C1C84]">{{ Auth::user()->name }}</span>
            </div>
            <a href="{{ route('profile.edit') }}" class="block text-sm mb-3 px-2">Profile Settings</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" onclick="sessionStorage.removeItem('privacy_accepted');" class="block text-sm text-red-600 px-2">Log Out</button>
            </form>
        </div>
    </div>
</nav>

@else
<nav x-data="{ open: false, toolsOpen: false }" class="sticky top-0 z-50 bg-[#F6F6F6]/90 backdrop-blur-md border-b border-gray-200 shadow-sm px-6 md:px-16 py-4">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('pictures/icon.png') }}" class="w-8 h-8 md:w-12 md:h-12" alt="Logo">
            <span class="text-xl md:text-2xl font-bold text-[#1C1C84]">AI Self-Check</span>
        </div>

        <div class="hidden lg:flex items-center space-x-10 text-[#1C1C84] text-lg">
            <a href="/" class="hover:underline underline-offset-8 transition decoration-2">Home</a>

            <div class="relative">
                <button @click="toolsOpen = !toolsOpen" class="flex items-center gap-1 hover:underline underline-offset-8 transition decoration-2 focus:outline-none">
                    Tools <svg class="w-4 h-4 transition-transform duration-200" :class="toolsOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div x-show="toolsOpen" @click.away="toolsOpen = false" class="absolute left-0 mt-2 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50" style="display: none;" x-cloak>
                    <div class="p-2 flex flex-col">
                        <a href="/#quiz" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group">
                            <span class="text-xl">📋</span> <span class="font-bold text-sm text-[#1C1C84]">Interactive Quiz</span>
                        </a>
                        <a href="/#chatbot" class="flex items-center gap-3 p-3 rounded-xl hover:bg-[#F6F6F6] transition group">
                            <span class="text-xl">💬</span> <span class="font-bold text-sm text-[#1C1C84]">AI Chatbot</span>
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('about') }}" class="hover:underline underline-offset-8 transition decoration-2">About Us</a>
            <a href="{{ route('terms') }}" class="hover:underline underline-offset-8 transition decoration-2">Terms of Service</a>
            <a href="{{ route('register') }}" class="bg-[#1C1C84] text-white px-6 py-2.5 rounded-xl font-bold flex items-center gap-2 shadow-md transition-all hover:bg-white hover:text-[#1C1C84] border-2 border-[#1C1C84]">Sign Up</a>
        </div>

        <div class="lg:hidden flex items-center">
            <button @click="open = !open" class="text-[#3E5C66] focus:outline-none">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" class="lg:hidden mt-4 pb-4 space-y-4 font-bold text-[#547B87]">
        <a href="/" class="block">Home</a>
        <a href="/#quiz" class="block">Quiz</a>
        <a href="/#chatbot" class="block">Chatbot</a>
        <a href="{{ route('about') }}" class="block">About</a>
        <a href="{{ route('terms') }}" class="block">Terms of Service</a>
        <a href="{{ route('register') }}" class="block text-[#1C1C84]">Sign Up</a>
    </div>
</nav>
@endauth