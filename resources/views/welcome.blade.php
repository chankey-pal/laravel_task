<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>

    <!-- Preconnect for Faster Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            width: 100%;
            height: 100vh;
            background-color: #0d0d0d;
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('{{ asset('images/sky.webp') }}') no-repeat center/cover;
            background-attachment: fixed;
        }

        .container { position: absolute; width: 100%; height: 100%; overflow: hidden; }

        .circle-container {
    position: absolute;
    top: 80%;  /* Start closer to visibility */
    left: 50%;
    width: 20px;
    height: 20px;
    animation: move-frames 15s linear infinite;
    will-change: transform;
}


.circle {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: radial-gradient(hsl(180, 100%, 80%), hsla(180, 100%, 0) 60%);
    animation: fadein-frames 3s infinite, scale-frames 5s infinite;
}
.circle {
    border: 1px solid red;
}
.circle-container {
    z-index: 5;
}


        @keyframes move-frames {
            0% { transform: translateY(0vh) translateX(-50%); }
            100% { transform: translateY(-110vh) translateX(-50%); }
        }

        .neon-box {
            border: 2px solid #00ffcc;
            border-radius: 16px;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            background: rgba(13, 13, 13, 0.85);
            box-shadow: 0px 0px 15px rgba(0, 255, 204, 0.6);
            animation: glow 1.5s infinite alternate;
            z-index: 10;
        }

        @keyframes glow {
            from { box-shadow: 0px 0px 10px rgba(0, 255, 204, 0.4); }
            to { box-shadow: 0px 0px 18px rgba(0, 255, 204, 0.8); }
        }

        .btn-neon {
            background: #9d4a22;
            color: #000;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            transition: all 0.3s ease-in-out;
        }

        .btn-neon:hover {
            background: #b95f23;
            transform: scale(1.1);
            box-shadow: 0px 5px 15px rgba(0, 255, 204, 0.7);
        }
    </style>
</head>
<body>
  

    <div class="container">
        <!-- Optimized Animated Circles -->
        <div class="circle-container" style="left: 10%; animation-duration: 14s;">
            <div class="circle" style="animation-delay: 2s;"></div>
        </div>
        <div class="circle-container" style="left: 25%; animation-duration: 18s;">
            <div class="circle" style="animation-delay: 3s;"></div>
        </div>
        <div class="circle-container" style="left: 50%; animation-duration: 16s;">
            <div class="circle" style="animation-delay: 1s;"></div>
        </div>
        <div class="circle-container" style="left: 75%; animation-duration: 20s;">
            <div class="circle" style="animation-delay: 2.5s;"></div>
        </div>

        <div class="circle-container" style="left: 10%; animation-duration: 14s;">
            <div class="circle" style="animation-delay: 2s;"></div>
        </div>
        <div class="circle-container" style="left: 25%; animation-duration: 18s;">
            <div class="circle" style="animation-delay: 3s;"></div>
        </div>
        <div class="circle-container" style="left: 50%; animation-duration: 16s;">
            <div class="circle" style="animation-delay: 1s;"></div>
        </div>
        <div class="circle-container" style="left: 75%; animation-duration: 20s;">
            <div class="circle" style="animation-delay: 2.5s;"></div>
        </div>
        <div class="circle-container" style="left: 10%; animation-duration: 14s;">
            <div class="circle" style="animation-delay: 2s;"></div>
        </div>
        <div class="circle-container" style="left: 25%; animation-duration: 18s;">
            <div class="circle" style="animation-delay: 3s;"></div>
        </div>
        <div class="circle-container" style="left: 50%; animation-duration: 16s;">
            <div class="circle" style="animation-delay: 1s;"></div>
        </div>
        <div class="circle-container" style="left: 75%; animation-duration: 20s;">
            <div class="circle" style="animation-delay: 2.5s;"></div>
        </div>

    </div>
  

 <!-- Optimized Neon Box -->
 
 <div class="neon-box">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>🔥 Task Manager</h1>
    <p>Get things done</p>

    <!-- Toggle Button (Position Will Swap Dynamically) -->
    <div class="text-center mb-3" id="button-container">
        <button id="toggle-button" class="btn btn-neon">Register Now!</button>
    </div>

    <!-- Login Form (Default Visible) -->
    <div id="login-form">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-neon">Login</button>
        </form>
    </div>

    <!-- Register Form (Hidden by Default) -->
    <div id="register-form" style="display: none;">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-neon">Register</button>
        </form>
    </div>
</div>

<script>
   document.addEventListener("DOMContentLoaded", function () {
    let loginForm = document.getElementById("login-form");
    let registerForm = document.getElementById("register-form");
    let toggleButton = document.getElementById("toggle-button");

    // Ensure login form is visible and register form is hidden on page load
    loginForm.style.display = "block";
    registerForm.style.display = "none";
    toggleButton.textContent = "Register Now!"; 

    toggleButton.addEventListener("click", function () {
        if (loginForm.style.display === "block") {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
            toggleButton.textContent = "Login"; 
        } else {
            loginForm.style.display = "block";
            registerForm.style.display = "none";
            toggleButton.textContent = "Register Now!"; 
        }
    });
});

</script>


</body>
</html>
