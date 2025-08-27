@echo off
setlocal enabledelayedexpansion

echo ========================================
echo    WordPress Docker - Toggle Development
echo ========================================
echo.

echo Verificando estado de los contenedores...
echo.

:: Verificar si los contenedores están corriendo
docker-compose -f docker-compose.dev.yml ps -q > temp_containers.txt 2>nul

:: Contar líneas no vacías en el archivo temporal
set "container_count=0"
for /f "tokens=*" %%i in (temp_containers.txt) do (
    if not "%%i"=="" (
        set /a container_count+=1
    )
)

:: Limpiar archivo temporal
del temp_containers.txt 2>nul

if !container_count! gtr 0 (
    echo [INFO] Contenedores detectados corriendo. Deteniendo...
    echo.
    docker-compose -f docker-compose.dev.yml down
    echo.
    echo [SUCCESS] Contenedores detenidos correctamente.
) else (
    echo [INFO] No hay contenedores corriendo. Iniciando ambiente de desarrollo...
    echo.
    docker-compose -f docker-compose.dev.yml up -d
    echo.
    echo [SUCCESS] Ambiente de desarrollo iniciado.
    echo.
    echo Servicios disponibles:
    echo - WordPress: http://localhost:8080
    echo - phpMyAdmin: http://localhost:8081
)

echo.
echo ========================================
echo Presiona cualquier tecla para salir...
pause >nul