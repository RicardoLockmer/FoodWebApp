<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Food Web App</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">


    </head>
    <body class="antialiased">
    <div class="flex justify-end items-center w-full bg-red-500 h-16">
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
        <div class="  min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            
                <div  class="flex justify-end  px-6 py-6 ">
                   
                </div>
            

            <div class="w-5/6 mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center text-4xl font-bold pt-8 sm:justify-start sm:pt-0 border-b-4 p-2 border-gray-200">
                    <h1>Food Web App</h1>
                </div>

                <div class="mt-8 bg-white  dark:bg-gray-800  shadow ">

                    <div class="grid grid-cols-2 md:grid-cols-2 ">
                        @foreach($recipes as $recipe)
                        <div class="border border-2 grid grid-cols-2">

                            <div class="p-2 w-full">
                            <a href="/details/{{$recipe->id}}">
                                <img src="/images/{{$recipe->image}}" class="object-scale-down h-48 w-full">
                            </a>
                            </div>
                            <div class="p-2 ">
                                <a href="/details/{{$recipe->id}}" class="font-bold text-xl">{{$recipe->name}}</a>
                                <p class="pt-3 text-gray-700 line-clamp-5">{{$recipe->description}}{{$recipe->description}}</p>
                            </div>
                            
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                {{ $recipes->links() }}
                
            </div>
        </div>
    </body>
</html>
