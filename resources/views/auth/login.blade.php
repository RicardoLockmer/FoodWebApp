<x-guest-layout>

    <div class="grid grid-cols-2 content-center w-full bg-red-500 h-16">
            <div class="justify-self-start flex ">
                <div class="hidden self-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link  href="/" :active="request()->routeIs('dashboard')">
                     <div class="text-white">
                        {{ __('FoodWebApp') }}
                     </div>
                    </x-jet-nav-link>
                </div>
            </div>
            <div  class="flex justify-self-end">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-md text-white font-bold self-align-center mx-2">My Recipes</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white font-bold mx-6">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                @else
                    <a href="{{ route('login') }}" class="text-md text-white font-bold underline mx-2">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-md text-white font-bold underline mx-6">Register</a>
                    @endif
                @endauth
            </div>
    </div>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <div class="text-3xl">
           <strong>
                FOOD WEB APP LOGO
           </strong> 
        </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end mt-4">
            
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Register an Account') }}
                </a>
               
                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
