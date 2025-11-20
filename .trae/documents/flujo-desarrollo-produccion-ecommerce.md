# 🚀 Flujo Desarrollo-Producción E-commerce WordPress

## 📋 Resumen del Proceso

Este documento te guiará paso a paso para trabajar en desarrollo y pasar a producción de forma segura y sin errores.

**Entornos:**
- **Desarrollo:** `http://localhost:9000` (Ubuntu WSL)
- **Producción:** `https://andessuyo.com` (Linux VPS con Traefik)

**Tema:** Organify (modificaciones solo en tema hijo)

---

## 🔧 PASO 1: Preparación del Entorno de Desarrollo

### 1.1 Verificar estado actual
```bash
# Verificar que estás en el directorio correcto
cd /home/chris/PAT01-ECOM

# Verificar estado de Git
git status
git log -1 --oneline

# Verificar que el entorno no esté corriendo
docker-compose -f docker-compose.dev.yml ps
```

### 1.2 Levantar entorno de desarrollo
```bash
# Detener cualquier entorno activo
docker-compose -f docker-compose.dev.yml down

# Levantar entorno limpio
docker-compose -f docker-compose.dev.yml up -d

# Verificar que todo esté funcionando
docker-compose -f docker-compose.dev.yml ps
docker-compose -f docker-compose.dev.yml logs wordpress --tail=20
```

### 1.3 Verificar acceso
```bash
# Abrir en navegador:
# WordPress: http://localhost:9000
# phpMyAdmin: http://localhost:9001

# Verificar logs en tiempo real
docker-compose -f docker-compose.dev.yml logs -f wordpress
```

---

## 💻 PASO 2: Desarrollo Seguro en Tema Hijo

### 2.1 Reglas de Oro
- ✅ **SOLO** modificar en `/wordpress/themes/organify-child/`
- ❌ **NUNCA** tocar `/wordpress/themes/organify/`
- ✅ **SIEMPRE** validar sintaxis PHP antes de guardar

### 2.2 Estructura del tema hijo
```
wordpress/themes/organify-child/
├── style.css          # Estilos personalizados
├── functions.php      # Funciones personalizadas
├── screenshot.png     # Vista previa
└── templates/         # Templates personalizados
```

### 2.3 Validación obligatoria antes de guardar
```bash
# Validar sintaxis PHP (ejemplo para functions.php)
docker exec wp_app php -l /var/www/html/wp-content/themes/organify-child/functions.php

# Si hay error, mostrará: "Parse error..."
# Si está bien, mostrará: "No syntax errors detected"
```

### 2.4 Comandos útiles durante desarrollo
```bash
# Ver cambios en tiempo real
docker-compose -f docker-compose.dev.yml logs -f wordpress

# Reiniciar contenedor después de cambios
docker-compose -f docker-compose.dev.yml restart wordpress

# Acceder al contenedor para pruebas
docker exec -it wp_app bash
```

---

## 🧪 PASO 3: Pruebas y Validaciones

### 3.1 Checklist de validaciones
- [ ] WordPress carga sin errores: `http://localhost:9000`
- [ ] Tema hijo está activo en `/wp-admin/themes.php`
- [ ] No hay errores PHP en los logs
- [ ] Elementor funciona correctamente
- [ ] WooCommerce carga sin problemas

### 3.2 Comandos de verificación
```bash
# Verificar errores PHP recientes
docker-compose -f docker-compose.dev.yml logs wordpress | grep -i error

# Verificar versión de PHP y WordPress
docker exec wp_app wp core version
docker exec wp_app php --version

# Listar temas activos
docker exec wp_app wp theme list --status=active
```

### 3.3 Testing de funcionalidades
```bash
# Verificar plugins activos
docker exec wp_app wp plugin list --status=active

# Test de base de datos
docker exec wp_app wp db check

# Verificar usuarios
docker exec wp_app wp user list
```

---

## 📦 PASO 4: Preparación para Producción

### 4.1 Commit de cambios
```bash
# Verificar todos los cambios
git status

# Ver diferencias específicas
git diff wordpress/themes/organify-child/

# Agregar solo cambios del tema hijo
git add wordpress/themes/organify-child/

# Commit descriptivo
git commit -m "feat: [descripción breve del cambio]"

# Push al repositorio
git push origin main
```

