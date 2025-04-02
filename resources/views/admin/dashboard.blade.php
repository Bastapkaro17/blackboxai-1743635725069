@extends('layouts.app')

@section('content')
<div class="py-4 px-2 sm:px-4">
    <div class="w-full mx-auto">
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
                    <!-- Total Users -->
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
                                <p class="text-2xl font-bold">{{ $stats['totalUsers'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Reviews -->
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Total Reviews</h3>
                                <p class="text-2xl font-bold">{{ $stats['totalReviews'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Average Rating -->
                    <div class="bg-green-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">Avg. Rating</h3>
                                <p class="text-2xl font-bold">{{ number_format($stats['averageRating'], 1) }}/5</p>
                            </div>
                        </div>
                    </div>

                    <!-- New Today -->
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">New Today</h3>
                                <p class="text-2xl font-bold">{{ $stats['newUsers'] }} users, {{ $stats['newReviews'] }} reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 mb-6">
                    <a href="{{ route('admin.users') }}" class="bg-white p-4 rounded-lg border border-gray-200 hover:border-indigo-500 transition">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Manage Users</h3>
                        <p class="text-gray-600">View, edit, and manage all user accounts</p>
                    </a>
                    <a href="{{ route('admin.reviews') }}" class="bg-white p-6 rounded-lg border border-gray-200 hover:border-indigo-500 transition">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Manage Reviews</h3>
                        <p class="text-gray-600">Moderate and filter customer reviews</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection