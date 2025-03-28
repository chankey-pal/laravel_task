<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>

    <!-- Google Fonts & Bootstrap 5 -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background: #0d0d0d;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #fff;
        }

        .neon-box {
            border: 2px solid #00ffcc;
            border-radius: 16px;
            padding: 40px;
            max-width: 450px;
            width: 100%;
            text-align: center;
            box-shadow: 0px 0px 20px rgba(0, 255, 204, 0.7);
            animation: glow 1.5s infinite alternate;
        }

        @keyframes glow {
            from {
                box-shadow: 0px 0px 10px rgba(0, 255, 204, 0.5);
            }
            to {
                box-shadow: 0px 0px 20px rgba(0, 255, 204, 1);
            }
        }

        .btn-neon {
            background: #00ffcc;
            color: #000;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 700;
            transition: all 0.3s ease-in-out;
        }

        .btn-neon:hover {
            background: #00bfa5;
            transform: scale(1.1);
            box-shadow: 0px 5px 15px rgba(0, 255, 204, 0.7);
        }
    </style>
</head>
<body>
    <div class="neon-box">
        <h1>🔥 Task Manager</h1>
        <p>Get things done, cyberpunk style.</p>
        <a href="{{ route('tasks.index') }}" class="btn btn-neon mt-4">View Tasks</a>
    </div>
</body>
</html>
