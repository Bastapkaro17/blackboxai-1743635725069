<?php

namespace App\Helpers;

use App\Models\User;

class ReviewHelper
{
    public static function generateReviewUrl(User $user)
    {
        return url("/review/{$user->username}");
    }

    public static function getGoogleReviewUrl(User $user)
    {
        $businessName = urlencode($user->business_name);
        return "https://search.google.com/local/writereview?placeid={PLACE_ID}&text={$businessName}";
    }

    public static function formatRating($rating)
    {
        return number_format($rating, 1) . '/5';
    }

    public static function getStarRatingHtml($rating)
    {
        $html = '';
        $fullStars = floor($rating);
        $hasHalfStar = ($rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);

        for ($i = 0; $i < $fullStars; $i++) {
            $html .= '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>';
        }

        if ($hasHalfStar) {
            $html .= '<svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <defs>
                    <linearGradient id="half-star" x1="0" x2="100%" y1="0" y2="0">
                        <stop offset="50%" stop-color="currentColor"/>
                        <stop offset="50%" stop-color="#D1D5DB"/>
                    </linearGradient>
                </defs>
                <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>';
        }

        for ($i = 0; $i < $emptyStars; $i++) {
            $html .= '<svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>';
        }

        return $html;
    }
}