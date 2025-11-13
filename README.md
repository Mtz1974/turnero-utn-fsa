🎫 Turnero En Vivo — UTN-FSA

Sistema web desarrollado en Laravel 12 + Livewire 3 + Tailwind CSS + Pusher, que permite gestionar y visualizar turnos en tiempo real para un kiosco o mesa de atención.

🚀 Características principales

✅ Interfaz profesional, adaptable a modo claro/oscuro.
✅ Panel del puesto para llamar, atender, cerrar o marcar ausentes.
✅ Pantalla TV con actualizaciones en tiempo real vía Pusher/Echo.
✅ Sonido de aviso (ding.mp3) cuando se llama a un nuevo turno.
✅ Integración con SQLite o MySQL según preferencia.
✅ Código modular con componentes Livewire organizados.

🧰 Tecnologías utilizadas
Componente	Versión	Descripción
Laravel	12.x	Framework backend principal
PHP	8.2+	Lenguaje de backend
Livewire	3.x	Interactividad en tiempo real sin JS personalizado
TailwindCSS	3.x	Estilos responsive y minimalistas
Vite	—	Compilador de assets
Pusher	—	Comunicación en tiempo real para eventos de turnos
SQLite/MySQL	—	Base de datos configurable en .env
⚙️ Instalación y configuración
1️⃣ Clonar el repositorio
git clone https://github.com/TuUsuarioGitHub/turnero-utn-fsa.git
cd turnero-utn-fsa

2️⃣ Instalar dependencias
composer install
npm install

3️⃣ Configurar entorno

Copiá el archivo de ejemplo:

cp .env.example .env


Y completá las variables más importantes dentro del .env:

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


Luego ejecutá:

php artisan key:generate
php artisan migrate --seed


(Si usás SQLite, asegurate de tener el archivo database/database.sqlite creado manualmente).

4️⃣ Compilar el frontend
npm run dev


Esto activa Vite y carga los assets de Tailwind, Livewire y el tema oscuro.

5️⃣ Levantar el servidor
php artisan serve


Accedé a tu aplicación en:

👉 http://127.0.0.1:8000

🎥 Vista de componentes
Módulo	Ruta	Descripción
/kiosco	Interfaz para clientes que solicitan turnos	
/puesto	Panel del puesto con botones de control	
/pantalla	Visualización tipo TV con turnos y avisos	