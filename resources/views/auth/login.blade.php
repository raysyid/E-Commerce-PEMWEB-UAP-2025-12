<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-[1000px] bg-white shadow-xl rounded-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden min-h-[550px]">

            {{-- LEFT SIDE — FULL FOTO --}}
            <div class="relative p-10 flex flex-col justify-end items-start text-white
                        bg-cover bg-center bg-no-repeat"
                 style="background-image: url('{{ asset('assets/foto/loginFoto.jpg') }}');">

                <div class="absolute inset-0 bg-black/30"></div>

                <div class="relative z-10 max-w-sm">
                    <h2 class="text-3xl font-bold mb-3 leading-tight">
                        Vintage Style,<br>Fresh Vibes
                    </h2>

                    <p class="text-sm opacity-90 leading-relaxed">
                        Temukan outfit unik dan estetik yang bikin penampilanmu makin standout.
                    </p>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="p-10 flex flex-col justify-center">

                {{-- Logo --}}
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('assets/logo/thriftsy.png') }}" class="h-14">
                </div>

                <h2 class="text-center text-xl font-semibold mb-6 text-gray-700">
                    Welcome Back!
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black">
                    </div>

                    {{-- Password --}}
                    <div class="mt-4">
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-black focus:border-black">
                    </div>

                    {{-- Remember --}}
                    <div class="flex items-center justify-between mt-4 text-sm">
                        <label class="flex items-center gap-2 text-gray-600">
                            <input type="checkbox" class="rounded border-gray-300 text-black focus:ring-black">
                            Remember me
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-gray-500 hover:text-black">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- Button --}}
                    <button class="w-full mt-6 bg-black text-white py-2 rounded-xl hover:bg-gray-800 transition">
                        Sign In
                    </button>

                    <div class="flex items-center my-6">
                        <div class="flex-grow border-t"></div>
                        <span class="px-3 text-gray-500 text-sm">or</span>
                        <div class="flex-grow border-t"></div>
                    </div>

                    <p class="text-center text-sm text-gray-600 mt-6">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-black font-medium hover:underline">
                            Register
                        </a>
                    </p>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
