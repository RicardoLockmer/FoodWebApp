<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
                <div class="border-b-2 border-gray-100 p-4  flex">
                    <div class="flex-auto text-2xl">
                        Your Recipes
                    </div>
                    <div class="flex-auto text-right mt-2">
                        <a href="/recipe" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add a new Recipe</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                <thead>
                <tr class="border-b">
                    <th class="text-left p-3 px-5">Recipe</th>
                   
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($recipes as $recipe)
                    <tr class="border-b hover:bg-orange-100">
                        <td class="p-3 px-5">
                            {{$recipe->name}}
                        </td>
                        <td class="p-3 px-5">
                            
                            <a href="/recipe/{{$recipe->id}}" name="edit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</a>
                            <form action="/recipe/{{$recipe->id}}" class="inline-block">
                                @csrf
                                <button type="submit" name="delete" formmethod="POST" class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                <div>
                    @foreach(auth()->user()->recipes as $recipe)
                        <h1>{{$recipe->nombre}}</h1>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
