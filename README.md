🟦 Turnero En Vivo — UTN FSA

Sistema de turnos en tiempo real desarrollado con Laravel + Livewire + Tailwind + Pusher

🚀 Descripción general

● Proyecto web desarrollado en Laravel 12, Livewire 3 y Tailwind CSS 3, que permite:

• Generar turnos desde el kiosco
• Gestionarlos desde un puesto (llamar, atender, marcar ausente, cerrar turno)
• Visualizarlos en una pantalla tipo TV en tiempo real
• Reproducir un sonido (“ding.mp3”) cada vez que se llama a un turno
• Integración con Pusher + Laravel Echo para actualizaciones instantáneas
• Modo claro/oscuro en la aplicación
• Base de datos lista para usar con SQLite o MySQL

✨ Características principales

🖥️ Interfaz moderna

Diseño limpio y responsivo con Tailwind
Modo oscuro / claro
Pantalla tipo TV profesional como las de bancos/organismos

🎧 Tiempo real

Actualización automática en la pantalla con Pusher
Sonido “ding” al llamar un turno
Eventos Livewire totalmente integrados

🏷️ Gestión completa

Kiosco: emisión de turnos
Puesto: llamar, re-llamar, atender, marcar ausente, cerrar
Prioritarios
Vista TV mostrando últimos llamados y cola de espera

⚙️ Tecnología

Laravel 12
PHP 8.2+
Livewire 3
Tailwind CSS
Laravel Echo + Pusher
SQLite / MySQL
Vite

📦 Instalación


1️⃣ Clonar el repositorio

git clone https://github.com/TuUsuario/turnero-utn-fsa
cd turnero-utn-fsa


2️⃣ Instalar dependencias

PHP (Composer)
composer install

Frontend (Node)
npm install


3️⃣ Configurar entorno


Copiar archivo de ejemplo:

cp .env.example .env


Editar las variables más importantes:

APP_NAME="Turnero En Vivo UTN-FSA"
APP_ENV=local
APP_KEY=
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

database/database.sqlite

4️⃣ Generar key y migrar base
php artisan key:generate
php artisan migrate --seed

5️⃣ Compilar frontend
npm run dev


• Esto activa Vite, compila Tailwind y Livewire, y recarga en tiempo real.

6️⃣ Iniciar el servidor Laravel
php artisan serve


Acceder en:

👉 http://127.0.0.1:8000

🧩 Estructura de módulos

/kiosco → Emisión de turnos
/puesto → Panel de agentes para llamar/atender
/pantalla → Visualización tipo TV con actualizaciones en vivo

📸 Vistas del sistema

Vista	                                                 Descripción
🟦 Pantalla TV	            Muestra últimos llamados, turnos en cola e imagen corporativa
🔵 Puesto	                El agente llama, atiende, re-llama o finaliza turnos
🟩 Kiosco                 	Selección de servicio y emisión de turnos
📡 Tiempo real con Pusher

Cada vez que un puesto llama a un turno:

Se dispara evento TurnoLlamado
La pantalla lo recibe mediante Laravel Echo
Se actualiza la UI en tiempo real
Se reproduce el sonido ding.mp3

👨‍💻 Autor

Desarrollado en el marco de la Tecnicatura Universitaria en Programación (UTN-FSA).

✔️ Listo para usar y presentar


Este README ya está optimizado para GitHub:

Con estilos
Emojis
Secciones ordenadas
Código legible
Instrucciones claras para cualquier profesor o usuario
