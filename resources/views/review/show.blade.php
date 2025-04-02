@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-4 px-2 sm:px-4">
    <div class="w-full mx-2 bg-white rounded-lg shadow-sm sm:mx-auto sm:max-w-md">
        <div class="p-8">
            <div class="flex flex-col items-center mb-8">
                @if($user->logo_path)
                    <img src="{{ Storage::url($user->logo_path) }}" 
                        alt="{{ $user->business_name }} Logo" 
                        class="h-24 w-24 rounded-full object-cover mb-4">
                @endif
                <h1 class="text-2xl font-bold text-gray-800">{{ $user->business_name }}</h1>
                <p class="text-gray-600">Please leave your review</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('review.store') }}" id="reviewForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="google_review_url" id="googleReviewUrl" value="{{ $user->google_review_url }}">

                <!-- Rating Stars -->
                <div class="mb-6">
                <div class="flex justify-center">
                    <div class="inline-flex space-x-1">
                        @for($i = 5; $i >= 1; $i--)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" 
                                class="hidden peer/star{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                            <label for="star{{ $i }}" 
                                class="text-3xl cursor-pointer peer-checked/star{{ $i }}:text-yellow-400 text-gray-300 hover:text-yellow-400">
                                ★
                            </label>
                        @endfor
                    </div>
                </div>
                    @error('rating')
                        <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Comment -->
                <div class="mb-6" id="commentField">
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review (Optional)</label>
                    <textarea id="comment" name="comment" rows="3"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                        placeholder="Share your experience...">{{ old('comment') }}</textarea>
                </div>

                <!-- Feedback Form (Hidden by default) -->
                <div class="mb-6 hidden" id="feedbackField">
                    <label for="feedback" class="block text-sm font-medium text-gray-700 mb-2">What could we improve?</label>
                    <textarea id="feedback" name="feedback" rows="3"
                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"
                        placeholder="Please share your feedback..."></textarea>
                </div>

                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Review
                </button>
            </form>

            <script>
                document.getElementById('reviewForm').addEventListener('submit', function(e) {
                    const rating = document.querySelector('input[name="rating"]:checked')?.value;
                    const googleReviewUrl = document.getElementById('googleReviewUrl').value;
                    
                    if (rating >= 4 && googleReviewUrl) {
                        // Open Google review in new tab
                        window.open(googleReviewUrl, '_blank');
                    }
                });

                // Toggle between comment and feedback fields based on rating
                document.querySelectorAll('input[name="rating"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const rating = this.value;
                        if (rating <= 3) {
                            document.getElementById('commentField').classList.add('hidden');
                            document.getElementById('feedbackField').classList.remove('hidden');
                        } else {
                            document.getElementById('commentField').classList.remove('hidden');
                            document.getElementById('feedbackField').classList.add('hidden');
                        }
                    });
                });
            </script>

            @if(session('feedback_form'))
                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">We appreciate your feedback</h3>
                    <p class="text-gray-600 mb-4">We're sorry to hear about your experience. Please help us improve by sharing more details.</p>
                    
                    <form>
                        <div class="mb-4">
                            <label for="feedback" class="block text-sm font-medium text-gray-700">What could we do better?</label>
                            <textarea id="feedback" name="feedback" rows="3"
                                class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                        </div>
                        <button type="button"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Send Feedback
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection