{{-- resources/views/auth/login.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite('resources/css/app.css')

    <style>
        body {
            background: radial-gradient(circle at top, #1b1b1b, #0a0a0a);
            font-family: Arial, Helvetica, sans-serif;
        }

        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .tab-active {
            background: linear-gradient(to right, #2563eb, #3b82f6);
            color: white;
        }

        .input {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            color: white;
            font-size: 14px;
        }

        .input:focus {
            border-color: #3b82f6;
            outline: none;
        }
    </style>
</head>

<body>

<div class="min-h-screen flex items-center justify-center px-4">

    {{--  CHANGED: max-w-md → max-w-sm --}}
    <div class="card w-full max-w-sm rounded-2xl p-5 shadow-2xl text-white">

        <h1 class="text-2xl font-bold text-center mb-3">
            Welcome Back
        </h1>

        <p class="text-center text-gray-300 text-xs mb-5">
            Login to continue
        </p>

        {{-- Tabs --}}
        <div class="flex rounded-lg overflow-hidden mb-5 border border-white/10">

            <a href="{{ route('login') }}"
               class="w-1/2 text-center py-2 text-sm tab-active">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="w-1/2 text-center py-2 text-sm bg-white/5 hover:bg-white/10 transition">
                Signup
            </a>

        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login.store') }}" class="space-y-3">

            @csrf

            {{-- Email --}}
            <div>
                <input
                    type="email"
                    name="email"
                    placeholder="Email Address"
                    value="{{ old('email') }}"
                    class="input w-full rounded-lg px-3 py-2 text-sm"
                >

                @error('email')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="input w-full rounded-lg px-3 py-2 text-sm"
                >

                @error('password')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <a href="{{ route('register') }}" class="text-xs text-blue-400 hover:underline">
                    Forgot password?
                </a>
            </div>

            <button
                type="submit"
                class="w-full py-2 rounded-lg text-white font-semibold text-sm
                       bg-gradient-to-r from-blue-600 to-blue-500 hover:opacity-90 transition"
            >
                Login
            </button>

        </form>

        <p class="text-center mt-5 text-xs text-gray-300">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-400 hover:underline">
                Create one
            </a>
        </p>

    </div>

</div>

</body>
</html>