<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Restrict access to renters only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'renter') {
    header("Location: /rental_system/public/index.php?url=UserController/login");
    exit;
}
?>
<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #dbeafe;
        margin: 0;
        padding: 0;
    }
    .dashboard-card {
        background: #fff;
        max-width: 480px;
        margin: 48px auto 0 auto;
        border-radius: 20px;
        box-shadow: 0 6px 32px rgba(44, 62, 80, 0.09);
        overflow: hidden;
    }
    .dashboard-header {
        background: #0284ff;
        color: #fff;
        padding: 36px 0 22px 0;
        text-align: center;
    }
    .dashboard-header .icon {
        font-size: 2.2rem;
        margin-bottom: 8px;
        display: block;
    }
    .dashboard-header h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: 1px;
    }
    .dashboard-header .subtitle {
        font-size: 1.1rem;
        font-weight: 400;
        margin-top: 6px;
        color: #e0e7ef;
    }
    .dashboard-content {
        padding: 32px 32px 28px 32px;
        text-align: center;
    }
    .dashboard-content p {
        color: #444;
        font-size: 1.08rem;
        margin-bottom: 28px;
    }
    .dashboard-actions {
        display: flex;
        flex-direction: column;
        gap: 18px;
        align-items: stretch;
    }
    .dashboard-actions a {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 0;
        border-radius: 8px;
        font-size: 1.08rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.18s, transform 0.18s;
        box-shadow: 0 2px 8px rgba(44, 62, 80, 0.05);
    }
    .dashboard-actions a.browse {
        background: #0284ff;
        color: #fff;
    }
    .dashboard-actions a.browse:hover {
        background: #0366d6;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions a.bookings {
        background: #06b6d4;
        color: #fff;
    }
    .dashboard-actions a.bookings:hover {
        background: #0891b2;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions a.wishlist {
        background: #16a34a;
        color: #fff;
    }
    .dashboard-actions a.wishlist:hover {
        background: #15803d;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions a.logout {
        background: #ef4444;
        color: #fff;
    }
    .dashboard-actions a.logout:hover {
        background: #b91c1c;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions .icon {
        font-size: 1.2em;
        display: inline-block;
        vertical-align: middle;
    }
</style>

<div class="dashboard-card">
    <div class="dashboard-header">
        <span class="icon">
            <!-- Renter/User SVG Icon -->
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="8" r="4" fill="#fff" fill-opacity="0.9"/>
                <path d="M4 20c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <div class="subtitle">Your Renter Dashboard</div>
    </div>
    <div class="dashboard-content">
        <p>Here you can browse and book properties.</p>
        <div class="dashboard-actions">
            <a class="browse" href="/rental_system/public/index.php?url=PropertyController/listAll">
                <span class="icon">
                    <!-- Browse SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <circle cx="9" cy="9" r="7" stroke="#fff" stroke-width="2"/>
                        <line x1="14.5" y1="14.5" x2="18" y2="18" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                Browse Properties
            </a>
            <a class="bookings" href="/rental_system/public/index.php?url=PropertyController/my_bookings">
                <span class="icon">
                    <!-- Calendar SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <rect x="3" y="5" width="14" height="10" rx="2" stroke="#fff" stroke-width="2"/>
                        <line x1="3" y1="8" x2="17" y2="8" stroke="#fff" stroke-width="2"/>
                        <rect x="7" y="11" width="2" height="2" rx="1" fill="#fff"/>
                        <rect x="11" y="11" width="2" height="2" rx="1" fill="#fff"/>
                    </svg>
                </span>
                My Bookings
            </a>
            <a class="wishlist" href="/rental_system/public/index.php?url=WishlistController/view">
                <span class="icon">
                    <!-- Heart SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <path d="M10 17s-5-3.33-7-6.5C1.5 8 3 5 6 5c1.54 0 2.54 1.04 3 2.09C9.46 6.04 10.46 5 12 5c3 0 4.5 3 3 5.5C15 13.67 10 17 10 17z" stroke="#fff" stroke-width="2" fill="#fff" fill-opacity="0.3"/>
                    </svg>
                </span>
                My Wishlist
            </a>
            <a class="logout" href="/rental_system/public/index.php?url=UserController/logout">
                <span class="icon">
                    <!-- Logout SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <path d="M7 15l-1.5-1.5M7 15l1.5-1.5M7 15V5m0 0l-1.5 1.5M7 5l1.5 1.5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="9" y="3" width="8" height="14" rx="2" stroke="#fff" stroke-width="2"/>
                    </svg>
                </span>
                Logout
            </a>
        </div>
    </div>
</div>
