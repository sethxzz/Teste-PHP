<?php

session_start();
require_once 'config.php';

if (isset ($_POST['register_btn'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check_email = $conn->query("SELECT email FROM usuarios WHERE email = '$email'");
    if ($check_email->num_rows > 0) {
        $_SESSION['alerts'][] = [
            'type' => 'error',
            'message' => 'E-mail já foi registrado'
        ];
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO usuarios (name, email, password) VALUES ('$name', '$email', '$password')");
        $_SESSION['alerts'][] = [
            'type'=> 'success',
            'message'=> 'Registro Confirmado!'
        ];
        $_SESSION['active_form'] = 'register';
    }

    header('Location: index.php');
    exit();
}

if (isset ($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM usuarios WHERE email = '$email'");
    $user = $result->num_rows > 0 ? $result->fetch_assoc() : null;

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['name'] = $user['name'];
        $_SESSION['alerts'][] = [
            'type' => 'success',
            'message'=> 'Login feito com sucesso!'
        ];
    } else {
        $_SESSION['alerts'][] = [
            'type'=> 'error',
            'message'=> 'E-mail ou senha incorretos!'
        ];
        $_SESSION['active_form'] = 'login';
    }

    header('Location: index.php');
    exit();
}
?>