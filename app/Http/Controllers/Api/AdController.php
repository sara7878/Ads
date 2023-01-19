<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\StoreAdRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Advertiser;
use App\Jobs\SendAdvertiserEmail;
use App\Mail\AdvertiserEmail;
use Illuminate\Support\Facades\Mail;

class AdController extends Controller
{
    //
    public function index(){
        $ads = Ad::All();
        return $ads;
    }
    
    public function filterAds(Request $request){
        $tag = $request->tag;
        $category= $request->category;
        $ads = Ad::where('category_id', $category)->
        whereHas('tags', function ($query) use ($tag) {
            $query->where('name' , 'like' , "%". $tag ."%");
        })->get();

        return $ads;
    }
    public function advertiserAds(Request $request)
    {
        $advertiser_id = $request->advertiser_id;
        $ads = Ad::where('advertiser_id', $advertiser_id)->get();
        return response()->json($ads);
    }

    public function store(StoreAdRequest $request){
        $ad = Ad::create($request->all());
        $ad->tags()->attach($request->tags);
        $advertiser= Advertiser::where('id',$request->advertiser_id)->first();
        // Mail::to($advertiser->email)->send(new AdvertiserEmail($ad));
        // dispatch(new SendAdvertiserEmail($advertiser,$ad));
        return response()->json($ad,201);
    }

    public function show($id){
        $ad = Ad::where('id','=',$id)->with(['category','tags' => function($query) {
            $query->select('name');
        }])->get()->map(function($ad) {
            return [
                'id' => $ad->id,
                'title' => $ad->title,
                'description' => $ad->description,
                'start_date' =>$ad->start_date,
                'category' => $ad->category,
                'tags' => $ad->tags->pluck('name')->toArray()
            ];
        });
        return $ad;
    }

    public function update(StoreAdRequest $request,$id){
        $ad = Ad::findOrFail($id);
        $ad->update($request->all());
        $ad->tags()->sync($request->tags);
        return response()->json($ad,200);
    }

    public function destroy($id){
        Ad::findOrFail($id)->delete();
        return response()->json(null,204);
    }

}
