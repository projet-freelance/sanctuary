import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue';  // Importer Vue depuis 'vue'
import ProductList from './components/ProductList.vue';

// Initialisation d'Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Créer l'application Vue
const app = createApp(ProductList);
app.mount('#app');  // Monte l'application Vue sur l'élément ayant l'ID "app"
