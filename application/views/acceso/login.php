<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso SAES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <main class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow-sm w-100" style="max-width: 420px;">
            <div class="card-body p-4">
                <h3 class="text-center mb-4">SAES</h3>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= html_escape($error); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('acceso/entrar'); ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input class="form-control" name="usuario" required autocomplete="username">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input class="form-control" name="clave" type="password" required autocomplete="current-password">
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Iniciar sesión
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>