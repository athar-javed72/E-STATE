@extends('layouts.app')

@section('title', 'Login - FindState Admin')
@section('meta_description', 'Sign in to the FindState admin dashboard.')

@section('content')
<section class="flex min-h-[70vh] items-center py-12">
    <x-container>
        <div class="mx-auto w-full max-w-md rounded-md border border-line bg-white p-6 shadow-sm sm:p-8">
            <h1 class="text-center text-xl font-bold text-ink">Admin Login</h1>

            @if($errors->any())
                <div class="mt-4 rounded-sm border border-danger/20 bg-danger/10 px-4 py-3 text-sm text-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/login') }}" id="login-form" class="mt-6 space-y-4">
                @csrf
                <x-input label="Email address" name="email" type="email" required autofocus />
                <x-input label="Password" name="password" type="password" required />
                <label class="inline-flex items-center gap-2 text-sm text-ink-secondary">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-line text-brand focus:ring-brand">
                    Remember me
                </label>
                <x-button variant="primary" type="submit" id="login-btn" block>Sign In</x-button>
            </form>

            @if(config('app.debug'))
                <p class="mt-4 text-center text-xs text-ink-muted">Local demo only: <code class="text-ink">test@example.com</code> / <code class="text-ink">password</code></p>
            @endif
            <p class="mt-3 text-center text-xs text-ink-muted">Powered by Nexora Labs</p>
        </div>
    </x-container>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('login-form')?.addEventListener('submit', function () {
    var btn = document.getElementById('login-btn');
    if (btn) { btn.disabled = true; btn.textContent = 'Signing in...'; }
});
</script>
@endpush
