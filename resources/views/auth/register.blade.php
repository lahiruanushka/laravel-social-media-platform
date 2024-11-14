@extends('layouts.app')

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center py-5">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6">
            <!-- Brand Section -->
            <div class="text-center mb-4">
                <h1 class="display-4 text-primary fw-bold">PostVibe</h1>
                <p class="text-muted">Join our community today!</p>
            </div>

            <!-- Register Card -->
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h2 class="card-title text-center mb-4">Create Account</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="form-floating mb-3">
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}"
                                   placeholder="Your Name" required>
                            <label for="name">Full Name</label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="form-floating mb-3">
                            <input id="username" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   name="username" value="{{ old('username') }}"
                                   placeholder="username" required>
                            <label for="username">Username</label>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}"
                                   placeholder="name@example.com" required>
                            <label for="email">Email Address</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-3">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-4">
                            <input id="password-confirm" type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   placeholder="Confirm Password" required>
                            <label for="password-confirm">Confirm Password</label>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label text-muted" for="terms">
                                I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-4">
                            Create Account
                        </button>

                        <!-- Social Register Buttons -->
                        <div class="text-center">
                            <p class="text-muted mb-4">Or sign up with</p>
                            <div class="d-flex gap-2 justify-content-center mb-4">
                                <button type="button" class="btn btn-outline-secondary px-4">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary px-4">
                                    <i class="fab fa-facebook"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary px-4">
                                    <i class="fab fa-twitter"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center">
                            <span class="text-muted">Already have an account?</span>
                            <a href="{{ route('login') }}" class="text-primary text-decoration-none ms-1">
                                Sign in
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
