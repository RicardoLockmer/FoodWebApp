<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use App\Models\Recipe;
use App\Models\Steps;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = auth()->user()->recipes;
        return view('dashboard', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $stepsData = json_decode($request->steps);
        $ingredientsData = json_decode($request->ingredientes);
        $recipeValidation = request()->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'image' => 'required',
            'steps' => 'required',
            'ingredientes' => 'required'
        ]);
                
        try{
        $recipe = new Recipe();
        $recipe->name = $request->nombre;
        $recipe->description = $request->descripcion;
        $ext = pathinfo($request->fileName, PATHINFO_EXTENSION);
        $newFileName = date('dmyhms').'.'.$ext;
        $request->image->move(public_path('/images'), $newFileName);
        $recipe->image = $newFileName;
        $recipe->user_id = Auth::user()->id;
        $recipe->save();
        
        foreach($ingredientsData as $ingredients){
            $newIngredients = new Ingredients();
            $newIngredients->ingredients = $ingredients;
            $newIngredients->recipe_id = $recipe->id;
            $newIngredients->save();
        }
        foreach($stepsData as $step){
            $newSteps = new Steps();
            $newSteps->steps = $step;
            $newSteps->recipe_id = $recipe->id;
            $newSteps->save();
        }
        

    } catch(\Illuminate\Database\QueryException $e) {
        return back()->withErrors(['ERROR', 'The Message']);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        // direct to edit page
        if(auth()->user()->id == $recipe->user_id){
            return view('edit', compact('recipe'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
        
        try {


            $recipe->name = $request->nombre;
            $recipe->description = $request->descripcion;
    
            if($request->image){
                $fileName = $request->file('image')->getClientOriginalName();
                
                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = date('dmyhms').$ext;
                $request->image->move(public_path('/images'), $newFileName);
                $recipe->image = $newFileName;
    
            }
    
            foreach($request->ingredientes as $index => $ingredient){

                if($ingredient != NULL){

                    if(isset($recipe->ingredients[$index])){
                        $recipe->ingredients[$index]->ingredients = $ingredient;
                        $recipe->update();
                    } else {
                        $newIngredient = new Ingredients();
                        $newIngredient->ingredients = $ingredient;
                        $newIngredient->recipe_id = $recipe->id;
                        $newIngredient->save();
                    }

                }else {
                    $recipe->ingredients[$index]->delete();
                }
                    
            }
            foreach($request->steps as $index => $step){
                if($step != NULL){
                    if(isset($recipe->steps[$index])){
                        $recipe->steps[$index]->steps = $step;
                        $recipe->update();

                    } else {
                        $newStep = new Steps();
                        $newStep->steps = $step;
                        $newStep->recipe_id = $recipe->id;
                        $newStep->save();
                    }
                } else {
                    $recipe->steps[$index]->delete();
                }
            }
            $recipe->update();
        } catch(\Illuminate\Database\QueryException $e) {
            return back()->withErrors(['ERROR', 'The Message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return back();
    }
}
