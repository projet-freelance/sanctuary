<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos | E-SANCTUARY</title>
    <style>
        :root {
            --primary-color: #3b5998;
            --secondary-color: #8b9dc3;
            --accent-color: #dfe3ee;
            --text-color: #333;
            --light-text: #f7f7f7;
            --spacing: 1.5rem;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .hero {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            text-align: center;
            padding: 4rem 2rem;
            margin-bottom: var(--spacing);
            border-radius: 0 0 20px 20px;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .about-content {
            display: flex;
            flex-direction: column;
            gap: var(--spacing);
            padding: var(--spacing) 0;
        }
        
        .section {
            background: white;
            border-radius: 10px;
            padding: var(--spacing);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .section:hover {
            transform: translateY(-5px);
        }
        
        h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
        }
        
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .service-card {
            background-color: var(--accent-color);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .service-card:hover {
            background-color: var(--secondary-color);
            color: var(--light-text);
        }
        
        .service-card h3 {
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }
        
        .cta {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 3rem 1.5rem;
            border-radius: 10px;
            margin-top: var(--spacing);
        }
        
        .cta h2 {
            color: white;
            border-bottom: none;
        }
        
        .btn {
            display: inline-block;
            background-color: white;
            color: var(--primary-color);
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            background-color: var(--text-color);
            color: white;
            transform: scale(1.05);
        }
        
        footer {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: var(--spacing);
        }
        
        .quote {
            font-style: italic;
            background-color: var(--accent-color);
            padding: 1.5rem;
            border-radius: 10px;
            position: relative;
            margin: 2rem 0;
        }
        
        .quote::before {
            content: '"';
            font-size: 4rem;
            position: absolute;
            top: -20px;
            left: 10px;
            color: var(--primary-color);
            opacity: 0.3;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .services {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">E-SANCTUARY</div>
        </div>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1>Bienvenue sur E-SANCTUARY</h1>
            <p>Un sanctuaire virtuel dédié à guider et à perfectionner ceux qui cherchent à approfondir leur marche avec Dieu.</p>
        </div>
    </section>
    
    <div class="container">
        <div class="about-content">
            <section class="section">
                <h2>Notre Mission</h2>
                <p>Notre mission est d'offrir une boussole spirituelle et un soutien inébranlable à tous ceux qui aspirent à un voyage de foi authentique et enrichissant. Nous croyons fermement que chaque individu est appelé à une relation intime et unique avec DIEU, une relation qui transcende les simples rituels pour toucher les profondeurs de l'âme.</p>
                
                <div class="quote">
                    <p>À travers nos services, nos conseils et nos programmes, nous nous engageons à fournir les outils nécessaires pour une compréhension approfondie et une pratique fervente de la foi chrétienne.</p>
                </div>
            </section>
            
            <section class="section">
                <h2>Nos Services</h2>
                <p>Que vous soyez au début de votre cheminement spirituel ou que vous cherchiez à approfondir votre engagement, E-SANCTUARY est ici pour vous accompagner à chaque étape. Nous proposons une variété de contenus adaptés à vos besoins spirituels :</p>
                
                <div class="services">
                    <div class="service-card">
                        <h3>Consultations Spirituelles</h3>
                        <p>Allo E-Sanctuary et intentions de prière personnalisées</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Méditations Quotidiennes</h3>
                        <p>Moments de recueillement et de connexion avec Dieu</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Pain de Vie</h3>
                        <p>Pioche de versets bibliques selon votre situation</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>DIEU Communique</h3>
                        <p>Messages spirituels adaptés à votre cheminement</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Conseils & Témoignages</h3>
                        <p>Paroles religieuses et expériences inspirantes</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Conférences & Enseignements</h3>
                        <p>Événements en ligne pour approfondir votre foi</p>
                    </div>
                    
                    <div class="service-card">
                        <h3>Boutique</h3>
                        <p>Articles religieux soigneusement sélectionnés</p>
                    </div>
                </div>
            </section>
            
            <section class="section">
                <h2>Notre Vision</h2>
                <p>Notre vision est de créer un espace où chacun peut se sentir accueilli, écouté et soutenu. Un espace où la foi se transforme en une force vivante et dynamique, capable de surmonter les épreuves de la vie et de nourrir l'espérance.</p>
                <p>Nous aspirons à bâtir une communauté virtuelle où les croyants peuvent grandir ensemble dans leur foi, partager leurs expériences et s'encourager mutuellement sur le chemin de la spiritualité.</p>
            </section>
            
            <section class="cta">
                <h2>Rejoignez Notre Communauté</h2>
                <p>Embarquez avec nous dans cette aventure spirituelle et laissez-nous marcher à vos côtés sur le chemin sacré de la foi. Ensemble, grandissons, apprenons et élevons-nous, toujours guidés par la lumière de Dieu.</p>
                <a href="#" class="btn">Nous Rejoindre</a>
            </section>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>Avec dévotion et engagement,</p>
            <p>L'équipe de E-Sanctuary</p>
        </div>
    </footer>
</body>
</html>