<?php
require 'bootstrap/database.php';
require 'src/Models/User.php';
require 'src/Models/Contact.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user = User::find($_SESSION['user_id']);

// CREAR CONTACTO
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    Contact::create([
        'name' => $_POST['name'],
        'lastname' => $_POST['lastname'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'address' => $_POST['address'],
        'user_id' => $user->id
    ]);
    header('Location: dashboard.php');
    exit;
}

// EDITAR CONTACTO
if (isset($_POST['action']) && $_POST['action'] === 'edit' && isset($_POST['contact_id'])) {
    $contact = Contact::where('id', $_POST['contact_id'])
        ->where('user_id', $user->id)
        ->first();
    if ($contact) {
        $contact->update([
            'name' => $_POST['name'],
            'lastname' => $_POST['lastname'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address']
        ]);
    }
    header('Location: dashboard.php');
    exit;
}

// BORRAR CONTACTO
if (isset($_GET['delete'])) {
    Contact::where('id', $_GET['delete'])
        ->where('user_id', $user->id)
        ->delete();
    header('Location: dashboard.php');
    exit;
}

$contacts = Contact::where('user_id', $user->id)->get();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mi Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-danger">Hola <?= htmlspecialchars($user->name) ?> 💖</h4>
            <a href="logout.php" class="btn btn-outline-warning">Salir</a>
        </div>

        <!-- FORMULARIO NUEVO CONTACTO -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-danger text-white fw-bold">Nuevo Contacto</div>
            <div class="card-body">
                <form method="post" class="row g-3">
                    <input type="hidden" name="action" value="add">
                    <div class="col-md-6">
                        <input name="name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="col-md-6">
                        <input name="lastname" class="form-control" placeholder="Apellidos" required>
                    </div>
                    <div class="col-md-4">
                        <input name="phone" class="form-control" placeholder="Teléfono">
                    </div>
                    <div class="col-md-4">
                        <input name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="col-md-4">
                        <input name="address" class="form-control" placeholder="Dirección">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-warning w-100 mt-2">Guardar Contacto</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- LISTA DE CONTACTOS -->
        <h5 class="text-danger mb-2">Tus contactos</h5>
        <ul class="list-group">
            <?php foreach ($contacts as $c): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <form method="post" class="d-flex gap-2 flex-wrap align-items-center w-100">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="contact_id" value="<?= $c->id ?>">

                        <input name="name" value="<?= htmlspecialchars($c->name) ?>" class="form-control form-control-sm"
                            placeholder="Nombre" required>
                        <input name="lastname" value="<?= htmlspecialchars($c->lastname) ?>"
                            class="form-control form-control-sm" placeholder="Apellidos" required>
                        <input name="phone" value="<?= htmlspecialchars($c->phone) ?>" class="form-control form-control-sm"
                            placeholder="Teléfono">
                        <input name="email" value="<?= htmlspecialchars($c->email) ?>" class="form-control form-control-sm"
                            placeholder="Email">
                        <input name="address" value="<?= htmlspecialchars($c->address) ?>"
                            class="form-control form-control-sm" placeholder="Dirección">

                        <button class="btn btn-sm btn-warning">💾</button>
                        <a href="?delete=<?= $c->id ?>" class="btn btn-sm btn-outline-danger">❌</a>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>

</html>