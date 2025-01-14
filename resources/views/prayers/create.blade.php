@extends('layouts.app')

@section('content')
<style>
    .prayer-container {
        background: linear-gradient(to bottom, rgba(255,255,255,0.9), rgba(255,255,255,0.95));
        min-height: 100vh;
        padding: 4rem 0;
    }
    
    .prayer-card {
        background: #ffffff;
        border-radius: 15px;
        border: none;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .prayer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.08);
    }
    
    .card-header {
        background: linear-gradient(135deg, #1e3799 0%, #0c2461 100%);
        border-radius: 15px 15px 0 0 !important;
        padding: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        letter-spacing: 0.5px;
    }
    
    .form-label {
        color: #2c3e50;
        font-weight: 500;
        margin-bottom: 0.7rem;
        font-size: 1.1rem;
    }
    
    .form-control {
        border: 1px solid #e0e6ed;
        border-radius: 8px;
        padding: 0.8rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #1e3799;
        box-shadow: 0 0 0 0.2rem rgba(30, 55, 153, 0.15);
    }
    
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }
    
    .submit-btn {
        background: linear-gradient(135deg, #1e3799 0%, #0c2461 100%);
        border: none;
        border-radius: 8px;
        padding: 1rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        transition: all 0.3s ease;
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(30, 55, 153, 0.3);
    }
    
    .file-input-wrapper {
        position: relative;
        margin-top: 1.5rem;
    }
    
    .custom-file-label {
        background: #f8f9fa;
        border: 1px dashed #cbd5e0;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
    }
</style>
<div class="prayer-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="prayer-card card">
                    <div class="card-header text-white">
                        <i class="fas fa-pray mr-2"></i> Soumettre une intention de prière
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('prayer.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Message -->
                            <div class="mb-4">
                                <label for="message" class="form-label">Votre intention de prière</label>
                                <textarea 
                                    name="message" 
                                    class="form-control" 
                                    rows="4" 
                                    placeholder="Partagez votre intention de prière ici avec sincérité..." 
                                    required
                                ></textarea>
                            </div>

                            <!-- Audio -->
                            <div class="mb-4">
                                <label for="audio" class="form-label">
                                    <i class="fas fa-microphone-alt mr-2"></i> Enregistrement audio (facultatif)
                                </label>
                                <div class="file-input-wrapper">
                                    <input 
                                        type="file" 
                                        class="form-control d-none" 
                                        id="audio" 
                                        name="audio" 
                                        accept="audio/*"
                                    >
                                    <label for="audio" class="custom-file-label" id="file-label">
                                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                                        Cliquez pour sélectionner un fichier audio
                                    </label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="submit-btn btn btn-primary w-100">
                                Soumettre votre intention
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('audio').addEventListener('change', function(event) {
        const fileName = event.target.files[0]?.name || "Aucun fichier sélectionné";
        document.getElementById('file-label').textContent = fileName;
    });
</script>
@endsection