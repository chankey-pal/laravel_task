<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>

    <!-- Bootstrap 5 (minified) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />

    <!-- Google Fonts & FontAwesome (optimized load) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    
    <!-- Quill CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js"></script>

<!-- Quill JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.min.js"></script>

    <!-- Quill Styles -->
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.6/dist/quill.snow.css" rel="stylesheet" />

  
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            transition: all 0.3s ease-in-out;
        }

        /* Body with dynamic gradient and animation */
        body {
            background: linear-gradient(135deg, #4B79A1, #283E51);
            background-size: 400% 400%;
            animation: gradientBackground 10s ease infinite, fadeIn 1s ease-out;
            color: #f0f0f0; /* Light gray color for text */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            opacity: 0;
            transition: opacity 0.6s ease-in-out;
        }

        @keyframes gradientBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.7); /* Slight transparency */
            backdrop-filter: blur(15px); /* Blurred effect */
            padding: 18px 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
            border-radius: 0px;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 32px;
            font-weight: 600;
            color: #f0f0f0 !important;
            letter-spacing: 1px;
        }

        .navbar .greeting {
            color: #ffb84d;
            font-weight: bold;
            font-size: 18px;
        }

        .navbar a {
            color: #f0f0f0 !important;
            font-weight: 500;
            margin-right: 15px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar a:hover {
            color: #ffb84d;
            transform: scale(1.05);
        }

        /* Main Content */
        .main-container {
            max-width: 1200px;
            margin: auto;
            padding-top: 100px; /* Ensuring space below the fixed navbar */
            flex: 1;
        }

        .content-wrapper {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(25px);
            animation: fadeInUp 1.2s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Floating Add Task Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: linear-gradient(135deg, #ffb84d, #ffa500); /* Sophisticated gradient */
            color: white;
            border-radius: 50%;
            width: 55px;
            height: 55px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            z-index: 1000;
        }

        .fab:hover {
            transform: scale(1.1) rotate(15deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.6);
            background: linear-gradient(135deg, #ffa500, #ffb84d);
        }

        /* Footer */
        .footer {
            background: rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #f0f0f0;
            padding: 20px 0;
            margin-top: auto;
            font-size: 16px;
            letter-spacing: 1px;
        }

        /* Button Hover Effect */
        .btn-light {
            background-color: #ffb84d;
            color: white;
            border: 2px solid transparent;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-light:hover {
            background-color: #ffa500;
            color: white;
            border-color: #ffa500;
        }

        /* Card Animations */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #333;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 28px;
            }

            .fab {
                width: 65px;
                height: 65px;
                font-size: 32px;
            }

            .content-wrapper {
                padding: 30px;
            }

            .navbar {
                padding: 16px;
            }
        }
        /* Particle Effect */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            opacity: 0;
            animation: floatParticles 10s linear infinite;
        }

        @keyframes floatParticles {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateY(-10vh) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <div class="particles"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function createParticles() {
                const particlesContainer = document.querySelector(".particles");
                for (let i = 0; i < 20; i++) {
                    let particle = document.createElement("div");
                    particle.classList.add("particle");
                    let size = Math.random() * 10 + 5;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.left = `${Math.random() * 100}vw`;
                    particle.style.animationDuration = `${Math.random() * 5 + 5}s`;
                    particlesContainer.appendChild(particle);
                }
            }
            createParticles();
        });
    </script>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Task Manager</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="greeting" id="greeting"></span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container main-container">
        <div class="particles"></div>
        <div class="content-wrapper">
            
            @yield('content')
        </div>
    </div>

    <!-- Floating Add Task Button -->
    <a href="{{ route('tasks.create') }}" class="fab">
        <i class="fas fa-plus"></i>
    </a>

    <!-- Footer -->
    <footer class="footer">
        Task Manager &copy; {{ date('Y') }}. All rights reserved.
    </footer>

    <!-- Async JS for better performance -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" async></script>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Fade-in effect for the body
            document.body.style.opacity = "1";

            // Set greeting message
            function setGreeting() {
                const hour = new Date().getHours();
                const greetingMessage = document.getElementById("greeting");

                if (hour < 12) {
                    greetingMessage.textContent = "Good Morning! Welcome to Task Manager.";
                } else if (hour < 18) {
                    greetingMessage.textContent = "Good Afternoon! Welcome to Task Manager.";
                } else {
                    greetingMessage.textContent = "Good Evening! Welcome to Task Manager.";
                }
            }

            setGreeting();

            // Remove the greeting message after 5 seconds
            setTimeout(function() {
                document.getElementById('greeting').style.display = 'none';
            }, 5000);

            
        });
    </script>
</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status-change').change(function() {
            let taskId = $(this).data('task-id');
            let newStatus = $(this).val();

            $.ajax({
                url: `/tasks/${taskId}/status`,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: newStatus
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Failed to update status.');
                }
            });
        });
    });
</script>




