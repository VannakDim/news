<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Laravel\Pail\ValueObjects\Origin\Console;

use function Laravel\Prompts\alert;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::latest()->paginate(5);
        $trash = Team::onlyTrashed()->latest();
        return view('admin.team.index', compact('teams', 'trash'));
    }

    public function get_team($id)
    {
        $team = Team::find($id);
        return response()->json([
            'status' => 200,
            'message' => 'data dilivery success',
            'team' => $team
        ]);
    }

    public function store(Request $request)

    {
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|unique:teams',
            'phone' => 'nullable|unique:teams',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ]);

        $image= $request->file('image');
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/team/';
            $last_img = $up_location . $image_name;
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->cover(500,650);
            // Store the uploaded image
            $imagePath = $img->toJpeg(80)->save($last_img);
            $validatedData['image'] = $last_img;
        }

        // Create the user with the validated data
        $team = Team::create($validatedData);

        // Return a JSON response
        return response()->json([
            'message' => $request->hasFile('image')
                ? 'Data added successfully with image!'
                : 'Data added successfully without image!',
            'team' => $team
        ], 200);
    }

    public function update(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:25',
                'position' => 'required',
            ],
            [
                'name.required' => 'សូមបញ្ចូលឈ្មោះ',
            ]
        );

        if ($validated->fails()) {
            return response()->json(['error' => $validated->errors()->all()]);
        }

        $team = Team::find($request->id);
        if ($team) {
            $team->name = $request->name;
            $team->position = $request->position;
            $team->email = $request->email;
            $team->phone = $request->phone;
        }

        if ($image = $request->file('image')) {
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $img_ext;
            $up_location = 'image/team/';
            $last_img = $up_location . $image_name;
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->cover(500, 500);
            $img->toJpeg(80)->save($last_img);
            $old_image = $request->old_image;
            unlink($old_image);
            $team->image = $last_img;
        }

        $team->save();
        return response()->json([
            'status' => 200,
            'message' => 'Insert success',
        ]);
    }


    public function softDelete($id)
    {
        Team::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider has been moved to trash.');
    }
}
