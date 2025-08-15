<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rental System - Home</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 32px rgba(44, 62, 80, 0.09);
            padding: 48px 36px 36px 36px;
            text-align: center;
            max-width: 420px;
            margin-top: 40px;
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        .logo svg {
            width: 64px;
            height: 64px;
            display: block;
        }
        h1 {
            color: #2d3a4b;
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .subtitle {
            color: #4f8cff;
            font-size: 1.1rem;
            margin-bottom: 28px;
            font-weight: 500;
        }
        .buttons {
            margin-top: 18px;
            display: flex;
            justify-content: center;
            gap: 18px;
        }
        .buttons a {
            text-decoration: none;
            padding: 13px 32px;
            background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
            color: #fff;
            border-radius: 7px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(79,140,255,0.08);
            transition: background 0.2s, transform 0.2s;
        }
        .buttons a:hover {
            background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
            transform: translateY(-2px) scale(1.04);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <!-- SVG House Icon -->
            <svg viewBox="0 0 64 64" fill="none">
                <rect width="64" height="64" rx="16" fill="#4f8cff" opacity="0.09"/>
                <path d="M12 32L32 16L52 32" stroke="#4f8cff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="20" y="32" width="24" height="16" rx="2" fill="#fff" stroke="#4f8cff" stroke-width="3"/>
                <rect x="34" y="40" width="6" height="8" rx="1" fill="#4f8cff" opacity="0.7"/>
            </svg>
        </div>
        <h1>Welcome to Rental System</h1>
        <div class="subtitle">Find your dream rental or list your property today!</div>
        <div class="buttons">
            <a href="/rental_system/public/index.php?url=UserController/login">Login</a>
            <a href="/rental_system/public/index.php?url=UserController/register">Register</a>
        </div>
    </div>
</body>
</html>
