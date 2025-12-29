<?php
require 'config/database.php';
require 'src/User.php';

$error = '';

if ($_POST) {
    $user = User::where('email', $_POST['email'])->first();

    if ($user && password_verify($_POST['password'], $user->password)) {
        $_SESSION['user_id'] = $user->id;
        header('Location: dashboard.php');
        exit;
    }
    $error = 'Credenciales incorrectas';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AgendaEloquent - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card mx-auto shadow" style="max-width:400px;border-top:5px solid #e83e8c">
<div class="card-body">
<h4 class="text-center text-danger mb-3">AgendaEloquent 💖</h4>

<form method="post">
<input class="form-control mb-2" name="email" placeholder="Email" required>
<input type="password" class="form-control mb-3" name="password" placeholder="Contraseña" required>
<button class="btn btn-danger w-100">Entrar</button>
</form>

<p class="text-danger mt-2"><?= $error ?></p>
<a href="register.php" class="text-warning">Registrarse</a>
</div>
</div>
</div>
</body>
</html>
