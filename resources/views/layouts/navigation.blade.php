<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        {{-- Dashboard --}}
                        @if(Auth::user()->role === 'seller')
                            <x-nav-link :href="route('seller.dashboard')" :active="request()->routeIs('seller.dashboard')">
                                Dashboard Seller
                            </x-nav-link>
                        @elseif(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Dashboard Admin
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                Dashboard
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @auth
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-700">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">▼</div>
                        </button>
                        @endauth

                        @guest
                        <a href="{{ route('login') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-gray-800">Masuk</a>
                        <a href="{{ route('register') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-gray-800">Daftar</a>
                        @endguest
                    </x-slot>

                    @auth
                    <x-slot name="content">

                        {{-- Profile menu berdasarkan role --}}
                        @if(Auth::user()->role === 'seller')
                            <x-dropdown-link :href="route('seller.profile')">
                                Profil Toko
                            </x-dropdown-link>

                        @elseif(Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('admin.dashboard')">
                                Admin Panel
                            </x-dropdown-link>

                        @else
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>
                        @endif

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                    @endauth
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
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
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(Auth::user()->role === 'seller')
                    <x-responsive-nav-link :href="route('seller.dashboard')">Dashboard Seller</x-responsive-nav-link>
                @elseif(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')">Dashboard Admin</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')">Dashboard</x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">

            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">

                    @if(Auth::user()->role === 'seller')
                        <x-responsive-nav-link :href="route('seller.profile')">
                            Profil Toko
                        </x-responsive-nav-link>

                    @elseif(Auth::user()->role === 'admin')
                        <x-responsive-nav-link :href="route('admin.dashboard')">
                            Admin Panel
                        </x-responsive-nav-link>

                    @else
                        <x-responsive-nav-link :href="route('profile.edit')">
                            Profile
                        </x-responsive-nav-link>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth

            @guest
                <div class="px-4 space-y-3">
                    <a href="{{ route('login') }}" class="block text-sm text-gray-700">Masuk</a>
                    <a href="{{ route('register') }}" class="block text-sm text-gray-700">Daftar</a>
                </div>
            @endguest

        </div>
    </div>
</nav>