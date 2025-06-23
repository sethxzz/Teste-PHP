<?php

session_start();

$name = $_SESSION['name'];
$alerts = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';

session_unset();

if ($name !== null) $_SESSION['name'] = $name


?>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <header>
        <a href="" class="logo">Eloy Medicina Diagnóstica.</a>

        <nav>
            <a href="#">Início</a>
            <a href="#">Sobre</a>
            <a href="#">Serviços</a>
            <a href="#">Contato</a>
        </nav>

        <div class="user-auth">
            <?php if (!empty($name)): ?>
            <div class="profile-box">
                <div class="avatar-circle"><?= strtoupper($name[0]); ?></div>
                <div class="dropdown">
                    <a href="#">Meus Agendamentos</a>
                    <a href="logout.php">Sair</a>
                </div>
            </div>

            <?php else: ?>
            <button type="button" class="login-btn-modal">Login</button>
            <?php endif; ?>
        </div>
    </header>
    
    <section>
        <h1>Seja Bem Vindo, <?= $name ?? 'Paciente' ?></h1>
    </section>

    <?php if (!empty($alerts)): ?>
    <div class="alert-box">
        <?php foreach ($alerts as $alert): ?>
        <div class="alert <?= $alert['type']; ?>">
            <i class='bx <?= $alert['type'] === 'success' ? 'bx-check-circle' : 'bx-x-circle'; ?>'></i>
            <span><?= $alert['message']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <div class="auth-modal <?= $active_form === 'register' ? 'show slide' : ($active_form === 'login' ? 'show' : ''); ?>">

        <button type="button" class="close-btn-modal"><i class='bx bx-x'></i></button>

        <div class="form-box login">
            <h2>Entrar</h2>
            <form action="auth_process.php" method="POST">
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'  ></i> 
                </div>
                 <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'  ></i> 
                </div>
                <button type="submit" name="login_btn" class="btn">Entrar</button>
                <p>Ainda não se registrou? <a href="#" class="register-link">Registrar</a></p>

            </form>
        </div>

                <div class="form-box register">
            <h2>Registrar</h2>
            <form action="auth_process.php" method="POST">
                <div class="input-box">
                    <input type="text" name="name" placeholder="Name" required>
                    <i class='bx bx-user'></i> 
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class='bx bxs-envelope'  ></i> 
                </div>
                 <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class='bx bxs-lock'  ></i> 
                </div>
                <button type="submit" name="register_btn" class="btn">Registrar</button>
                <p>Já se registrou? <a href="#" class="login-link">Entrar</a></p>

            </form>
        </div>

    </div>

    <script src="login.js"></script>
</body>

</html>