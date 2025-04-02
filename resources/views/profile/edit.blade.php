@extends('layouts.app')

@section('content')
<div class="py-6 px-2 sm:px-4">
    <div class="w-full mx-auto sm:px-4">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Business Profile Setup</h2>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-4">
                        <!-- Business Name -->
                        <div>
                            <label for="business_name" class="block text-sm font-medium text-gray-700 mb-1">Business Name</label>
                            <input type="text" name="business_name" id="business_name" 
                                value="{{ old('business_name', $user->business_name) }}"
                                class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                required>
                            @error('business_name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo Upload -->
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Business Logo</label>
                            <div class="flex items-center space-x-4">
                                @if($user->logo_path)
                                    <img src="{{ Storage::url($user->logo_path) }}" 
                                        alt="Business Logo" 
                                        class="h-16 w-16 rounded-full object-cover">
                                @endif
                                <input type="file" name="logo" id="logo" 
                                    class="block w-full text-base text-gray-500
                                    file:mr-4 file:py-3 file:px-4
                                    file:rounded-md file:border-0
                                    file:text-base file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700
                                    hover:file:bg-indigo-100">
                            </div>
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Google Review URL -->
                        <div>
                            <label for="google_review_url" class="block text-sm font-medium text-gray-700 mb-1">Google Review Link</label>
                            <input type="url" name="google_review_url" id="google_review_url" 
                                value="{{ old('google_review_url', $user->google_review_url) }}"
                                class="block w-full px-4 py-3 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                placeholder="https://search.google.com/local/writereview?placeid=...">
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full sm:w-auto flex justify-center py-3 px-6 bg-indigo-600 border border-transparent rounded-md font-medium text-base text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection