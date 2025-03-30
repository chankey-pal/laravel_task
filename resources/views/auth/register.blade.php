@extends('layouts.app')

@section('content')
<div class="neon-box">
    <h1>🛸 Register</h1>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit" class="btn btn-neon">Register</button>
    </form>
    <p class="mt-3">Already have an account? <a href="{{ route('login') }}" class="neon-link">Login here</a></p>
</div>
@endsection
