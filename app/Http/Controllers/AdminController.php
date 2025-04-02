<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalReviews' => Review::count(),
            'averageRating' => Review::avg('rating'),
            'newUsers' => User::whereDate('created_at', today())->count(),
            'newReviews' => Review::whereDate('created_at', today())->count()
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
                  ->orWhere('business_name', 'like', '%'.$request->search.'%');
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function reviews(Request $request)
    {
        $query = Review::with('user');

        if ($request->has('rating')) {
            $query->where('rating', $request->rating);
        }

        if ($request->has('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('business_name', 'like', '%'.$request->search.'%');
            })->orWhere('comment', 'like', '%'.$request->search.'%');
        }

        $reviews = $query->latest()->paginate(20);

        return view('admin.reviews', compact('reviews'));
    }

    public function toggleUserStatus(User $user)
    {
        $user->update(['deleted_at' => $user->deleted_at ? null : now()]);
        return back()->with('success', 'User status updated');
    }

    public function toggleReviewStatus(Review $review)
    {
        $review->update(['is_approved' => !$review->is_approved]);
        return back()->with('success', 'Review status updated');
    }

    public function deleteReview(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted');
    }
}