<?php if (!empty($data['error'])): ?>
    <p style="color:red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<style>
    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 0;
    }
    .login-card {
        background: #fff;
        max-width: 370px;
        margin: 60px auto 0 auto;
        padding: 32px 28px 24px 28px;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.09);
    }
    .login-card h2 {
        margin-top: 0;
        margin-bottom: 18px;
        font-weight: 600;
        color: #2d3a4b;
        text-align: center;
        letter-spacing: 1px;
    }
    .login-card label {
        display: block;
        margin-bottom: 6px;
        color: #34495e;
        font-size: 15px;
        font-weight: 500;
    }
    .login-card input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 18px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 15px;
        background: #f9fafb;
        transition: border 0.2s;
    }
    .login-card input:focus {
        border-color: #4f8cff;
        outline: none;
        background: #fff;
    }
    .login-card button {
        width: 100%;
        padding: 12px;
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        box-shadow: 0 2px 8px rgba(79,140,255,0.08);
    }
    .login-card button:hover {
        background: linear-gradient(90deg, #357ae8 0%, #1fa2ff 100%);
    }
    .login-card .error-message {
        color: #e74c3c;
        background: #fdecea;
        border: 1px solid #f5c6cb;
        padding: 10px 14px;
        border-radius: 5px;
        margin-bottom: 18px;
        font-size: 14px;
        text-align: center;
    }
</style>

<div class="login-card">
    <h2>Login</h2>
    <?php if (!empty($data['error'])): ?>
        <div class="error-message"><?php echo $data['error']; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>
