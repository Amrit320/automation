<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('admin/dist/css/login.css') }}">
</head>
<body>
    <div id="loginSection">
        <form method="POST" action="{{ route('admin.login.submit') }}" class="modern-form">
            @csrf
            <h2 class="form-title">Admin Login</h2>
            <div class="input-group">
                <div class="input-wrapper">
                    <input type="email" name="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="input-group">
                <div class="input-wrapper">
                    <input type="password" name="password" class="form-input" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" class="submit-button">Login<span class="button-glow"></span></button>
            @if($errors->any())
                <div class="form-footer" style="color:red;">{{ $errors->first('email') }}</div>
            @endif
        </form>
    </div>
</body>
</html>
