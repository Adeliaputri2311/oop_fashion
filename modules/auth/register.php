<?php 
session_start();
if (isset($_SESSION['login'])) {
    header("Location: ../../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Us | Jenstore Fashion System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary-rose: #ff758f; --soft-pink: #ffafbd; --bg-body: #fdfafb; }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #fdfafb 0%, #fff0f3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            background: white;
            border-radius: 40px;
            border: none;
            box-shadow: 0 20px 60px rgba(255, 117, 143, 0.1);
            overflow: hidden;
        }
        .brand-text {
            font-weight: 800;
            background: linear-gradient(45deg, #ff758f, #ffafbd);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2rem;
            letter-spacing: -1.5px;
        }
        .form-control {
            border-radius: 15px;
            padding: 12px 20px;
            border: 1px solid #f1f1f1;
            background: #fdfafb;
            font-weight: 600;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(255, 117, 143, 0.1);
            border-color: var(--primary-rose);
        }
        .btn-auth {
            background: linear-gradient(45deg, #ff758f, #ffafbd);
            color: white;
            border: none;
            border-radius: 18px;
            padding: 14px;
            font-weight: 700;
            transition: 0.3s;
        }
        .btn-auth:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 117, 143, 0.3);
            color: white;
        }
        .auth-link { color: var(--primary-rose); font-weight: 700; text-decoration: none; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="text-center mb-4">
                <h2 class="brand-text">Jenstore.</h2>
            </div>
            <div class="card auth-card">
                <div class="card-body p-5">
                    <h4 class="fw-800 mb-2 text-center">Create Account</h4>
                    <p class="text-muted text-center small mb-4">Bergabunglah dengan komunitas fashion kami</p>
                    
                    <form action="auth_logic.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">PICK USERNAME</label>
                            <input type="text" name="username" class="form-control" placeholder="Pilih nama unik" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">PASSWORD</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Minimal 6 karakter" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">CONFIRM PASSWORD</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Ulangi password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="register" class="btn btn-auth">Create Account</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <span class="small text-muted">Sudah punya akun? <a href="login.php" class="auth-link">Login</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;
        if (password !== confirm) {
            e.preventDefault();
            alert('Ups! Password dan Konfirmasi tidak cocok 🌸');
        }
    });
</script>

</body>
</html>