<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        return Category::all();
    }
    
    public function store(Request $request){
        $category = Category::create($request->all());
        return response()->json($category,201);
    }

    public function show($id){
        return Category::findOrFail($id);
    }

    public function update(Request $request,$id){
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category,200);
    }

    public function destroy($id){
        Category::findOrFail($id)->delete();
        return response()->json(null,204);
    }
}
