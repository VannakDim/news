<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class AboutController extends Controller
{
    public function about_item()
    {
        $item = AboutItem::all();
        return response()->json([
            'status' => 200,
            'item' => $item
        ]);
    }

    public function index(Request $request)
    {
        $abouts = About::first();
        if ($abouts) {
            $trash = About::onlyTrashed()->latest();
            return view('admin.about.index', compact('abouts', 'trash'));
        } else {
            return view('admin.about.add');
        }
    }

    public function add()
    {
        return view('admin.about.add');
    }

    public function edit($id)
    {
        $abouts = About::first();
        $items = AboutItem::all();
        return view('admin.about.edit', compact('abouts', 'items'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validated = Validator::make(
            $input,
            [
                'title' => 'required|max:50',
                'short_description' => 'required|max:150',
                'long_description' => 'required',
            ],
            [
                'title.required' => 'សូមបញ្ចូលឈ្មោះ',
            ]
        );

        if ($validated->fails()) {
            return response()->json(['error' => $validated->errors()->all()]);
        }

        $about = About::find($request->id);
        if ($about) {
            $image = $request->file('image');
            if ($image) {
                $old_image = $request->old_image;
                $name_gen = hexdec(uniqid());
                $img_ext = strtolower($image->getClientOriginalExtension());
                $image_name = $name_gen . '.' . $img_ext;
                $up_location = 'image/about/';
                $last_img = $up_location . $image_name;
                $image->move($up_location, $image_name);
                unlink($old_image);
                $about->image = $last_img;
            }
            $about->title = $request->title;
            $about->short_description = $request->short_description;
            $about->long_description = $request->long_description;
            $about->more_description = $request->more_description;
            $about->save();
            return Redirect()->route('all.about')->with('success', 'About updated successfull!');
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title' => 'required|max:50',
                'short_description' => 'required|max:150',
                'long_description' => 'required',
                'image' => 'required|max:2048',
            ],
            [
                'title.required' => 'សូមបញ្ចូលឈ្មោះ',
            ]
        );
        $image = $request->file('image');
        if ($image) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/about/';
            $last_img = $up_location . $image_name;
            $image->move($up_location, $image_name);

            About::insert([
                'image' => $last_img,
                'title' => $request->title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'more_description' => $request->more_description,
                'created_at' => Carbon::now()

            ]);

            return Redirect()->route('all.about')->with('success', 'About updated successfull!');
        }
    }
}
