<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Register - Sarhni</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="auth-container">
@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($errors->any())
    <ul style="color: red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

    {{-- Tabs --}}
    <div class="tabs">
        <button onclick="showForm('login')">Login</button>
        <button onclick="showForm('register')">Register</button>
    </div>

    {{-- Login Form --}}
    <form id="login-form" action="{{ route('login') }}" method="POST" style="display: block;">
        @csrf
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    {{-- Register Form --}}
    <form id="register-form" action="{{ route('register') }}" method="POST" style="display: none;">
        @csrf
        <h2>Register</h2>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>

</div>
</body>
</html>

<script>
    function showForm(formId) {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('register-form').style.display = 'none';
        document.getElementById(formId + '-form').style.display = 'block';
    }
</script>
</body>
</html>
