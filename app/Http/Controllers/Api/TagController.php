<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    //
    public function index(){
        return Tag::all();
    }
    
    public function store(Request $request){
        $tag = Tag::create([
            'name' => $request->name,
        ]);
        return response()->json($tag,201);
    }

    public function show($id){
        return Tag::findOrFail($id);
    }

    public function update(Request $request,$id){
        $tag = Tag::findOrFail($id);
        $tag->update($request->all());
        return response()->json($tag,200);
    }

    public function destroy($id){
        Tag::findOrFail($id)->delete();
        return response()->json(null,204);
    }
}
