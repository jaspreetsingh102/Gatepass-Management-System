<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proctor & Ractor Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            background: #141E30;
            position: relative;
        }
        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        .background-animation div {
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            animation: bounce 6s infinite alternate ease-in-out;
        }
        @keyframes bounce {
            from {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
            to {
                transform: translateY(-50vh) scale(1.2);
                opacity: 0.3;
            }
        }
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            width: 380px;
            z-index: 10;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        .role-tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .role-tabs button {
            flex: 1;
            padding: 12px;
            border: none;
            background: #007BFF;
            color: white;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .role-tabs button.active {
            background: #0056b3;
        }
        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            background: #f1f1f1;
        }
        .input-group span {
            padding: 12px;
            background: #007BFF;
            color: white;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            outline: none;
            background: transparent;
        }
        button.submit-btn {
            width: 100%;
            padding: 12px;
            border: none;
            background: #28a745;
            color: white;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s;
        }
        button.submit-btn:hover {
            background: #218838;
        }
    </style>
    <script>
        function toggleRole(role) {
            document.getElementById('role').value = role;
            document.querySelectorAll('.role-tabs button').forEach(btn => btn.classList.remove('active'));
            document.getElementById(role + '-btn').classList.add('active');
            createAnimation();
        }
        function createAnimation() {
            const animationContainer = document.querySelector('.background-animation');
            animationContainer.innerHTML = '';
            for (let i = 0; i < 20; i++) {
                const div = document.createElement('div');
                div.style.left = Math.random() * 100 + 'vw';
                div.style.animationDuration = Math.random() * 8 + 4 + 's';
                div.style.animationDelay = Math.random() * 6 + 's';
                animationContainer.appendChild(div);
            }
        }
        window.onload = createAnimation;
    </script>
</head>
<body>
    <div class="background-animation"></div>
    <div class="login-container">
        <h2>Login</h2>
        <div class="role-tabs">
            <button id="proctor-btn" class="active" onclick="toggleRole('Proctor')">Proctor</button>
            <button id="ractor-btn" onclick="toggleRole('Ractor')">Ractor</button>
        </div>
        <form action="login.php" method="POST">
            <input type="hidden" id="role" name="role" value="Proctor">
            <div class="input-group">
                <span>📧</span>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="input-group">
                <span>🔒</span>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="submit-btn">Login</button>
        </form>
    </div>
</body>
</html>