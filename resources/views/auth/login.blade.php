@extends('layouts.app')

@section('content')
<div class="neon-box">
    <h1>🔑 Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-neon">Login</button>
    </form>
    <p class="mt-3">Don't have an account? <a href="{{ route('register') }}" class="neon-link">Register here</a></p>
</div>
@endsection
