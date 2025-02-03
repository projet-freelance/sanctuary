<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Produits</title>
    @vite(['resources/js/app.js'])
    
    <script src="https://cdn.tailwindcss.com"></script> <!-- Pour le style (optionnel) -->
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Nos rzzb Produits</h1>
        
        <div id="app">
            <products-list></products-list>
        </div>
    </div>
</body>
</html>
