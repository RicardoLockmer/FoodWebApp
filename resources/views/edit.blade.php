<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            
                <form method="POST" action="/update/{{$recipe->id}}" enctype="multipart/form-data" id="recipeLogic"  class="mx-4">
                    @method('PUT')
                    @csrf
                    <div class="form-group ">
                    <label for="name" class="block font-bold">Recipe Name</label>
                        <input name="nombre" id="name" value="{{$recipe->name}}" class="shadow-md rounded border border-gray-300 w-2/5 h-5 my-2 py-4 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" >
                        @if ($errors->has('nombre'))
                            <span class="text-danger">{{ $errors->first('nombre') }}</span>
                        @endif
                        <label for="description" class="block font-bold">Brief Description</label>
                        <textarea name="descripcion" id="description" class="shadow-md rounded border border-gray-300 leading-normal my-2 w-2/5 h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white">{{$recipe->description}}</textarea>  
                        @if ($errors->has('descripcion'))
                            <span class="text-danger">{{ $errors->first('descripcion') }}</span>
                        @endif
                        
                        <label for="photo" class="block font-bold">Thumbnail Image</label>
                        <div class=" flex items-center  h-44">
                        <label for="photo" class="grid grid-cols-1 place-items-center rounded border border-gray-300 cursor-pointer w-1/5 shadow-md h-20 my-2 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white " >
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                    class="h-10 w-10" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor">
                                <path stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                        </label>
                            <input type="file"  v-on:change="onFileChange" name="image" id="photo" class="hidden">  
                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                            
                            <img v-if="thumbnailPreview" :src="thumbnailPreview"  class="w-40 h-40 object-contain mx-4">
                            <img v-else src="/images/{{$recipe->image}}"  class="w-40 h-40 object-contain mx-4">
                            
                        </div>
                    </div>
                    
                    <label for="ingredients" class="block mt-4 font-bold">Ingredients</label>
                    <ul class="list-disc list-outside" id="ingredientList">
                        @foreach($recipe->ingredients as $index => $ingredient)
                        <li>
                            <input name="ingredientes[{{$index}}]" id="ingredients" value="{{$ingredient->ingredients}}" class="shadow-md rounded border border-gray-300 w-2/5 h-5 my-2 py-4 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" >
                                @if ($errors->has('ingredientes[index]'))
                                    <span class="text-danger">{{ $errors->first('ingredientes[index]') }}</span>
                                @endif
                        </li>
                        @endforeach
                    </ul>
                    
                    <button v-on:click.prevent="onEditIngredient" class="bg-green-500 my-4 w-2/6 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Add 1 more Ingridient Item</button>


                    <label for="process" class="block font-bold ">Process Steps</label>
                    <ul class="list-decimal list-outside" id="stepList">
                        @foreach($recipe->steps as $index => $step)
                        <li>
                            <input name="steps[{{$index}}]" id="process" value="{{$step->steps}}" class="shadow-md rounded border border-gray-300 w-2/5 h-5 my-2 py-4 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" >
                                @if ($errors->has('steps[index]'))
                                    <span class="text-danger">{{ $errors->first('steps[index]') }}</span>
                                @endif
                        </li>
                        @endforeach
                        
                    </ul>
                    <button v-on:click.prevent="onEditStep({{count($recipe->steps)}})" class="bg-green-500 my-4 w-2/6 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Add 1 more Step</button>


                    <div class="form-group">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                    </div>
                    
                
                </form>
            </div>
        </div>
    </div>
    <script src="/scripts/recipe.js"></script>
    <script src="/scripts/editRecipe.js"></script>
</x-app-layout>
