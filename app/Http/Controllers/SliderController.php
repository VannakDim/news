<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::all();
        $trash = Slider::onlyTrashed()->latest();
        return view('admin.slider.index',compact('sliders','trash'));
    }

    public function get_slider_data($id){
        $slider = Slider::find($id);
        return response()->json([
            'status' => 200,
            'message' => 'data dilivery success',
            'slider' => $slider
        ]);
    }

    public function update_slider(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input,[
            'title' => 'required|max:50',
            'image' => [
                        'image',
                        'mimes:jpg,png,jpeg,gif,svg',
                        'dimensions:min_width=100,min_height=100,max_width=19200,max_height=10800',
                        'max:6048'
                       ],
                      
        ],[
            'title.required'=>'សូមបញ្ចូលចំណងជើង',
            'image.required'=>'សូមបញ្ចូលរូបភាព',
        ]);
        if($validate->fails()){
            return response()->json(['error' => $validate->errors()->all()]);
        }
        $slider = Slider::find($request->id);
        if ($slider) {
            $image = $request->file('image');
            if($image){
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $image_name = $name_gen .'.'. $img_ext;
                $up_location = 'image/slider/';
                $last_img = $up_location.$image_name;
                $manager = new ImageManager(new Driver());
                $img = $manager->read($image);
                // $img->cover(1920,1080);
                $img->scale(width:1920);
                // $img = $img->resize(1920,1080);
                $img->toJpeg(80)->save($last_img);

                $slider->image= $last_img;
            }

            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->save();
            return response()->json([
                'status' => 200,
                'message' => 'Slider updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Slider not found'
            ]);
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:Sliders|max:25',
        ],
        [
            'title.required'=>'សូមបញ្ចូលឈ្មោះស្លាយ',
        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($image->getClientOriginalExtension());
        $image_name = $name_gen .'.'. $img_ext;
        $up_location = 'image/slider/';
        $last_img = $up_location.$image_name;
        $image->move($up_location,$image_name);

        Slider::insert([
            'title'=> $request->title,
            'description'=> $request->description,
            'image'=> $last_img,
            'created_at'=> Carbon::now()
        ]);
        return Redirect()->back()->with('success','Slider inserted successfull.' );
    }


    public function softDelete($id){
        Slider::find($id)->delete();
        return Redirect()->back()->with('success','Slider has been moved to trash.');
    }
}
