@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0f172a, #111827);
    }

    .login-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255,255,255,0.08);
    }

    .form-control {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.08);
        color: white;
    }

    .form-control:focus {
        background: rgba(255,255,255,0.08);
        border-color: #3b82f6;
        box-shadow: none;
        color: white;
    }

    .form-control::placeholder {
        color: #cbd5e1;
    }

    .btn-login {
        background: linear-gradient(to right, #2563eb, #3b82f6);
        border: none;
    }

    .btn-login:hover {
        opacity: 0.9;
    }

    .tab-btn {
        transition: 0.3s;
    }

    .tab-btn:hover {
        opacity: 0.9;
    }
    .signup-btn {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
    }

    .signup-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(59, 130, 246, 0.45);
    opacity: 0.95;
    }

    .signup-btn:active {
    transform: scale(0.98);
    }
</style>

<div class="d-flex justify-content-center align-items-center min-vh-100 px-3">

    {{-- Smaller Height Card --}}
    <div class="login-card shadow-lg rounded-4 p-4 text-white"
         style="width: 100%; max-width: 380px;">

        {{-- Title --}}
        <h2 class="fw-bold text-center mb-1">
            Welcome Back
        </h2>

        <p class="text-center text-light opacity-75 small mb-4">
            Login to continue
        </p>

        {{-- Tabs --}}
        <div class="d-flex rounded-4 overflow-hidden mb-3 border border-secondary">

            <a href="{{ route('login') }}"
               class="btn btn-primary flex-fill rounded-0 py-2 fw-semibold tab-btn">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="btn btn-dark flex-fill rounded-0 py-2 fw-semibold text-light tab-btn">
                Signup
            </a>

        </div>

        {{-- Form --}}
        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <input type="email"
                       name="email"
                       class="form-control rounded-4 py-2 @error('email') is-invalid @enderror"
                       placeholder="Email Address"
                       value="{{ old('email') }}"
                       required>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-2">
                <input type="password"
                       name="password"
                       class="form-control rounded-4 py-2 @error('password') is-invalid @enderror"
                       placeholder="Password"
                       required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Forgot Password --}}
            <div class="text-end mb-3">
                <a href="{{ route('register') }}" class="text-info text-decoration-none small">
                    Forgot Password?
                </a>
            </div>

            {{-- Button --}}
            <button type="submit"
                class="btn w-100 py-2 fw-semibold rounded-4 text-white border-0 position-relative overflow-hidden signup-btn">
            <span class="position-relative z-1">
                Login
            </span>
            </button>

        </form>

        {{-- Footer --}}
        <p class="text-center mt-3 mb-0 text-light opacity-75 small">
            Don’t have an account?
            <a href="{{ route('register') }}"
               class="text-info text-decoration-none fw-semibold">
                Signup
            </a>
        </p>

    </div>

</div>

@endsection