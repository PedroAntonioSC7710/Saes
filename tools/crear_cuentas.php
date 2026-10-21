<?php
if (PHP_SAPI !== 'cli') {
    exit(1);
}

$accounts = array();

foreach (array('admin', 'profesor', 'alumno') as $role) {
    echo "Usuario para $role: ";
    $user = trim(fgets(STDIN));

    echo "Contraseña para $role (mínimo 12 caracteres): ";
    $password = trim(fgets(STDIN));

    if (
        $user === '' ||
        strlen($password) < 12 ||
        isset($accounts[$user])
    ) {
        fwrite(STDERR, "Usuario repetido o contraseña demasiado corta.\n");
        exit(1);
    }

    $account = array(
        'role' => $role,
        'hash' => password_hash($password, PASSWORD_DEFAULT)
    );

    if ($role === 'profesor') {
        echo "Escribe el id_prof real del profesor: ";
        $id = (int) trim(fgets(STDIN));

        if ($id < 1) {
            fwrite(STDERR, "El id_prof no es válido.\n");
            exit(1);
        }

        $account['id_prof'] = $id;
    }

    $accounts[$user] = $account;
}

$file = dirname(__DIR__) . '/application/config/saes_accounts.php';

$content = "<?php\ndefined('BASEPATH') OR exit('No direct script access allowed');\n\$config['saes_accounts'] = " . var_export($accounts, true) . ";\n";

if (file_put_contents($file, $content) === false) {
    fwrite(STDERR, "No se pudo guardar la configuración de cuentas.\n");
    exit(1);
}

echo "Cuentas creadas correctamente.\n";