<nav x-data="{ open: false }" class="bg-white border-b shadow-sm w-full px-12 py-4">

    <!-- Row 1: Logo, Search & Auth -->
    <div class="flex items-center justify-between mb-4">

        {{-- Logo --}}
        <a href="/" class="relative flex items-center flex-shrink-0">
            <div class="h-10 flex items-center"> 
                <img src="{{ asset('assets/logo/thriftsy.png') }}" 
                    class="h-20 w-auto object-contain -ml-2">
            </div>
        </a>

        {{-- Search Bar --}}
        <div class="flex-1 max-w-xl mx-8">
            <form action="/" method="GET" class="relative">
                <input type="text" 
                       name="search" 
                       placeholder="Cari pakaian vintage..." 
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-gray-400 transition">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Auth --}}
        <div class="hidden sm:flex items-center gap-6 text-sm font-semibold">

            @guest
                <a href="{{ route('login') }}" class="flex items-center gap-2 hover:text-black transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar
                </a>

            @else

                {{-- MEMBER ONLY WALLET --}}
                @if(auth()->user()->role === 'member')
                <a href="{{ route('wallet.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl bg-blue-500 text-white hover:bg-blue-600 transition shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7h-2V5a1 1 0 0 0-1-1H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm-4-2v2H5a1 1 0 0 1 0-2h11zm3 14H5a1 1 0 0 1-1-1V8h15v11z" />
                        <circle cx="15" cy="13" r="2" />
                    </svg>
                    <span class="text-xs font-medium">Wallet</span>
                </a>
                @endif

                {{-- SELLER ONLY --}}
                @if(auth()->user()->role === 'seller' && auth()->user()->store)
                <a href="{{ route('seller.dashboard') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Toko Saya
                </a>
                @endif

                {{-- ADMIN --}}
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-2 px-4 py-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Admin Panel
                </a>
                @endif

                {{-- User Dropdown --}}
                <div class="group inline-block relative cursor-pointer">

                    <button class="flex items-center gap-1 text-gray-800 hover:text-black transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        {{ auth()->user()->name }}
                        <span class="text-xs">▼</span>
                    </button>

                    <div class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-md opacity-0 invisible
                                group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">

                        {{-- Profile --}}
                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Profil
                        </a>

                        {{-- Logout --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 text-left px-4 py-2 text-red-500 hover:bg-gray-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>

                    </div>
                </div>

            @endguest
        </div>

        {{-- Hamburger (Mobile) --}}
        <div class="sm:hidden flex items-center">
            <button @click="open = ! open"
                class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    <!-- Row 2: Category Navigation -->
    <div class="hidden md:flex items-center gap-6 text-sm font-semibold">
        
        {{-- Pria Dropdown --}}
        <div class="group relative">
            <span class="text-gray-700 hover:text-black transition py-2 cursor-pointer">
                Pria
            </span>

            <div class="absolute left-0 mt-0 w-48 bg-white border rounded-xl shadow-lg 
                        hidden group-hover:block z-50 py-2">
                <a href="{{ route('category.browse', 'kemeja-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Kemeja Pria
                </a>
                <a href="{{ route('category.browse', 'kaos-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Kaos Pria
                </a>
                <a href="{{ route('category.browse', 'celana-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Celana Pria
                </a>
                <a href="{{ route('category.browse', 'jaket-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Jaket Pria
                </a>
                <a href="{{ route('category.browse', 'tas-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Tas Pria
                </a>
                <a href="{{ route('category.browse', 'sneakers-pria') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Sneakers Pria
                </a>
            </div>
        </div>

        {{-- Wanita Dropdown --}}
        <div class="group relative">
            <span class="text-gray-700 hover:text-black transition py-2 cursor-pointer">
                Wanita
            </span>

            <div class="absolute left-0 mt-0 w-48 bg-white border rounded-xl shadow-lg 
                        hidden group-hover:block z-50 py-2">
                <a href="{{ route('category.browse', 'dress') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Dress
                </a>
                <a href="{{ route('category.browse', 'kemeja-wanita') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Kemeja Wanita
                </a>
                <a href="{{ route('category.browse', 'hoodie-wanita') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Hoodie Wanita
                </a>
                <a href="{{ route('category.browse', 'sweater-wanita') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Sweater Wanita
                </a>
                <a href="{{ route('category.browse', 'sneakers-wanita') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Sneakers Wanita
                </a>
                <a href="{{ route('category.browse', 'backpack-wanita') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Backpack Wanita
                </a>
                <a href="{{ route('category.browse', 'handbag') }}" 
                   class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                    Handbag
                </a>
            </div>
        </div>

    </div>


    <!-- Responsive Navigation -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden mt-4">

        {{-- Auth --}}
        <div class="pt-2 pb-3 space-y-2">

            @guest

                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Daftar
                </a>

            @else

                {{-- Role Menu --}}
                @if(Auth::user()->role === 'seller')
                    <a href="{{ route('seller.dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Dashboard Seller
                    </a>

                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Admin Panel
                    </a>

                @else
                    <a href="{{ route('dashboard') }}"
                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Dashboard
                    </a>
                @endif

                <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                    Profil
                </a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
                        Logout
                    </button>
                </form>

            @endguest

        </div>

    </div>

</nav>
