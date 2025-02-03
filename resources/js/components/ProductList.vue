<template>
  <div class="liste-produits">
    <div v-if="chargement" class="chargement">
      Chargement des produits...
    </div>
    
    <div v-else-if="erreur" class="erreur">
      {{ erreur }}
    </div>
    
    <div v-else class="grille grid-cols-1 md:grid-cols-3 gap-4">
      <div 
        v-for="produit in produits" 
        :key="produit.id" 
        class="carte-produit border arrondi p-4 ombre"
      >
        <img 
          :src="produit.image" 
          :alt="produit.name" 
          class="w-full h-48 object-cover arrondi-haut"
        >
        <div class="details-produit mt-2">
          <h3 class="text-xl gras">{{ produit.name }}</h3>
          <p class="text-gris-fonce">{{ produit.description }}</p>
          <div class="flex justify-between items-center mt-2">
            <span class="text-lg semi-gras">{{ produit.price }}€</span>
            <span class="text-sm text-gris-clair majuscule">
              {{ obtenir_libelle_categorie(produit.category) }}
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div v-if="!chargement && produits.length === 0" class="pas-de-produits">
      Aucun produit disponible
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      produits: [],
      chargement: true,
      erreur: null
    };
  },
  
  methods: {
    obtenir_libelle_categorie(categorie) {
      const categories = {
        'flower': 'Fleur',
        'religious_item': 'Objet de piété',
        'candle': 'Bougie'
      };
      return categories[categorie] || categorie;
    },
    
    async recuperer_produits() {
      try {
        this.chargement = true;
        const reponse = await axios.get('/api/products');
        this.produits = reponse.data;
        this.chargement = false;
      } catch (erreur) {
        this.erreur = 'Erreur lors du chargement des produits';
        this.chargement = false;
        console.error('Erreur de récupération des produits:', erreur);
      }
    }
  },
  
  created() {
    this.recuperer_produits();
  }
}
</script>