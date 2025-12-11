<nav x-data="{ open: false }" class="bg-white border-b shadow-sm w-full px-12 py-4">

    <!-- Wrapper -->
    <div class="flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="relative flex items-center">
            <div class="h-10 flex items-center"> 
                <img src="{{ asset('assets/logo/thriftsy.png') }}" 
                    class="h-20 w-auto object-contain -ml-2">
            </div>
        </a>

        {{-- Auth --}}
        <div class="hidden sm:flex items-center gap-8 text-sm font-semibold">

            @guest
                <a href="{{ route('login') }}" class="hover:text-black transition">Login</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
                    Daftar
                </a>

            @else

                {{-- ===== DROPDOWN CUSTOM (HOVER) ===== --}}
                <div class="group inline-block relative cursor-pointer">

                    <button class="flex items-center gap-1 text-gray-800 hover:text-black transition">
                        {{ auth()->user()->name }}
                        <span class="text-xs">▼</span>
                    </button>

                    <div class="absolute right-0 mt-2 w-40 bg-white border rounded-xl shadow-md opacity-0 invisible
                                group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">

                        {{-- Profile --}}
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">
                            Profil
                        </a>

                        {{-- Logout --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 transition">
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
