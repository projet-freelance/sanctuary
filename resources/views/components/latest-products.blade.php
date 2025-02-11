<!-- resources/views/components/latest-products.blade.php -->

<div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <!-- En-tête de la section -->
    <div class="max-w-7xl mx-auto text-center mb-12">
        <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl mb-4">
            Les produits par catégorie
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
    </div>

    <!-- Conteneur des catégories -->
    <div class="max-w-7xl mx-auto">
        @foreach ($categories as $category)
            <div class="mb-12">
                <!-- En-tête de catégorie -->
                <div class="flex items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 px-4 py-2 bg-white rounded-lg shadow-sm inline-block">
                        {{ ucfirst($category) }}
                    </h3>
                    <div class="h-px bg-gray-200 flex-grow ml-4"></div>
                </div>

                <!-- Grille de produits -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach (\App\Models\Product::where('category', $category)->get() as $product)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                            <!-- Image du produit -->
                            <div class="relative aspect-w-16 aspect-h-12 overflow-hidden bg-gray-100">
                                <img 
                                    src="{{ asset('storage/' . $product->image) }}" 
                                    alt="{{ $product->name }}"
                                    class="object-cover object-center w-full h-full transform group-hover:scale-110 transition-transform duration-300"
                                >
                                <div class="absolute inset-0 bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-opacity"></div>
                            </div>

                            <!-- Informations du produit -->
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 mb-2 text-lg truncate">
                                    {{ $product->name }}
                                </h4>
                                
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-indigo-600">
                                        {{ number_format($product->price, 2, ',', ' ') }} €
                                    </span>
                                    
                                    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="bg-indigo-50 hover:bg-indigo-100 text-indigo-600 px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                                        Voir plus
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Style pour l'aspect ratio des images -->
<style>
.aspect-w-16 {
    position: relative;
    padding-bottom: 75%;
}
.aspect-w-16 > * {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}
</style>