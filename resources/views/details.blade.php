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
                

                <div class="mt-8 bg-white  dark:bg-gray-800  shadow ">

                    <div class="w-full">
                       <div class="p-4 h-2/4 w-3/4 grid grid-cols-2">
                            <div class="">
                                <img src="/images/{{$recipe->image}}" class="object-cover h-3/3 w-full shadow-lg border-2 border-gray-400">
                            </div>
                            <div>
                                <p class="font-bold text-4xl mx-6">{{$recipe->name}}</p>
                                <p class="text-gray-700 text-lg my-4 mx-6 w-full">{{$recipe->description}}</p>
                            </div>
                       </div>
                       <div class="p-4 h-2/4 w-full flex">
                            <div class="w-2/5">
                                <p class="font-bold text-2xl border-b-2 pb-2 border-gray-200">Ingredients</p>
                                <ul class="list-inside list-disc">
                                    @foreach($recipe->ingredients as $ingredient)
                                        <li class="text-gray-700 text-lg my-3 mx-6 w-full">{{$ingredient->ingredients}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="w-2/5">
                                <p class="font-bold text-2xl mx-6 border-b-2 w-full pb-2 border-gray-200">Cooking Process</p>
                                <ul class="list-outside list-decimal mx-10">
                                    @foreach($recipe->steps as $step)
                                        <li class="text-gray-700 text-lg my-3 mx-10 w-full px-4 font-bold"><span class="font-light ">{{$step->steps}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                       </div>
                       
                        
                    </div>
                </div>
                
                
            </div>
        </div>
    </body>
</html>
