@extends('layouts.app')

@section('title', 'Login - FindState Admin')
@section('meta_description', 'Sign in to the FindState admin dashboard.')

@section('content')
<section class="py-5 bg-light min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h1 class="h4 fw-bold mb-4 text-center">Admin Login</h1>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/login') }}" id="login-form">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required
                                    autofocus
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required
                                >
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" id="login-btn">
                                <i class="fas fa-sign-in-alt me-1"></i> Sign In
                            </button>
                        </form>
                        <script>
                            document.getElementById('login-form').addEventListener('submit', function() {
                                var btn = document.getElementById('login-btn');
                                if (btn) { btn.disabled = true; btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Signing in...'; }
                            });
                        </script>

                        <p class="text-muted small mt-3 mb-0 text-center">
                            Demo user (seeded): <code>test@example.com</code> / <code>password</code>
                        </p>
                        <p class="text-muted small mt-2 mb-0 text-center">
                            Powered by Nexora Labs
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

