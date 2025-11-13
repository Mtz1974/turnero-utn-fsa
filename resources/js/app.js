import './bootstrap'

// ⬇️ Alpine
import Alpine from 'alpinejs'
window.Alpine = Alpine

// 👉 Esperar a que Livewire termine de cargar, y recién ahí arrancar Alpine
document.addEventListener('livewire:load', () => {
  Alpine.start()
})
