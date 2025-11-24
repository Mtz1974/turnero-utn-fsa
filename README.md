🟦 Turnero En Vivo — UTN FSA

Sistema de turnos en tiempo real desarrollado con Laravel 12, Livewire 3, Tailwind CSS, y WebSockets reales usando Laravel Reverb + Laravel Echo.

Proyecto académico realizado en la Tecnicatura Universitaria en Programación – UTN Facultad Regional Formosa, simulando un sistema de turnos similar al de bancos, hospitales u organismos públicos.

⭐ Descripción general

El sistema permite:

🧾 Emitir turnos desde un kiosco (sin autenticación)

🎛️ Gestionar turnos desde un panel de puesto
(llamar, atender, re-llamar, marcar ausente, cerrar)

🧩 Asignar módulo (Módulo 1 al 5)

📺 Mostrar turnos en una pantalla tipo TV en tiempo real

🔔 Reproducir sonido "ding.mp3" al llamar un turno

🌐 Actualización instantánea mediante WebSockets

🌗 Modo claro / oscuro en toda la aplicación

📌 Módulos principales

/ — Welcome (explicación del sistema + accesos rápidos)

/kiosco — Emisión de turnos por parte del público

/puesto — Panel de agente/admin (login requerido)

/pantalla — Pantalla tipo TV para visualizar turnos en tiempo real

🛠️ Tecnologías utilizadas
Backend

PHP 8.2+

Laravel 12

Livewire 3

Laravel Reverb (WebSockets)

Laravel Echo

Frontend

Tailwind CSS 3

Vite

Alpine.js

Tiempo real

Broadcasting de eventos con ShouldBroadcast

Canal público pantalla

Listener en Echo: .listen('.turno.llamado')

Base de datos

SQLite por defecto (database/database.sqlite)

Compatible con MySQL/MariaDB

🗂 Modelo de datos
users

id

name

email

password

role (admin, agente, publico)

servicios

id

nombre

codigo

puestos

id

codigo

nombre
(Ej.: Módulo 1, Módulo 2, …)

tickets

id

servicio_id

numero

prioritario (bool)

estado (en_espera, llamado, atendiendo, atendido, ausente)

llamado_at

puesto_id

🔄 Flujo real del sistema

📌 El usuario solicita turno en /kiosco
→ Se crea un ticket con estado: en_espera

🧍‍♂️ El agente abre /puesto
→ Ve toda la cola completa
→ Asigna un módulo y llama un turno

📡 Al llamar un turno:

Se dispara el evento TurnoLlamado

Laravel Reverb transmite el evento por WebSocket

La pantalla /pantalla se actualiza en tiempo real

Suena el ding.mp3

🎧 El agente puede:

Comenzar atención

Re-llamar

Marcar ausente

Cerrar turno

⚙️ Instalación en entorno local
1. Clonar repo
git clone https://github.com/Mtz1974/turnero-utn-fsa.git
cd turnero-utn-fsa

2. Instalar dependencias PHP
composer install

3. Instalar dependencias JS
npm install

4. Configurar .env
cp .env.example .env


Editar valores principales:

APP_NAME="Turnero En Vivo UTN-FSA"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

BROADCAST_CONNECTION=reverb
QUEUE_CONNECTION=database

REVERB_APP_ID=local
REVERB_APP_KEY=local-key
REVERB_APP_SECRET=local-secret
REVERB_HOST=127.0.0.1
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"


Crear archivo SQLite:

mkdir -p database
touch database/database.sqlite

5. Generar APP_KEY + Migrar + Seed
php artisan key:generate
php artisan migrate --seed

▶️ Ejecutar proyecto (3 terminales)

Terminal 1 – Laravel

php artisan serve


Terminal 2 – Vite

npm run dev


Terminal 3 – Reverb

php artisan reverb:start

🧪 Probar todo en el navegador
Función	URL
Welcome	http://127.0.0.1:8000/

Kiosco	http://127.0.0.1:8000/kiosco

Pantalla TV	http://127.0.0.1:8000/pantalla

Panel de Puesto	http://127.0.0.1:8000/puesto

Prueba completa:

Emitir 2–3 turnos desde /kiosco

Entrar a /pantalla (dejar abierta)

En /puesto: asignar módulos + llamar → debe sonar el ding.mp3

Ver actualización en tiempo real

🌗 Modo Claro / Oscuro

Toggle implementado con Alpine.js

Tailwind configurado con darkMode: "class"

Persistencia del tema en localStorage

👨‍💻 Autor

Proyecto desarrollado por María Teresa Zamboni
para la Tecnicatura Universitaria en Programación – UTN FSA.

Incluye:

Buenas prácticas de Laravel

Eventos broadcast + WebSockets reales

Livewire 3 con acciones reactivas

Interfaz moderna, accesible y responsiva