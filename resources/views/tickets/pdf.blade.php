<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <style>
        @page {
            margin: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .ticket-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .ticket-content {
            padding: 2rem;
        }

        .ticket-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .info-item {
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #4f46e5;
        }

        .info-item strong {
            display: block;
            color: #4f46e5;
            margin-bottom: 0.5rem;
            font-size: 14px;
            text-transform: uppercase;
        }

        .info-item p {
            margin: 0;
            color: #333;
            font-size: 16px;
        }

        .qr-code {
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .qr-code img {
            max-width: 200px;
            height: auto;
        }

        .footer {
            text-align: center;
            padding: 1.5rem;
            background-color: #f8f9fa;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #eee;
        }

        @media print {
            body {
                background-color: white;
            }
            
            .ticket-container {
                box-shadow: none;
            }

            .info-item {
                break-inside: avoid;
            }

            .qr-code {
                break-inside: avoid;
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <h2>Ticket pour {{ $ticket->event->name }}</h2>
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
                <img src="{{ public_path($ticket->qr_code_path) }}" alt="QR Code">
            </div>
        </div>

        <div class="footer">
            <p>Ce ticket est personnel et ne peut être transféré. Veuillez le présenter avec une pièce d'identité à l'entrée.</p>
        </div>
    </div>
</body>
</html>