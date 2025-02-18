<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Category;
use App\Models\PostImage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::where('status', 'public')->get()->sortByDesc('created_at');
        $posts = Post::all()->sortByDesc('created_at');
        return view('admin.post.index', compact('posts'));
    }
    public function page_add()
    {
        $tags = Tag::all();
        return view('admin.post.add', compact('tags'));
    }
    public function page_edit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();

        return view('admin.post.edit', compact('post', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'string|max:50',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50',
            'description' => 'required',
            'content' => 'nullable',
            'status' => 'required',
            'is_featured' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'audio' => 'nullable|mimes:mp3,wav',
            'video' => 'nullable|mimes:mp4,avi,mkv',
        ]);
        // Create or fetch tags
        $category = collect($validated['categories'])->map(function ($categoryName) {
            return Category::firstOrCreate(['name' => $categoryName])->id;
        });
        // Create or fetch tags
        $tags = collect($validated['tags'])->map(function ($tagName) {
            return Tag::firstOrCreate(['name' => $tagName])->id;
        });
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = $request->status;
        $post->content = $request->content;
        $post->is_featured = $request->featured ? 1 : 0;
        $post->user_id = Auth::user()->id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/post/'), $name_gen);
            $post->image = 'image/post/' . $name_gen;
            // Simulate a long process (e.g., 5 seconds)
            sleep(1);
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio');
            $audioName = time() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path('audios/post/'), $audioName);
            $post->audio = $audioName;
        }

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('videos/post/'), $videoName);
            $post->video = $videoName;
        }

        $post->save();

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);

                // Save each image to the PostImage table
                PostImage::create([
                    'post_id' => $post->id,
                    'image' => $imageName,
                ]);
            }
        }

        $post->categories()->sync($category);
        $post->tags()->sync($tags);

        return response()->json(['message' => 'Post created successfully.']);
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required',
                'status' => 'required',
                'categories' => 'required|array',
                'categories.*' => 'string|max:50',
                'tags' => 'required|array',
                'tags.*' => 'string|max:50',
                'description' => 'required',
                'content' => 'nullable',
                'is_featured' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|max:102400', // Max size 100MB
            ]);

            // Create or fetch categories
            $category = collect($validated['categories'])->map(function ($categoryName) {
                return Category::firstOrCreate(['name' => $categoryName])->id;
            });

            // Create or fetch tags
            $tags = collect($validated['tags'])->map(function ($tagName) {
                return Tag::firstOrCreate(['name' => $tagName])->id;
            });

            $post = Post::find($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->status = $request->status;
            $post->content = $request->content;
            $post->is_featured = $request->featured ? 1 : 0;
            $post->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('image/post/'), $name_gen);
                $post->image = 'image/post/' . $name_gen;
            }


            if ($request->hasFile('audio')) {
                $audio = $request->file('audio');
                $name_gen = hexdec(uniqid()) . '.' . $audio->getClientOriginalExtension();
                $audio->move(public_path('audios/post/'), $name_gen);
                $post->audio = 'audios/post/' . $name_gen;
            }

            if ($request->has('video')) {
                $post->video = $request->video;
            }

            // Handle additional images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = time() . '-' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);

                    // Save each image to the PostImage table
                    PostImage::create([
                        'post_id' => $post->id,
                        'image' => $imageName,
                    ]);
                }
            }

            $post->save();
            $post->categories()->sync($category);
            $post->tags()->sync($tags);

            return response()->json(['message' => 'Post updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function softDelete($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
