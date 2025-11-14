<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Turnero En Vivo UTN-FSA</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-900 text-slate-100">
    <div class="min-h-screen flex flex-col">

        {{-- Barra superior --}}
        <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="inline-flex h-8 w-8 rounded-full bg-sky-500 items-center justify-center text-slate-900 font-bold">
                        
                    </span>
                    <div>
                        <h1 class="text-lg font-semibold leading-tight">
                            Turnero En Vivo <span class="text-sky-400">UTN-FSA</span>
                        </h1>
                        <p class="text-xs text-slate-400">
                            Trabajo práctico integrador – Gestión de turnos en tiempo real
                        </p>
                    </div>
                </div>

                <div class="hidden sm:flex items-center gap-4 text-xs text-slate-400">
                    <span>Tecnologias usadas : Laravel 12 | Livewire 3 | Tailwind | Pusher</span>
                </div>
            </div>
        </header>

        {{-- Contenido principal --}}
        <main class="flex-1">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
                <div class="grid gap-10 lg:grid-cols-2 items-center">

                    {{-- Columna izquierda: texto / explicación --}}
                    <section>
                        <p class="text-xs font-semibold tracking-[0.2em] uppercase text-sky-400 mb-3">
                            Trabajo práctico – Programación / WebSockets
                        </p>

                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
                            Sistema de turnos eficiente para atención al público
                        </h2>

                        <p class="text-sm sm:text-base text-slate-300 mb-4 leading-relaxed">
                            Este proyecto implementa un <strong>turnero web en tiempo real</strong> pensado para
                            una mesa de entradas, consultorio o ventanilla de atención.
                            Permite que las personas saquen su turno desde un kiosco,
                            el personal gestione la atención desde un puesto
                            y una pantalla tipo TV muestre los turnos llamados.
                        </p>

                        <p class="text-sm sm:text-base text-slate-300 mb-6 leading-relaxed">
                            Todo está desarrollado con <strong>Laravel + Livewire + Tailwind + Pusher</strong>,
                            incorporando conceptos de colas, eventos, vistas reactivas y UI responsiva.
                        </p>

                        {{-- Botones principales --}}
                        <div class="flex flex-wrap gap-3 mb-6">
                            <a href="{{ url('/kiosco') }}"
                               class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-sky-500 hover:bg-sky-400 text-slate-900 text-sm font-semibold shadow-lg shadow-sky-500/30 transition">
                                🧾 Ir al kiosco de turnos
                            </a>

                            <a href="{{ route('login') }}"
                               class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-600 hover:border-sky-400 hover:bg-slate-800 text-sm font-semibold text-slate-100 transition">
                                👨‍💼 Ingresar como agente / administrador
                            </a>
                        </div>

                        {{-- Botón para ver la pantalla en vivo --}}
                        <div class="mt-6 flex justify-center">
                            <a href="{{ url('/pantalla') }}"
                            class="inline-flex items-center px-6 py-3 rounded-xl shadow-lg 
                            bg-indigo-600 text-white font-semibold text-lg 
                            hover:bg-indigo-700 hover:scale-105 transition 
                            dark:bg-indigo-500 dark:hover:bg-indigo-600">
                            📺 Ver Pantalla en Vivo
                             </a>
                         </div>


                        {{-- Bullets de explicación rápida --}}

                        
                        <div class="grid gap-3 text-xs sm:text-sm text-slate-300">
                            <div class="flex gap-2">
                                <span class="mt-1 text-sky-400">✔</span>
                                <p><strong>Kiosco de turnos:</strong> el usuario elige servicio y obtiene un código.</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="mt-1 text-sky-400">✔</span>
                                <p><strong>Puesto de atención:</strong> el agente llama, atiende, re-llama o marca ausentes.</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="mt-1 text-sky-400">✔</span>
                                <p><strong>Pantalla TV:</strong> muestra últimos turnos llamados, módulo y mensajes al público.</p>
                            </div>
                            <div class="flex gap-2">
                                <span class="mt-1 text-sky-400">✔</span>
                                <p><strong>Sonido y tiempo real:</strong> cuando se llama un turno, se actualiza la pantalla y suena un “ding”.</p>
                            </div>
                        </div>
                    </section>

                    {{-- Columna derecha: “mock” de pantalla --}}
                    <section>
                        <div class="relative rounded-2xl border border-slate-700 bg-gradient-to-br from-slate-800 to-slate-900 p-5 shadow-xl">
                            <p class="text-xs uppercase tracking-[0.18em] text-slate-400 mb-2">
                                Vista ejemplo · Pantalla de TV
                            </p>

                            <div class="rounded-xl border border-slate-700 overflow-hidden bg-slate-900">
                                <div class="flex items-center justify-between px-4 py-3 bg-slate-800">
                                    <span class="text-xs font-semibold tracking-[0.2em] text-slate-300 uppercase">
                                        Turnero En Vivo • UTN-FSA
                                    </span>
                                    <span class="text-[11px] text-slate-400">
                                        Último turno llamado
                                    </span>
                                </div>

                                <div class="px-6 py-6 flex flex-col gap-4 lg:gap-6">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <p class="text-[11px] text-slate-400 uppercase mb-1">Turno</p>
                                            <p class="text-4xl sm:text-5xl font-extrabold tracking-[0.25em]">
                                                EM<span class="tracking-normal">027</span>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[11px] text-slate-400 uppercase mb-1">Módulo</p>
                                            <p class="text-3xl font-bold">3</p>
                                        </div>
                                    </div>

                                    <div class="text-xs text-slate-300 border-t border-slate-800 pt-3">
                                        Mensaje al público:
                                        <span class="text-sky-300">
                                            “Bienvenidos, por favor espere su turno y tenga su DNI a mano.”
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-[11px] text-slate-400">
                                Esta pantalla se actualiza en tiempo real cuando un agente llama un turno
                                desde el módulo <strong>/puesto</strong>.
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-800 py-4">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-[11px] text-slate-500 flex flex-wrap items-center justify-between gap-2">
                <span>Proyecto académico – Tecnicatura Universitaria en Programación (UTN-FSA).</span>
                <span>Stack: Laravel · Livewire · Tailwind · Pusher · SQLite/MySQL.</span>
            </div>
        </footer>
    </div>
</body>
</html>
