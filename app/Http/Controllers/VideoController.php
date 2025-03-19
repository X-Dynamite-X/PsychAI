<?php

namespace App\Http\Controllers;

use App\Models\{Video, Category, CommantVideo};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with(['category', 'user'])->latest()->paginate(10);
        return view('video.index', compact('videos'));
    }
    public function category(Category $category)
    {
        $videos = $category->videos()->latest()->paginate(10);

        return view('video.index', compact('videos'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('video.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('videos', 'public');
            }

            $data['user_id'] = auth()->id();
            $video = Video::create($data);


            return redirect()->route('video.show', $video->id)
                ->with('success', 'تم إنشاء الفيديو بنجاح');
        } catch (\Exception $e) {
            // Clean up uploaded image if creation fails
            if (isset($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error creating video'
            ], 500);
        }
    }

    public function show(Video $video)
    {
        $video->load(['category', 'user']);
        $relatedVideos = Video::where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->limit(3)
            ->get();

        return view('video.show', compact('video', 'relatedVideos'));
    }

    public function edit(Video $video)
    {
        if (auth()->id() !== $video->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $categories = Category::all();
        return view('video.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        if (auth()->id() !== $video->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $validator->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($video->image) {
                    Storage::disk('public')->delete($video->image);
                }
                $data['image'] = $request->file('image')->store('videos', 'public');
            }

            $video->update($data);

            return redirect()->route('video.show', $video->id)
                ->with('success', 'تم تحديث الفيديو بنجاح');
        } catch (\Exception $e) {
            // Clean up newly uploaded image if update fails
            if (isset($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            return response()->json([
                'success' => false,
                'message' => 'Error updating video'
            ], 500);
        }
    }

    public function destroy(Video $video)
    {
        if (auth()->id() !== $video->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access'
            ], 403);
        }

        try {
            // Delete associated image if exists
            if ($video->image) {
                Storage::disk('public')->delete($video->image);
            }

            $video->delete();

            return redirect()->route('video.index')
                ->with('success', 'تم حذف الفيديو بنجاح');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting video'
            ], 500);
        }
    }
    public function storeComment(Request $request, Video $video ){
        $validator = Validator::make($request->all(), [
            'commant' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $commant = CommantVideo::create([
            'video_id' => $video->id,
            'user_id' => auth()->id(),
            'commant' => $request->commant,
        ]);
        return response()->json([
            'success' => true,
            'commant' => $commant,
        ]);

    }
}