### 4.2 Verificar repositorio remoto
```bash
# Ver últimos commits
git log --oneline -5

# Verificar estado remoto
git remote -v

# Verificar rama actual
git branch --show-current
```

---

## 🚀 PASO 5: Deploy a Producción

### 5.1 Conexión al servidor de producción
```bash
# Conectar por SSH (usa tu ruta real al archivo id_rsa)
ssh -i /ruta/al/archivo/id_rsa -p 22022 root@161.132.41.191
# Contraseña: P4tc0_2
```

### 5.2 En el servidor de producción
```bash
# Navegar al proyecto
cd /opt/PAT01-ECOM

# Verificar estado actual
git status
git log -1 --oneline

# Actualizar código
git pull origin main

# Verificar cambios
git diff HEAD~1 HEAD --name-only
```

### 5.3 Deploy con Docker
```bash
# Detener contenedores actuales
docker-compose -f docker-compose.prod.yml down

# Reconstruir y levantar
docker-compose -f docker-compose.prod.yml up -d --build

# Verificar estado
docker ps
docker-compose -f docker-compose.prod.yml logs wordpress --tail=20
```

---

## ✅ PASO 6: Verificación Post-Deploy

### 6.1 Verificaciones críticas
```bash
# Verificar que contenedores estén activos
docker ps

# Verificar logs sin errores
docker-compose -f docker-compose.prod.yml logs wordpress | grep -i error

# Verificar que WordPress responda
curl -I http://localhost

# Verificar HTTPS (desde tu computadora)
curl -I https://andessuyo.com
```

### 6.2 Testing en producción
- [ ] Sitio web carga: `https://andessuyo.com`
- [ ] WordPress admin: `https://andessuyo.com/wp-admin`
- [ ] WooCommerce funciona
- [ ] Elementor sin errores
- [ ] Certificado SSL válido

### 6.3 Si algo falla
```bash
# Ver logs completos
docker-compose -f docker-compose.prod.yml logs -f wordpress

# Reiniciar servicios
docker-compose -f docker-compose.prod.yml restart wordpress

# Verificar espacio en disco
df -h

# Volver a versión anterior (si es necesario)
git log --oneline -5
git revert [hash-del-commit]
```

---

## 🛡️ Puntos de Control de Seguridad

### Antes de cada deploy
- [ ] ✅ Tema hijo tiene header correcto
- [ ] ✅ No hay errores PHP en desarrollo
- [ ] ✅ Git está limpio y sincronizado
- [ ] ✅ Backup de producción actualizado
- [ ] ✅ Variables de entorno configuradas

### Después del deploy
- [ ] ✅ Sitio carga sin errores
- [ ] ✅ HTTPS funciona correctamente
- [ ] ✅ Admin de WordPress accesible
- [ ] ✅ No hay errores en logs
- [ ] ] Base de datos intacta

---

## 🚨 Solución de Problemas Comunes

### Error: "White Screen of Death"
```bash
# Activar debug temporal
docker exec wp_app wp config set WP_DEBUG true --raw
docker exec wp_app wp config set WP_DEBUG_LOG true --raw

# Ver errores
docker exec wp_app tail -f /var/www/html/wp-content/debug.log
```

### Error: "Error estableciendo conexión con la base de datos"
```bash
# Verificar contenedor MySQL
docker ps | grep mysql
docker-compose -f docker-compose.prod.yml logs mysql
```

### Error: 404 en páginas
```bash
# Refrescar permalinks
docker exec wp_app wp rewrite flush --hard
```

---

## 📞 Contacto y Emergencias

**Servidor de Producción:**
- IP: `161.132.41.191`
- Puerto SSH: `22022`
- Usuario: `root`
- Contraseña: `P4tc0_2`

**Comandos de emergencia:**
```bash
# Ver todos los contenedores (incluidos detenidos)
docker ps -a

# Ver logs del sistema
journalctl -u docker.service

# Reiniciar Docker (último recurso)
systemctl restart docker
```

---

## 📝 Checklist Final

- [ ] Entorno de desarrollo funcionando
- [ ] Cambios realizados en tema hijo
- [ ] Pruebas completadas
- [ ] Commit y push realizados
- [ ] Deploy a producción exitoso
- [ ] Verificaciones post-deploy completadas
- [ ] Sitio en producción funcionando correctamente

**¡Listo!** Tu e-commerce está ahora funcionando en producción con los cambios aplicados de forma segura.