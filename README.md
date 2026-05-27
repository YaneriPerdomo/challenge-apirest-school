# Challenge API - Sistema de Gestión Escolar

Este repositorio contiene la resolución de la **Prueba Técnica para Desarrollador Backend**, consistente en una API RESTful desarrollada con **Laravel** y **MySQL** para la administración de alumnos, asignaturas, profesores y calificaciones.

---

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado y configurado uno de los siguientes servidores locales:
* **Laragon** (Recomendado por su gestión automática de Virtual Hosts)
* **XAMPP**

---

## Guía de Instalación Paso a Paso

Sigue estos pasos en tu terminal para clonar, configurar y ejecutar el proyecto localmente.

### 1. Clonar el Repositorio
Abre tu terminal dentro de la carpeta raíz de tu servidor local (por ejemplo, `C:/laragon/www/` o `C:/xampp/htdocs/`) y ejecuta:
```bash
git clone [https://github.com/YaneriPerdomo/challenge-apirest-school.git](https://github.com/YaneriPerdomo/challenge-apirest-school.git)
cd challenge-apirest-school
```

### 2. Instalar Dependencias
Asegúrate de tener Composer instalado. Luego, ejecuta:
```bash
composer install
```

### 3. Configurar Variables de Entorno
Copia el archivo de ejemplo `.env.example` a `.env`:
```
cp .env.example .env
```
Luego, edita el archivo `.env` para configurar la conexión a tu base de datos My SQL. Asegúrate de que los valores coincidan con tu configuración local:
```env
DB_CONNECTION=mysql 
DB_HOST=127.0.0.1  
DB_PORT=3306 o el puerto que uses para MySQL 
DB_DATABASE=challenge_apirest_school
DB_USERNAME=root o tu_usuario_mysql 
DB_PASSWORD=tu_contraseña o dejalo vacío si no tienes contraseña
```
### 4. Generar la Clave de la Aplicación
Ejecuta el siguiente comando para generar la clave de la aplicación:
```bash
php artisan key:generate
```
### 5. Ejecutar Migraciones y Seeders
Para crear las tablas en la base de datos y poblarlas con datos de prueba, ejecuta:
```bash
php artisan migrate db:seed
```
### 6. Iniciar el Servidor de Desarrollo
Finalmente, inicia el servidor de desarrollo con:
```bash
php artisan serve
```
Esto hará que la API esté disponible en `http://localhost:8000`.

[📥 Descargar Enunciado de la Prueba Técnica (PDF)](public/doc/Challenge_API_Desarrollador.pdf)

Ing. Sistemas | Yaneri Perdomo
