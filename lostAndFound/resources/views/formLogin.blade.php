<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login & Register</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 40px; }
        h1 { text-align: center; color: maroon; margin-bottom: 30px; }
        .container { display: flex; justify-content: center; gap: 50px; max-width: 900px; margin: auto; }
        .form-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .form-box h2 { margin-bottom: 20px; color: maroon; }
        input { width: 94%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: maroon; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #7c1c1c; }
        .message { text-align: center; margin-bottom: 20px; }
        .message p { padding: 10px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <h1>Selamat Datang di Lost & Found</h1>

    <div class="message">
        @if ($errors->any())
            <p class="error">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </p>
        @endif

        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
    </div>

    <div class="container">
        <!-- Login Form -->
        <div class="form-box">
            <h2>Login</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
    <div style="text-align:center; margin-top:15px;">
    Belum punya akun? <a href="{{ route('auth.register') }}">Daftar di sini</a>
    </div>
</body>
</html>
