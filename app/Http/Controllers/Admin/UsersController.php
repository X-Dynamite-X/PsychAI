<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};

class UsersController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::query();


            if ($request->has('search')) {
                $searchTerm = $request->search;
                $query->whereAny(['name', 'email'], 'like', "%{$searchTerm}%");
            }

            // إذا كان الطلب للحصول على مستخدم جديد بعد الحذف
            if ($request->get('get_next_user')) {
                $currentPage = $request->get('current_page', 1);
                $offset = ($currentPage * 10); // نحسب الـ offset بناءً على الصفحة الحالية

                $nextUser = $query->skip($offset - 1)->first();

                if ($nextUser) {
                    return response()->json([
                        'success' => true,
                        'new_user_html' => view('partials.users.user-row', ['user' => $nextUser])->render()
                    ]);
                }

                return response()->json(['success' => true]);
            }

            $users = $query->select(['id', 'name', 'email', 'created_at'])
                ->paginate(10);

            if ($request->has('search')) {
                return response()->json([
                    'html' => view('partials.users.users-table', ['users' => $users])->render(),
                    'pagination' => view('partials.users.pagination', ['users' => $users])->render()
                ]);
            }

            return view('partials.users.users-table', ['users' => $users]);
        }

        // للطلبات غير Ajax
        $users = User::paginate(perPage: 10);
         return view('admin.users', ['users' => $users]);
    }


    public function update(Request $request, User $user)
    {
         $validated = $request->validate(rules: [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        $user->syncRoles($request->role);
        $user->update( $validated);
        $user->save();
        $user->load('roles');
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        }

        return redirect()->back()->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        if (request()->ajax()) {
            return response()->json([
                'success' => true
            ]);
        }

        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
