<?php

declare(strict_types=1);

return [
    'category'       => 'devops',
    'category_label' => 'DevOps & Entorno',
    'template'       => 'modules/manual.twig',
    'nav'            => 'Config Email',
    'title'          => 'Configuración de Correos',
    'tag'            => 'DevOps',
    'summary'        => 'Configuración del entorno local para el envío de correos.',
    'intro'          => 'Pasos para habilitar y configurar el envío de correos en local, además de atajos para omitir la confirmación mediante Tinker.',
    'email_setup'    => [
        'title'       => 'Configuración de Correos y Creación de Usuario Local',
        'description' => 'Para el envío de correos y confirmación de cuentas en local, puedes configurar el servicio SMTP de Gmail en el `.env`. Si prefieres evitar este paso y saltar la confirmación, puedes crear un usuario ya verificado directamente mediante consola interactiva (Tinker) sin crear archivos adicionales.',
        'steps'       => [
            [
                'icon'        => 'bi-envelope-at',
                'label'       => '1. Configuración de correo con Gmail en .env',
                'path'        => '.env',
                'description' => 'Para usar Gmail, ve a la "Gestión de tu cuenta de Google", activa la "Verificación en dos pasos" (si no la tienes activa) y crea una "Contraseña de aplicación". Copia la clave generada de 16 letras y colócala en MAIL_PASSWORD.<br><div class="row g-3 mt-2"><div class="col-md-6"><img src="/assets/img/pass-app-1.png" class="img-fluid rounded border border-secondary-subtle" alt="Generación de contraseña"></div><div class="col-md-6"><img src="/assets/img/pass-app-2.png" class="img-fluid rounded border border-secondary-subtle" alt="Clave de 16 caracteres"></div></div>',
                'example'     => "MAIL_MAILER=smtp\nMAIL_HOST=smtp.gmail.com\nMAIL_PORT=587\nMAIL_USERNAME=\"tu_correo@gmail.com\"\nMAIL_PASSWORD=\"xxxx xxxx xxxx xxxx\"\nMAIL_ENCRYPTION=tls\nMAIL_FROM_ADDRESS=\"tu_correo@gmail.com\"\nMAIL_FROM_NAME=\"\${APP_NAME}\"",
            ],
            [
                'icon'        => 'bi-terminal-fill',
                'label'       => '2. Crear usuario verificado con Tinker',
                'path'        => 'Terminal',
                'description' => 'Ejecuta `php artisan tinker` para interactuar con la base de datos y crea un usuario con la fecha actual en `email_verified_at` para omitir la confirmación por correo.',
                'example'     => "php artisan tinker\n\nuse App\\Models\\User;\n\nUser::create([\n    'name' => 'Usuario Admin',\n    'email' => 'admin@ejemplo.com',\n    'password' => 'Secreta123', // Usar bcrypt('Secreta123') si el modelo no tiene el cast automático\n    'rol' => 'Admin',\n    'active' => true,\n    'email_verified_at' => now(),\n]);",
            ],
        ],
    ],
];