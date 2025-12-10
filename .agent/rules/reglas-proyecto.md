---
trigger: always_on
---

# 📋 Reglas Técnicas del Proyecto - Organify E-commerce

## 1. 🎯 Información Técnica
- **Stack:** WordPress 6.8.2 | PHP 8.1 | MariaDB 10.11 | Traefik
- **Tema Base:** `organify` (⛔ PROHIBIDO EDITAR)
- **Tema Hijo:** `organify-child` (✅ ZONA DE EDICIÓN)
- **Entorno Local:** Docker (Windows/WSL)
- **Entorno Prod:** Docker (Linux VPS)

## 2. 🐳 Docker y Comandos Críticos
El proyecto usa un único `docker-compose.yml` con **Perfiles**.

| Acción | Comando (Ejecutar en raíz del proyecto) |
|--------|-----------------------------------------|
| **Dev Up** | `docker-compose --profile development up -d` |
| **Dev Logs** | `docker-compose --profile development logs -f wordpress` |
| **Dev Restart**| `docker-compose --profile development restart wordpress` |
| **Prod Up** | `docker-compose --profile production up -d` |
| **Verificación**| `docker ps` y `curl -I http://localhost` |
| **PHP Lint** | `docker exec wp_app php -l /var/www/html/wp-content/themes/organify-child/functions.php` |

**Notas:**
- En desarrollo (local), WordPress responde en dominios `.nip.io` (ej. `ecom.192.168.18.190.nip.io`).
- En producción, Traefik gestiona los certificados HTTPS automáticamente.

## 3. 🎨 Desarrollo Themes WordPress (ESTRICTO)

### 3.1 Integridad del Tema
- **❌ NUNCA:** Tocar `/themes/organify/`. Los cambios se pierden al actualizar.
- **✅ SIEMPRE:** Trabajar en `/themes/organify-child/`.
- **Ruta Absoluta:** `/home/chris/PAT01-ECOM/wordpress/themes/organify-child/`

### 3.2 Estructura del Tema Hijo
```
organify-child/
├── style.css           # Header requerido (Template: organify)
├── functions.php       # Lógica PHP (NO function.php)
├── scripts/            # JS personalizado
├── templates/          # Sobrescritura de templates padre
└── woocommerce/        # Sobrescritura de templates Woo
```

### 3.3 snippet: Cargar hoja de estilos padre
En `functions.php`:
```php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
});
```

### 3.4 Coding Standards
- **PHP:** PSR-12 / WordPress standards. Snake_case para funciones (`mi_funcion_custom`).
- **JS:** CamelCase (`miFuncionJS`).
- **Validación:** Ejecutar `php -l` (lint) antes de cualquier commit.
- **Seguridad:** Sanitizar TODAS las entradas (`sanitize_text_field`, `absint`) y escapar salidas (`esc_html`, `esc_url`).

## 4. 🔒 Configuración y Seguridad
- **.env:** Fuente única de verdad. **NUNCA COMMITEAR**.
- **Logs:** Centralizados en `./logs/`.
- **Permisos:** Directorios `755`, Archivos `644`.

## 5. 🚀 Flujo de Despliegue (Deploy)

### 5.1 Local (Dev)
1.  `git status` (Ver cambios)
2.  `docker exec wp_app php -l [archivo]` (Validar sintaxis)
3.  `git add .` -> `git commit -m "feat: descripción"` -> `git push`

### 5.2 Producción (VPS)
```bash
ssh -i /ruta/id_rsa -p 22022 root@161.132.41.191
cd ../opt/PAT01-ECOM
git pull origin main
# Si hay cambios en infraestructura/docker:
docker-compose --profile production up -d --build
# Si son solo archivos PHP/JS, los cambios se reflejan inmediatamente (volúmenes).
```

## 6. 📂 Estructura de Directorios Clave
```
PAT01-ECOM/
├── .env                     # Configuración (Ignorado)
├── docker-compose.yml       # Orquestación
├── wordpress/
│   ├── themes/
│   │   ├── organify/        # 🔒 LOCK (No tocar)
│   │   └── organify-child/  # ✏️ EDITAR AQUÍ
│   └── plugins/
└── logs/                    # Logs del sistema
```
