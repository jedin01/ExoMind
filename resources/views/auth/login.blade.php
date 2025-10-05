<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExoMind - Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .space-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('/background.webp');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
        }

        .title {
            color: #D4AF37;
            font-size: 4rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            letter-spacing: 0.05em;
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
            line-height: 1.1;
        }

        .login-card {
            background: rgba(20, 24, 32, 0.5);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 2rem 1.75rem;
            width: 100%;
            max-width: 320px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            margin: 0 auto;
        }

        .login-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 900;
            text-align: center;
            margin-bottom: 1.5rem;
            letter-spacing: 0.025em;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background: rgba(0, 0, 0, 0.6);
        }

        .form-input.error {
            border-color: #EF4444;
        }

        .login-button {
            width: 100%;
            padding: 0.875rem;
            background: #3B82F6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.25rem;
            box-sizing: border-box;
        }

        .login-button:hover {
            background: #2563EB;
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .remember-me input {
            margin-right: 0.5rem;
            border-radius: 3px;
        }

        .remember-me label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            cursor: pointer;
        }

        .forgot-password {
            text-align: center;
        }

        .forgot-password a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: white;
        }

        .error-message {
            color: #EF4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .status-message {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #22C55E;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1.25rem;
            text-align: center;
            font-size: 0.9rem;
        }

        @media (max-width: 640px) {
            .title {
                font-size: 2.5rem;
                margin-bottom: 2rem;
            }

            .login-card {
                padding: 1.5rem 1.25rem;
                margin: 0 1rem;
                max-width: 280px;
            }
        }
    </style>
</head>
<body>
    <div class="space-background"></div>

    <div class="container">

        <div class="login-card">
            <h2 class="login-title">LOGIN</h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <input
                        id="email"
                        type="email"
                        name="email"
                        class="form-input {{ $errors->get('email') ? 'error' : '' }}"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    >
                    @if ($errors->get('email'))
                        <div class="error-message">
                            {{ $errors->get('email')[0] }}
                        </div>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-input {{ $errors->get('password') ? 'error' : '' }}"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                    >
                    @if ($errors->get('password'))
                        <div class="error-message">
                            {{ $errors->get('password')[0] }}
                        </div>
                    @endif
                </div>


                <button type="submit" class="login-button">
                    {{ __('Log in') }}
                </button>

                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</body>
</html>
