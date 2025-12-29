<?php
require 'bootstrap/database.php';
require 'src/Models/User.php';

if ($_POST) {
    User::create([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5">
<div class="card mx-auto shadow" style="max-width:400px;border-top:5px solid #d4af37">
<div class="card-body">
<h4 class="text-center text-warning">Registro</h4>

<form method="post">
<input class="form-control mb-2" name="name" placeholder="Nombre" required>
<input class="form-control mb-2" name="email" placeholder="Email" required>
<input type="password" class="form-control mb-3" name="password" placeholder="Contraseña" required>
<button class="btn btn-warning w-100">Crear cuenta</button>
</form>
</div>
</div>
</div>
</body>
</html>
