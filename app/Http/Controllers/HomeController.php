<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Contact;
use App\Models\ProductCategory;
use App\Models\ProductModel;
use App\Models\Services;
use App\Models\StockInDetail;
use App\Models\StockOutDetail;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $data = ProductModel::with('brand')->get()->map(function ($model) {
            $stockIn = StockInDetail::where('product_model_id', $model->id)->sum('quantity');
            $stockOut = StockOutDetail::where('product_model_id', $model->id)->sum('quantity');
            return [
                'id' => $model->id,
                'model_name' => $model->name,
                'frequency' => $model->frequency,
                'type' => $model->type,
                'image' => $model->image,
                'category' => $model->category->name,
                'brand_name' => $model->brand->brand_name,
                'available_stock' => $stockIn - $stockOut,
            ];
        });
        $category = ProductCategory::all();
        $about = About::first();
        $services = Services::all();
        return view('frontend.index',compact('about','services','data','category'));
    }
    public function blog(){
        $posts = Post::where('status',"public")->get()->sortByDesc('created_at');
        return view('frontend.blog',compact('posts'));
    }
    public function singleblog($id){
        $post = Post::find($id);
        return view('frontend.singleblog',compact('post'));
    }

    public function about(){
        $about = About::first();
        $teams = Team::all()->sortBy('order');
        return view('frontend.about',compact('about','teams'));
    }

    public function contact(){
        $contact = Contact::all();
        return view('frontend.contact',compact('contact'));
    }
}
