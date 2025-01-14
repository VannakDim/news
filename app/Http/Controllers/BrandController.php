<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{

    
    public function index(){
        $brands = Brand::latest()->paginate(5);
        $trashCat = Brand::onlyTrashed()->latest()->paginate(3);
        return view('admin.brand.index',compact('brands','trashCat'));
    }
    public function edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }
    public function update(Request $request, $id){
        $validated = $request->validate([
            'brand_name' => 'required|max:25',
            'brand_image' => 'mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required'=>'សូមបញ្ចូលឈ្មោះ brand',
            'brand_image.required'=>'សូមបញ្ចូលរូបភាព brand',
        ]);

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');
        if($brand_image){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_gen .'.'. $img_ext;
            $up_location = 'image/brand/';
            $last_img = $up_location.$image_name;
            $brand_image->move($up_location,$image_name);
            unlink($old_image);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'user_id' => Auth::user()->id,
            ]);
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'user_id' => Auth::user()->id,
            ]);
        }
        
        return Redirect()->back()->with('success','Brand updated successfull!');
    }

    
    public function store(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:25',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required'=>'សូមបញ្ចូលឈ្មោះ brand',
            'brand_image.required'=>'សូមបញ្ចូលរូបភាព brand',
        ]);


        $brand_image = $request->file('brand_image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen .'.'. $img_ext;
        $up_location = 'image/brand/';
        $last_img = $up_location.$image_name;
        $brand_image->move($up_location,$image_name);

        Brand::insert([
            'brand_name'=> $request->brand_name,
            'brand_image'=> $last_img,
            'user_id'=> Auth::user()->id,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->back()->with('success','Brand inserted successfull.' );
    }

    public function softDelete($id){
        $delete = Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand has been moved to trash.');
    }
}
