<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\CommantArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * عرض المقالات مع التصفية حسب الفئة والبحث.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Article::query();

        // تصفية المقالات حسب الفئة
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $query->orderBy('created_at', 'desc');
        $articles = $query->with(['category', 'user'])->paginate(10);

        return view('articles.index', compact('articles', 'categories'));
    }
    public function category(Category $category)
    {
        $articles = $category->articles()->latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }
    /**
     * عرض صفحة إضافة مقال جديد.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    /**
     * تخزين مقال جديد.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('articles', 'public');
            }

            Article::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'image' => $imagePath,
                'user_id' => auth()->id(),
            ]);

            return redirect()->route('articles.index')
                ->with('success', 'تم إنشاء المقال بنجاح');

        } catch (\Exception $e) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()
                ->with('error', 'فشل في إنشاء المقال')
                ->withInput();
        }
    }

    /**
     * عرض مقال مفصل.
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function show(Article $article)
    {
        $article->load(['category', 'user']);
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * عرض صفحة تعديل المقال.
     *
     * @param Article $article
     * @return \Illuminate\View\View
     */
    public function edit(Article $article)
    {
        if (auth()->id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'غير مصرح لك بتعديل هذا المقال');
        }

        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }


    public function update(Request $request, Article $article)
    {
        if (auth()->id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'غير مصرح لك بتعديل هذا المقال');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category_id,
            ];

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($article->image) {
                    Storage::disk('public')->delete($article->image);
                }

                $data['image'] = $request->file('image')->store('articles', 'public');
            }

            $article->update($data);

            return redirect()->route('articles.show', $article)
                ->with('success', 'تم تحديث المقال بنجاح');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'فشل في تحديث المقال')
                ->withInput();
        }
    }

    public function destroy(Article $article)
    {
        if (auth()->id() !== $article->user_id) {
            return redirect()->route('articles.index')
                ->with('error', 'غير مصرح لك بحذف هذا المقال');
        }

        try {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            $article->delete();

            return redirect()->route('articles.index')
                ->with('success', 'تم حذف المقال بنجاح');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'فشل في حذف المقال');
        }
    }
    public function storeComment(Request $request , Article $article)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $comment = CommantArticle::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
        return response()->json([
            'success' => true,
            'comment' => $comment,
        ]);
    }
}