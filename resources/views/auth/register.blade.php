<x-guest-layout>

    <!-- FULLSCREEN CONTAINER -->
    <div class="min-h-screen w-full flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-[1000px] bg-white shadow-xl rounded-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden min-h-[550px]">

        <!-- LEFT SIDE — FULL BACKGROUND FOTO -->
        <div class="relative flex items-end md:items-center justify-start p-10
                    bg-cover bg-center bg-no-repeat"
             style="background-image: url('{{ asset('assets/foto/loginFoto.jpg') }}');">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/35"></div>

            <!-- Text -->
            <div class="relative z-10 text-white max-w-md mb-10 md:mb-0">
                <h2 class="text-4xl font-bold leading-tight mb-4">
                    Dress Different,<br>Live Confident
                </h2>

                <p class="opacity-90 text-sm leading-relaxed">
                    Mulai perjalananmu dengan gaya unik yang ramah kantong namun tetap standout.
                </p>
            </div>
        </div>

        <!-- RIGHT SIDE — FORM FULL HEIGHT -->
        <div class="flex items-center justify-center p-10 bg-white">

            <div class="w-full max-w-md">

                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <img src="{{ asset('assets/logo/thriftsy.png') }}" class="h-16">
                </div>

                <h2 class="text-center text-2xl font-semibold mb-8 text-gray-700">
                    Create Your Account
                </h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Name</label>
                        <input id="name" name="name" type="text" required autofocus
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm
                                      focus:ring-black focus:border-black"
                               value="{{ old('name') }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm
                                      focus:ring-black focus:border-black"
                               value="{{ old('email') }}">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm
                                      focus:ring-black focus:border-black">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Confirm -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="mt-1 w-full border-gray-300 rounded-lg shadow-sm
                                      focus:ring-black focus:border-black">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>

                    <!-- Register Button -->
                    <button class="w-full mt-4 bg-black text-white py-3 rounded-xl
                                   hover:bg-gray-800 transition text-lg">
                        Register
                    </button>

                    <!-- Link -->
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-black font-medium hover:underline">
                            Login
                        </a>
                    </p>
                </form>

            </div>
        </div>

    </div>

</x-guest-layout>
