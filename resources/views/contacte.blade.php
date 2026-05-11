@extends('layouts.app')
@section('titol', 'Contacte')

@section('content')
<div class="container my-4">
    <h1 class="mb-4"><i class="bi bi-envelope-fill"></i> Contacte</h1>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card p-4 h-100">
                <h4>Les nostres dades</h4>
                <hr>
                <p><i class="bi bi-geo-alt-fill text-warning"></i>
                    <strong>Adreça:</strong><br>
                    Institut de Lliçà<br>
                    Avinguda Pau Casals, 25<br>
                    08186 Lliçà d'Amunt, Barcelona
                </p>
                <p><i class="bi bi-telephone-fill text-warning"></i>
                    <strong>Telèfon:</strong> 938 765 432
                </p>
                <p><i class="bi bi-envelope-fill text-warning"></i>
                    <strong>Correu:</strong> contacte@tendagourmet.cat
                </p>
                <p><i class="bi bi-clock-fill text-warning"></i>
                    <strong>Horari:</strong><br>
                    Dilluns a divendres: 9:00 - 20:00<br>
                    Dissabtes: 10:00 - 14:00
                </p>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            {{-- Iframe Google Maps (apartat 14, ubicació de l'institut) --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.0!2d2.2487!3d41.6145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x0!2sInstitut%20de%20Lli%C3%A7%C3%A0!5e0!3m2!1sca!2ses!4v1700000000000"
                width="100%" height="450" style="border:0; border-radius:8px;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
@endsection
