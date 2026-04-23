# VERMQEN Wiki Landing

Wiki modular para documentar el proyecto VERMQEN con una arquitectura mantenible en hosting compartido.

## Stack

- PHP 8.2+
- Slim 4
- Twig
- Bootstrap 5 + Bootstrap Icons
- Alpine.js

## Estructura

```text
app/
  Content/
  Controllers/
  Routes/
assets/
  css/
  js/
content/
resources/views/
index.php
```

## Ver la landing en local (antes de desplegar)

1. Instala dependencias:
   - `composer install`
2. Levanta servidor local:
   - `composer serve`
3. Abre en navegador:
   - `http://localhost:8080/` (landing principal)
   - `http://localhost:8080/flujo-github` (módulo inicial)
   - `http://localhost:8080/index.php?route=flujo-github` (fallback sin rewrite)

## Cómo desplegar (hosting compartido)

1. Subir el repositorio al hosting.
2. Ejecutar `composer install --no-dev --optimize-autoloader`.
3. Asegurar que Apache tenga `mod_rewrite` activo (se usa `.htaccess`).
4. Abrir el sitio.

Si el hosting no soporta rewrite, usa el fallback:

```text
/index.php?route=flujo-github
```

## Cómo agregar una nueva “ventana” de documentación

1. Abre `content/wiki-modules.php`.
2. Agrega una nueva entrada con slug único:
   - título (`title`)
   - resumen (`summary`)
   - introducción (`intro`)
   - pilares (`pillars`)
   - flujo (`workflow`)
   - checklist (`checklist`)
   - recursos (`resources`)
3. Guarda cambios y abre la ruta `/{slug}`.
4. La navegación y tarjetas de inicio se actualizan automáticamente.

## Aporte documental inicial integrado

- El archivo `flujo-github-vermqen.html` se conserva como aporte documental original.
- Está integrado dentro del módulo `flujo-github` como un bloque embebido (iframe).
- No es la vista principal; funciona como una fuente documental entre muchos aportes futuros.

## Nota importante de seguridad operativa

Este repositorio **solo** documenta y construye la wiki.  
No se debe tocar ni ejecutar comandos sobre el proyecto principal:

`/Users/melquiromero/Documents/GitHub/vermqen-laravel/`
