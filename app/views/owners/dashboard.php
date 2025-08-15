<?php
// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Restrict access to owners only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'owner') {
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
    .dashboard-actions a.add {
        background: #1677ff;
        color: #fff;
    }
    .dashboard-actions a.add:hover {
        background: #0e5fd8;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions a.view {
        background: #22d3ee;
        color: #fff;
    }
    .dashboard-actions a.view:hover {
        background: #0ebac7;
        transform: translateY(-2px) scale(1.03);
    }
    .dashboard-actions a.manage {
        background: #22c55e;
        color: #fff;
    }
    .dashboard-actions a.manage:hover {
        background: #16a34a;
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
            <!-- User/Owner SVG Icon -->
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="8" r="4" fill="#fff" fill-opacity="0.9"/>
                <path d="M4 20c0-3.314 3.134-6 7-6s7 2.686 7 6" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <div class="subtitle">Your Owner Dashboard</div>
    </div>
    <div class="dashboard-content">
        <p>Manage your properties and bookings efficiently.</p>
        <div class="dashboard-actions">
            <a class="add" href="/rental_system/public/index.php?url=PropertyController/add">
                <span class="icon">
                    <!-- Plus SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <rect x="8" y="3" width="4" height="14" rx="2" fill="#fff"/>
                        <rect x="3" y="8" width="14" height="4" rx="2" fill="#fff"/>
                    </svg>
                </span>
                Add New Property
            </a>
            <a class="view" href="/rental_system/public/index.php?url=PropertyController/my_properties">
                <span class="icon">
                    <!-- List SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <rect x="4" y="5" width="12" height="2" rx="1" fill="#fff"/>
                        <rect x="4" y="9" width="12" height="2" rx="1" fill="#fff"/>
                        <rect x="4" y="13" width="12" height="2" rx="1" fill="#fff"/>
                    </svg>
                </span>
                View My Properties
            </a>
            <a class="manage" href="/rental_system/public/index.php?url=BookingController/manage">
                <span class="icon">
                    <!-- Check SVG -->
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none">
                        <polyline points="5 11 9 15 15 7" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                Manage Bookings
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
