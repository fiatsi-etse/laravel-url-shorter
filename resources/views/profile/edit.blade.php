@extends('layouts.app')

@section('content')
<div class="container">
    <header>
        <h2 class="fw-semibold text-xl text-dark">
            {{ __('Profile')}}
        </h2>
    </header>

    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Update Profile Information Form -->
                    <div class="mb-3">
                        <h5>{{ __('Modifiez vos informations personnelles') }}</h5>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Update Password Form -->
                    <div class="mb-3">
                        <h5>{{ __('Modifiez votre mot de passe') }}</h5>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Delete User Form -->
                    <div class="mb-3">
                        <h5>{{__('Supprimez votre compte')}}</h5>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection