# 📋 Reglas del Proyecto WordPress - Organify

## 🎯 Información General del Proyecto

**Proyecto:** E-commerce WordPress con tema Organify  
**Entorno Local:** Windows 11 con Docker  
**Entorno Producción:** Linux VPS con Traefik  
**Tema Principal:** `organify` (NO MODIFICAR DIRECTAMENTE)  
**Tema Hijo:** `organify-child` (TODAS las modificaciones aquí)  
**WordPress:** 6.8.2 con PHP 8.1  
**Base de Datos:** MariaDB 10.11  

---

## 🤖 Principios Fundamentales para el Agente

### 1. Precisión y Comprensión del Objetivo
- **SIEMPRE** entender completamente la solicitud antes de actuar
- **PREGUNTAR** si hay ambigüedad en los requerimientos
- **VERIFICAR** el contexto del proyecto antes de hacer cambios
- **USAR** toda la información disponible (archivos, historial, configuraciones)

### 2. Verificación y Validación
- **CONFIRMAR** que los cambios no rompen funcionalidad existente
- **VALIDAR** sintaxis PHP antes de aplicar cambios
- **PROBAR** que el código funciona en el contexto del proyecto
- **REVISAR** dependencias y compatibilidad

### 3. Manejo de Errores y Debugging
- **IDENTIFICAR** la causa raíz de los problemas, no solo síntomas
- **IMPLEMENTAR** logging claro para debugging
- **ANTICIPAR** puntos de falla potenciales
- **DOCUMENTAR** soluciones aplicadas

### 4. Integración y Consistencia
- **VERIFICAR** que el código nuevo se integra correctamente
- **MANTENER** consistencia con APIs existentes
- **SEGUIR** convenciones establecidas del proyecto
- **EVITAR** duplicación de código existente

---

## 🐳 Reglas de Entorno y Docker

### 1. Comandos Docker Obligatorios

**DESARROLLO LOCAL (Windows):**
```bash
# Levantar entorno - SIEMPRE usar este comando
docker-compose -f docker-compose.dev.yml up -d

# Detener entorno
docker-compose -f docker-compose.dev.yml down

# Ver logs en tiempo real
docker-compose -f docker-compose.dev.yml logs -f

# Reconstruir contenedores después de cambios
docker-compose -f docker-compose.dev.yml up -d --build
```

**PRODUCCIÓN (Linux VPS):**
```bash
# Aplicar cambios en producción
docker-compose -f docker-compose.prod.yml down
docker-compose -f docker-compose.prod.yml up -d --build
```

### 2. Configuración de Puertos

**DESARROLLO (Windows):**
- WordPress: `http://localhost:9000`
- phpMyAdmin: `http://localhost:9001`
- MySQL: Puerto interno 3306 (no expuesto)

**PRODUCCIÓN (Linux):**
- WordPress: Gestionado por Traefik (HTTPS automático)
- MySQL: Puerto interno 3306

### 3. Variables de Entorno

**OBLIGATORIO:**
- Crear `.env` basado en `.env.example`
- NUNCA commitear `.env` al repositorio
- SIEMPRE usar variables para credenciales sensibles

**VALIDACIÓN REQUERIDA:**
```bash
# Verificar que .env existe y no está en Git
ls -la .env
git status | grep -v ".env"
```

---

## 🎨 Reglas de WordPress y Temas

### 1. Tema Principal (organify) - PROHIBICIONES ABSOLUTAS

**❌ NUNCA HACER:**
- Modificar archivos en `/wordpress/themes/organify/`
- Editar directamente archivos del tema padre
- Sobrescribir funciones del tema padre sin usar tema hijo

**✅ RAZÓN:**
- Es un tema comercial que se actualiza
- Los cambios se perderían en actualizaciones
- Viola mejores prácticas de WordPress

### 2. Tema Hijo (organify-child) - TODAS LAS MODIFICACIONES

**UBICACIÓN OBLIGATORIA:** `/wordpress/themes/organify-child/`

**ESTRUCTURA REQUERIDA:**
```
organify-child/
├── style.css           # Header del tema hijo (OBLIGATORIO)
├── functions.php       # Funciones personalizadas (NO function.php)
├── screenshot.png      # Captura del tema (opcional)
└── templates/          # Templates personalizados (si necesario)
```

**VALIDACIÓN DE ARCHIVOS:**
- ✅ `functions.php` (correcto)
- ❌ `function.php` (incorrecto - error común)

### 3. Header Obligatorio para style.css

```css
/*
Theme Name: Organify Child
Description: Tema hijo para Organify
Template: organify
Version: 1.0.0
*/
```

### 4. Estructura Base de functions.php

```php
<?php
/**
 * Funciones del tema hijo Organify
 * 
 * @package Organify Child
 * @since 1.0.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Cargar estilos del tema padre
add_action('wp_enqueue_scripts', 'organify_child_enqueue_styles');
function organify_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// Configurar textdomain (WordPress 6.7.0+)
add_action('after_setup_theme', 'organify_child_setup');
function organify_child_setup() {
    load_child_theme_textdomain('organify-child', get_stylesheet_directory() . '/languages');
}
```

---

## 💻 Reglas de Código y Desarrollo

### 1. Estándares de Código WordPress

**OBLIGATORIO SEGUIR:**
- WordPress Coding Standards estrictamente
- Indentación: 4 espacios (no tabs)
- Nomenclatura: `snake_case` para funciones PHP
- Nomenclatura: `camelCase` para JavaScript
- Idioma: Español peruano (es_PE) para contenido

### 2. Documentación de Código

**FORMATO OBLIGATORIO:**
```php
/**
 * Descripción clara de la función en español
 *
 * @param string $parametro Descripción del parámetro
 * @return bool Descripción del valor de retorno
 * @since 1.0.0
 */
function mi_funcion_personalizada($parametro) {
    // Validar entrada
    if (empty($parametro)) {
        return false;
    }
    
    // Lógica de la función
    return true;
}
```

### 3. Principios de Desarrollo

- **DRY:** No repetir código
- **SRP:** Una función, una responsabilidad
- **MODULAR:** Separar funcionalidades complejas
- **SEGURO:** Validar y sanitizar todas las entradas
- **TESTEABLE:** Código que se pueda probar fácilmente

### 4. Validación de Sintaxis

**ANTES de aplicar cambios:**
```bash
# Validar sintaxis PHP
docker exec wp_app php -l /var/www/html/wp-content/themes/organify-child/functions.php
```

---

## 🔒 Reglas de Seguridad

### 1. Credenciales y Datos Sensibles

**PROHIBIDO ABSOLUTO:**
- Hardcodear contraseñas, tokens o API keys
- Exponer credenciales en logs o código
- Commitear archivos con datos sensibles

**OBLIGATORIO:**
- Usar variables de entorno para todo dato sensible
- Validar que `.env` esté en `.gitignore`
- Sanitizar todas las entradas de usuario

### 2. Archivos Sensibles - NUNCA Commitear

```
❌ PROHIBIDO EN GIT:
├── .env                    # Variables de entorno reales
├── wp-config.php          # Configuración WordPress
├── wordpress/uploads/     # Archivos subidos por usuarios
├── wordpress/cache/       # Archivos de caché
├── *.log                  # Archivos de logs
├── *.sql                  # Backups de base de datos
└── node_modules/          # Dependencias Node.js
```

### 3. Permisos de Archivos

- **Directorios:** 755
- **Archivos PHP:** 644
- **wp-config.php:** 600 (si existe)

---

## 🔄 Reglas de Git y Control de Versiones

### 1. Flujo de Trabajo Git Obligatorio

**PROCESO PASO A PASO:**
```bash
# 1. SIEMPRE verificar estado actual
git status

# 2. Revisar cambios antes de agregar
git diff

# 3. Agregar archivos específicos (NUNCA usar git add .)
git add wordpress/themes/organify-child/functions.php
git add docker-compose.dev.yml

# 4. Commit con mensaje descriptivo
git commit -m "feat: agregar función personalizada para checkout"

# 5. Subir al repositorio
git push origin main
```

### 2. Estructura de Commits

**PREFIJOS OBLIGATORIOS:**
- `feat:` - Nueva funcionalidad
- `fix:` - Corrección de errores
- `docs:` - Cambios en documentación
- `style:` - Cambios de CSS/formato
- `refactor:` - Refactorización sin cambios funcionales
- `config:` - Cambios en configuración Docker/WordPress

**EJEMPLOS CORRECTOS:**
```bash
git commit -m "feat: agregar validación de formulario de contacto"
git commit -m "fix: corregir error de carga de estilos en tema hijo"
git commit -m "config: actualizar puertos en docker-compose.dev.yml"
```

### 3. Archivos Críticos para el Repositorio

**✅ SIEMPRE INCLUIR:**
- `docker-compose.dev.yml` (desarrollo)
- `docker-compose.prod.yml` (producción)
- `wordpress/themes/organify-child/` (tema hijo completo)
- `.gitignore` (exclusiones)
- `README.md` (documentación)
- `.trae/rules/project_rules.md` (estas reglas)

### 4. Comandos de Verificación Pre-Commit

```bash
# Verificar archivos modificados
git status

# Ver diferencias específicas
git diff wordpress/themes/organify-child/

# Verificar último commit
git log -1 --oneline

# Asegurar que no hay archivos sensibles
git ls-files | grep -E "\.(env|log)$" || echo "OK - No hay archivos sensibles"
```

---

## 🚀 Reglas de Deploy y Producción

### 1. Acceso al Servidor de Producción

**COMANDOS SSH:**
```bash
# Conectar al servidor
ssh root@161.132.41.191
# Contraseña: P4tc0_2

# Navegar al proyecto
cd ../opt/PAT01-ECOM

# Verificar estado
git status
git log -1 --oneline
```

### 2. Proceso de Deploy Completo

**DESARROLLO → PRODUCCIÓN:**
```bash
# 1. EN DESARROLLO LOCAL (Windows)
git status
git add wordpress/themes/organify-child/
git commit -m "feat: descripción del cambio"
git push origin main

# 2. EN SERVIDOR DE PRODUCCIÓN (Linux)
ssh root@161.132.41.191
cd ../opt/PAT01-ECOM
git pull origin main
docker-compose -f docker-compose.prod.yml down
docker-compose -f docker-compose.prod.yml up -d --build

# 3. VERIFICACIÓN OBLIGATORIA
docker ps
docker-compose -f docker-compose.prod.yml logs wordpress
curl -I http://localhost
```

### 3. Comandos de Verificación Post-Deploy

```bash
# Estado de contenedores
docker ps

# Logs de la aplicación
docker-compose -f docker-compose.prod.yml logs -f wordpress

# Verificar conectividad
curl -I http://localhost

# Espacio en disco
df -h

# Logs del sistema (si hay problemas)
tail -f /var/log/syslog
```

---

## 🤖 Reglas Específicas para el Agente

### 1. Comandos Permitidos

**✅ PERMITIDOS:**
```bash
# Docker para desarrollo
docker-compose -f docker-compose.dev.yml [comando]
docker exec wp_app [comando]
docker logs wp_app

# Edición de archivos
# Solo en /wordpress/themes/organify-child/
```

### 2. Comandos PROHIBIDOS

**❌ NUNCA EJECUTAR:**
```bash
# Modificaciones prohibidas
# Cualquier cambio en /wordpress/themes/organify/
# Uso directo de docker-compose.yml
# Edición directa de wp-config.php
# Comandos que afecten el sistema host
```

### 3. Procedimiento de Validación Obligatorio

**ANTES de cualquier cambio:**
1. ✅ Verificar que el archivo está en `organify-child`
2. ✅ Validar sintaxis PHP con `php -l`
3. ✅ Comprobar que no rompe funcionalidad existente
4. ✅ Documentar el cambio en comentarios
5. ✅ Probar en entorno de desarrollo

### 4. Manejo de Errores

**SI encuentras errores:**
1. **Revisar logs:** `docker-compose -f docker-compose.dev.yml logs wordpress`
2. **Verificar sintaxis:** `docker exec wp_app php -l [archivo]`
3. **Comprobar permisos:** `ls -la [archivo]`
4. **Validar configuración:** Revisar variables de entorno

### 5. Procedimiento de Modificación de Tema

**PROCESO OBLIGATORIO:**
1. **IDENTIFICAR** qué archivo del tema padre necesita modificación
2. **COPIAR** el archivo a `organify-child` (si es template)
3. **MODIFICAR** solo en el tema hijo
4. **PROBAR** que funciona correctamente
5. **DOCUMENTAR** el cambio en comentarios del código

---

## 📁 Estructura de Archivos del Proyecto

```
PAT01-ECOM/
├── .env                          # Variables de entorno (NO commitear)
├── .env.example                  # Plantilla de variables
├── .gitignore                    # Archivos ignorados por Git
├── docker-compose.dev.yml        # DESARROLLO (Windows)
├── docker-compose.prod.yml       # PRODUCCIÓN (Linux)
├── README.md                     # Documentación del proyecto
├── wordpress/
│   ├── themes/
│   │   ├── organify/             # TEMA PADRE (NO MODIFICAR)
│   │   └── organify-child/       # TEMA HIJO (TODAS las modificaciones)
│   │       ├── style.css         # Header del tema hijo
│   │       ├── functions.php     # Funciones personalizadas
│   │       └── templates/        # Templates personalizados
│   ├── plugins/                  # Plugins del proyecto
│   └── languages/                # Archivos de idioma (es_PE)
├── .trae/
│   └── rules/
│       └── project_rules.md      # Este archivo de reglas
└── backups/                      # Backups locales (NO commitear)
```

---

## 🚨 Recordatorios Críticos para el Agente

### 1. Validaciones Obligatorias
- ✅ **NUNCA** modificar el tema padre `organify`
- ✅ **SIEMPRE** usar `docker-compose.dev.yml` para desarrollo
- ✅ **VERIFICAR** que `functions.php` tenga el nombre correcto
- ✅ **PROBAR** todos los cambios antes de commitear
- ✅ **DOCUMENTAR** todas las modificaciones importantes

### 2. Seguridad y Mejores Prácticas
- ✅ **USAR** variables de entorno para configuraciones sensibles
- ✅ **VALIDAR** sintaxis PHP antes de aplicar cambios
- ✅ **SEGUIR** WordPress Coding Standards
- ✅ **MANTENER** código limpio y documentado

### 3. Flujo de Trabajo
- ✅ **DESARROLLO** → **TESTING** → **COMMIT** → **DEPLOY**
- ✅ **VERIFICAR** que el repositorio esté sincronizado
- ✅ **CONFIRMAR** que el deploy funciona correctamente

