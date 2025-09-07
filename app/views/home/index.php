<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rental System - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            position: relative;
            overflow-x: hidden;
        }
        /* Decorative gradient blobs */
        .bg-shape {
            position: absolute;
            z-index: 0;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.5;
        }
        .bg-shape.one {
            width: 340px; height: 340px;
            top: -120px; left: -120px;
            background: linear-gradient(135deg, #4f8cff 0%, #38b6ff 100%);
        }
        .bg-shape.two {
            width: 220px; height: 220px;
            bottom: -80px; right: -80px;
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }
        .container {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.85);
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(44, 62, 80, 0.13), 0 1.5px 8px rgba(79,140,255,0.07);
            padding: 56px 38px 40px 38px;
            text-align: center;
            max-width: 420px;
            margin-top: 40px;
            backdrop-filter: blur(8px);
            border: 1.5px solid rgba(79,140,255,0.09);
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 22px;
        }
        .logo svg {
            width: 74px;
            height: 74px;
            display: block;
            filter: drop-shadow(0 2px 12px #4f8cff33);
        }
        h1 {
            color: #2d3a4b;
            font-size: 2.5rem;
            margin-bottom: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-shadow: 0 2px 8px #4f8cff11;
        }
        .subtitle {
            color: #38b6ff;
            font-size: 1.18rem;
            margin-bottom: 32px;
            font-weight: 500;
            letter-spacing: 0.2px;
        }
        .buttons {
            margin-top: 22px;
            display: flex;
            justify-content: center;
            gap: 22px;
            flex-wrap: wrap;
        }
        .buttons a {
            text-decoration: none;
            padding: 15px 38px;
            background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
            color: #fff;
            border-radius: 9px;
            font-weight: 700;
            font-size: 1.08rem;
            box-shadow: 0 2px 12px rgba(79,140,255,0.13);
            transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
            border: none;
            outline: none;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }
        .buttons a:before {
            content: "";
            position: absolute;
            left: -40%;
            top: 0;
            width: 180%;
            height: 100%;
            background: linear-gradient(120deg, #fff6 0%, #fff0 100%);
            opacity: 0.18;
            transform: skewX(-20deg);
            pointer-events: none;
        }
        .buttons a:hover {
            background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
            transform: translateY(-2px) scale(1.045);
            box-shadow: 0 4px 18px rgba(79,140,255,0.18);
        }
        @media (max-width: 600px) {
            .container {
                padding: 32px 10px 28px 10px;
                max-width: 98vw;
            }
            .logo svg {
                width: 54px;
                height: 54px;
            }
            h1 {
                font-size: 1.5rem;
            }
            .subtitle {
                font-size: 1rem;
            }
            .buttons a {
                padding: 12px 22px;
                font-size: 0.98rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-shape one"></div>
    <div class="bg-shape two"></div>
    <div class="container">
        <div class="logo">
            <!-- SVG House Icon with gradient and shadow -->
            <svg viewBox="0 0 64 64" fill="none">
                <defs>
                    <linearGradient id="houseGradient" x1="0" y1="0" x2="64" y2="64" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#4f8cff"/>
                        <stop offset="1" stop-color="#38b6ff"/>
                    </linearGradient>
                </defs>
                <rect width="64" height="64" rx="16" fill="url(#houseGradient)" opacity="0.13"/>
                <path d="M12 32L32 16L52 32" stroke="url(#houseGradient)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" filter="url(#shadow)"/>
                <rect x="20" y="32" width="24" height="16" rx="2.5" fill="#fff" stroke="url(#houseGradient)" stroke-width="3.5"/>
                <rect x="34" y="40" width="6" height="8" rx="1.2" fill="url(#houseGradient)" opacity="0.8"/>
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
