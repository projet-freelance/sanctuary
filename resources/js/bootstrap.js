// Utilisation d'importation ESModules pour 'lodash' au lieu de require
import _ from 'lodash';

/**
 * Nous chargeons la bibliothèque axios qui permet de faire des requêtes HTTP
 * facilement vers notre back-end Laravel. Cette bibliothèque gère automatiquement
 * l'envoi du token CSRF comme en-tête basé sur la valeur du cookie "XSRF".
 */

// Importer Axios avec import au lieu de require
import axios from 'axios';


window._ = _;  // Assignation de lodash à window
window.axios = axios;  // Assignation d'axios à window

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo expose une API expressive pour s'abonner à des canaux et écouter
 * les événements diffusés par Laravel. Echo et la diffusion d'événements
 * permettent à votre équipe de construire facilement des applications web
 * en temps réel robustes.
 */

// Si vous souhaitez utiliser Echo avec Pusher, décommentez les lignes suivantes.
// Si vous n'en avez pas besoin pour votre projet actuel, laissez-les commentées.
 
// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
