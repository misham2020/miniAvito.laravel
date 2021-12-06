<?php

namespace App\AdsRepository;

use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdsRepository
{
    public function addAds($request)
    {
        $ads = new Ads();
        $title = $request->title;
        $cost = $request->cost;
        $user = Auth::user()->id;
        $ads->create([
            'title' => $title,
            'cost' => $cost,
            'user_id' => $user
        ]);
        $ads_id = DB::getPdo()->lastInsertId();
        return $ads_id;
    }
    public function addCatigory($request, $ads_id)
    {
        $category = $request->category;
        foreach ($category as $key => $value)
        {
        DB::table('ads_category')->insert([
            'category_id' => $value,
            'ads_id' => $ads_id,
         ]);
        }
    }
    public function addImg($request, $ads_id)
    {
        if($request->hasFile('images')) {
			$images = $request->file('images');
        }
        foreach ($images as $image) {
        $img = new image();
        $image = $image->getClientOriginalName();
        $img->create([
            'path' => $image,
            'ads_id' => $ads_id
        ]); 
    }
    }
    public function listsCategory()
    {
        $lists = Category::select(['title','id'])
        ->get()
        ->reduce(function ($carry, $item) {
              $carry[$item->id] = $item->title;
              return $carry;
        }, []);
        return $lists;
    }
}