<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        
        return view('review.show', [
            'user' => $user,
            'averageRating' => $user->average_rating,
            'reviewCount' => $user->reviews()->count()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $review = Review::create([
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'source_ip' => $request->ip()
        ]);

        // Handle different rating scenarios
        if ($request->rating <= 3) {
            return redirect()->back()
                ->with('feedback_form', true)
                ->with('success', 'Thank you for your feedback!');
        }

        // For positive reviews (4-5 stars), redirect to Google Reviews
        $businessName = urlencode($review->user->business_name);
        $googleReviewUrl = "https://search.google.com/local/writereview?placeid={PLACE_ID}&text={$businessName}";

        return redirect()->away($googleReviewUrl);
    }

    protected function generateGoogleReviewUrl($business)
    {
        // This would need to be implemented with actual Google Places API integration
        // For now, we'll return a generic Google review URL
        $businessName = urlencode($business->business_name);
        return "https://search.google.com/local/writereview?placeid={PLACE_ID}&text={$businessName}";
    }
}