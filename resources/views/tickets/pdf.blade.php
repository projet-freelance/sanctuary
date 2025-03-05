<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ticket d'Événement Paroissial</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap');

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .ticket-container {
            width: 400px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 2px solid #8B4513; /* Couleur brun église */
        }

        .header {
            background-color: #8B4513;
            color: white;
            text-align: center;
            padding: 15px;
        }

        .header h2 {
            font-family: 'Playfair Display', serif;
            margin: 0;
            font-size: 1.5em;
        }

        .ticket-content {
            padding: 20px;
        }

        .ticket-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-item {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }

        .info-item strong {
            display: block;
            color: #8B4513;
            font-size: 0.9em;
            margin-bottom: 5px;
        }

        .info-item p {
            margin: 0;
            font-weight: 600;
        }

        .footer {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: center;
            font-size: 0.8em;
            color: #666;
        }

        .qr-code {
            width: 120px;
            height: 120px;
            background-color: #e0e0e0;
            margin: 20px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        .qr-code span {
            color: #8B4513;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <h2>Ticket pour l'Événement Paroissial</h2>
        </div>

        <div class="ticket-content">
            <div class="ticket-info">
                <div class="info-item">
                    <strong>Nom du participant</strong>
                    <p>{{ $ticket->user->name }}</p>
                </div>

                <div class="info-item">
                    <strong>Lieu de l'événement</strong>
                    <p>{{ $ticket->event->location }}</p>
                </div>

                <div class="info-item">
                    <strong>Date et heure</strong>
                    <p>{{ $ticket->event->date_time->format('d/m/Y H:i') }}</p>
                </div>

                <div class="info-item">
                    <strong>Numéro du ticket</strong>
                    <p>{{ $ticket->ticket_code }}</p>
                </div>
            </div>

            <div class="qr-code">
                <span>QR Code</span>
            </div>
        </div>

        <div class="footer">
            <p>Ce ticket est personnel et ne peut être transféré. Veuillez le présenter avec une pièce d'identité à l'entrée.</p>
        </div>
    </div>
</body>
</html>