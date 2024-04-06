@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ __('Dashboard') }}</span>
                <div>
                @if (Auth::user()->profile_image)
                    <img src="{{ asset('storage/images/profile/' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                @else
                    <!-- Placeholder image or default avatar -->
                    <img src="{{ asset('path_to_default_avatar_image') }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                @endif
                </div>
            </div>


                <div class="card-body">
                    <h1>Welcome to User Dashboard</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
