@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="d-flex justify-content-center align-items-center bg-light" style="min-height: 100vh;">
    <div class="card border-0 shadow-sm rounded-4 p-4" style="width: 100%; max-width: 460px;">

        {{-- Title --}}
        <h2 class="fw-bold text-center mb-4">Login Form</h2>

        {{-- Tab Toggle --}}
        <div class="d-flex rounded-3 overflow-hidden border mb-4">
            <a href="{{ route('login') }}"
               class="btn fw-semibold flex-fill rounded-0 btn-light py-3 text-dark">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="btn fw-semibold flex-fill rounded-0 btn-primary py-3">
                Signup
            </a>
        </div>

        {{-- Form --}}
        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="mb-3">
                <input type="text"
                       name="name"
                       class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                       placeholder="Full Name"
                       value="{{ old('name') }}"
                       required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <input type="email"
                       name="email"
                       class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                       placeholder="Email Address"
                       value="{{ old('email') }}"
                       required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <input type="password"
                       name="password"
                       class="form-control form-control-lg rounded-3 @error('password') is-invalid @enderror"
                       placeholder="Password"
                       required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4">
                <input type="password"
                       name="password_confirmation"
                       class="form-control form-control-lg rounded-3"
                       placeholder="Confirm Password"
                       required>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="btn btn-primary w-100 py-3 fw-semibold rounded-3 fs-5">
                Signup
            </button>

        </form>

        {{-- Bottom link --}}
        <p class="text-center text-muted mt-4 mb-0">
            Already a member?
            <a href="{{ route('login') }}" class="text-primary fw-semibold">Login now</a>
        </p>

    </div>
</div>

@endsection