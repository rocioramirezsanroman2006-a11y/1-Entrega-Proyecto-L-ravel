@echo off
echo Esperando que MySQL este listo...
timeout /t 15 /nobreak

echo.
echo Ejecutando setup de base de datos...
echo.

"c:\xampp\mysql\bin\mysql.exe" -uroot nombre_proyecto < "setup_database.sql"

if errorlevel 1 (
    echo.
    echo ERROR: Hubo un problema ejecutando el SQL.
    echo Intenta ejecutar esto en phpMyAdmin en su lugar.
    pause
) else (
    echo.
    echo ✓ Base de datos configurada exitosamente!
    echo.
    pause
)
