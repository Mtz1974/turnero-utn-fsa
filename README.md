# 🟦 Turnero En Vivo — UTN FSA

Sistema de gestión de turnos en tiempo real desarrollado con **Laravel 12 + Livewire 3 + Tailwind CSS + Pusher**.

---

## 🚀 Descripción general

Aplicación web que permite:

- 🏷️ **Generar turnos** desde un kiosco  
- 👨‍💼 **Gestionarlos desde un puesto** (llamar, re-llamar, atender, marcar ausente, cerrar)  
- 📺 **Mostrar turnos en una pantalla tipo TV**, con actualizaciones en tiempo real  
- 🔊 **Reproducir un sonido "ding.mp3"** cada vez que se llama a un turno  
- 🌗 **Modo oscuro / claro**  
- ⚡ **Integración con Pusher + Laravel Echo**  
- 🗄️ Base de datos compatible con **SQLite o MySQL**

---

## ✨ Características principales

### 🖥️ Interfaz moderna  
- Diseño profesional y responsivo con Tailwind  
- Modo oscuro / claro integrado  
- UI tipo panel corporativo  

### 🎧 Tiempo real  
- Actualización automática de la pantalla con Pusher  
- Sonido al llamar turnos  
- Eventos Livewire totalmente integrados  

### 🏷️ Gestión completa  
- `/kiosco` — Emisión de turnos  
- `/puesto` — Panel del agente para gestionar  
- `/pantalla` — Pantalla TV con últimos llamados + cola  

---

## ⚙️ Tecnologías

- **Laravel 12**  
- **PHP 8.2+**  
- **Livewire 3**  
- **Tailwind CSS 3**  
- **Laravel Echo + Pusher**  
- **SQLite / MySQL**  
- **Vite**

---

## 📦 Instalación

### 1️⃣ Clonar el repositorio

```bash
git clone https://github.com/TuUsuario/turnero-utn-fsa

cd turnero-utn-fsa

2️⃣ Instalar dependencias

Backend (Composer)

composer install

Frontend (Node)

npm install

3️⃣ Configurar entorno

Copiar archivo de ejemplo:

cp .env.example .env
Editar las variables principales del .env:


APP_NAME="Turnero En Vivo UTN-FSA"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=2076628
PUSHER_APP_KEY=fd256a6560e3c7ac7c0b
PUSHER_APP_SECRET=4b2cfaee98f4e6d6d81c
PUSHER_APP_CLUSTER=sa1
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_USE_TLS=true

📌 Si usás SQLite, asegurate de crear el archivo:

mkdir -p database
touch database/database.sqlite

4️⃣ Generar Key y migraciones

php artisan key:generate
php artisan migrate --seed

5️⃣ Compilar frontend

npm run dev

Esto activa Vite, compila Tailwind y Livewire y recarga todo en tiempo real.

6️⃣ Iniciar el servidor Laravel

php artisan serve
Acceder en:

👉 http://127.0.0.1:8000

🧩 Estructura de módulos
Ruta	Función
/kiosco	Emisión de turnos
/puesto	Gestión por agentes
/pantalla	Visualización TV en tiempo real

📸 Vistas del sistema
🟦 Pantalla TV
Últimos turnos llamados

Cola de espera

Imagen corporativa

Actualización automática vía Pusher

🔵 Puesto
Agente llama, atiende, re-llama o finaliza turnos

🟩 Kiosco
Selección de servicio

Emisión instantánea del turno

🔊 Funcionamiento del sonido
Cada vez que un puesto llama un turno:

Se dispara evento TurnoLlamado

/pantalla lo recibe vía Laravel Echo + Pusher

La UI se actualiza automáticamente

Se reproduce "ding.mp3"

👨‍💻 Autor
Proyecto desarrollado como parte de la Tecnicatura Universitaria en Programación (UTN-FSA).

✔️ Listo para usar y presentar
Este README está:

🔹 Muy legible

🔹 Optimizado para GitHub

🔹 Bien estructurado

🔹 Con emojis y secciones claras

🔹 Con instrucciones completas

¡Ideal para entregar a profesores, subir a portfolio o presentar en una entrevista!