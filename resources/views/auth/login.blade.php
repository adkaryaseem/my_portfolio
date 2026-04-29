<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }
        .form-input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 8px;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--glass-border);
            color: white;
            font-family: inherit;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
        }
        .error-message {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
        .btn-full {
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="bg-mesh"></div>

    <div class="login-container">
        <div class="glass-card login-card card-3d">
            <h2 class="section-title text-center" style="font-size: 2rem;">Admin Access</h2>
            <div class="section-line" style="margin: 0 auto 2rem;"></div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Secure Login</button>
            </form>
            <div class="text-center mt-2">
                <a href="{{ route('portfolio.index') }}" style="color: var(--text-muted); text-decoration: none; font-size: 0.9rem;">&larr; Back to Portfolio</a>
            </div>
        </div>
    </div>
</body>
</html>
