<?php

namespace Database\Seeders;

use App\Models\Oferta;
use App\Models\Producte;
use App\Models\Seccio;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- USUARIS ---
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@tendagourmet.cat',
            'password' => Hash::make('admin1234'),
            'tipus' => 'admin',
            'nom_complet' => 'Admin Tenda Gourmet',
            'dni' => '12345678Z', // DNI vàlid de test
            'telefon' => '938765432',
            'direccio' => 'Avinguda Pau Casals, 25',
            'poblacio' => 'Lliçà d\'Amunt',
            'codi_postal' => '08186',
        ]);

        User::create([
            'name' => 'Usuari Test',
            'email' => 'user@test.cat',
            'password' => Hash::make('user1234'),
            'tipus' => 'particular',
        ]);

        // --- SECCIONS ---
        $formatges = Seccio::create(['nom' => 'Formatges', 'slug' => 'formatges']);
        $embotits = Seccio::create(['nom' => 'Embotits', 'slug' => 'embotits']);
        $vins = Seccio::create(['nom' => 'Vins i Caves', 'slug' => 'vins']);
        $olis = Seccio::create(['nom' => 'Olis i Vinagres', 'slug' => 'olis']);
        $conserves = Seccio::create(['nom' => 'Conserves', 'slug' => 'conserves']);
        $dolcos = Seccio::create(['nom' => 'Dolços', 'slug' => 'dolcos']);

        // --- PRODUCTES ---
        $productes = [
            // Formatges
            ['Formatge Manxego DOP', 'Formatge curat de llet d\'ovella manxega, 6 mesos de curació. Peça de 400g.', 18.50, true, $formatges->id],
            ['Formatge Idiazábal', 'Formatge fumat basc de llet crua d\'ovella. 350g.', 16.90, false, $formatges->id],
            ['Formatge de Cabrales', 'Formatge blau asturià madurat en coves naturals. 300g.', 14.20, true, $formatges->id],
            ['Burrata artesana', 'Burrata italiana fresca de 250g, elaborada amb llet de vaca.', 7.95, false, $formatges->id],

            // Embotits
            ['Pernil ibèric de gla 5J', 'Loncheado a mà, pernil de porc ibèric 100% de gla. Sobre de 100g.', 24.90, true, $embotits->id],
            ['Fuet de Vic IGP', 'Fuet extra curat segons la recepta tradicional de la Plana de Vic.', 6.50, false, $embotits->id],
            ['Llonganissa de Payés', 'Llonganissa artesana curada a l\'aire de muntanya. 400g.', 11.80, false, $embotits->id],
            ['Xoriço de León', 'Xoriço curat lleugerament picant, elaborat amb pebre vermell fumat.', 8.90, false, $embotits->id],

            // Vins
            ['Priorat Clos Mogador 2020', 'Vi negre de gran cos amb DO Priorat. Ampolla 75cl.', 45.00, true, $vins->id],
            ['Cava Gramona Imperial Brut', 'Cava gran reserva, 36 mesos de criança. 75cl.', 22.50, false, $vins->id],
            ['Albariño Pazo Señorans', 'Vi blanc gallec, DO Rías Baixas. 75cl.', 14.90, false, $vins->id],
            ['Rioja Reserva Muga', 'Vi negre rioja reserva, criança 24 mesos en barrica. 75cl.', 19.80, true, $vins->id],

            // Olis
            ['Oli d\'oliva verge extra Arbequina', 'Oli de primera pressió en fred, varietat Arbequina. 500ml.', 12.50, true, $olis->id],
            ['Vinagre de Mòdena IGP 12 anys', 'Vinagre balsàmic envellit en botes de fusta. 250ml.', 18.00, false, $olis->id],
            ['Oli de truficult negra', 'Oli d\'oliva aromatitzat amb tòfona negra. 100ml.', 16.50, false, $olis->id],

            // Conserves
            ['Anxoves del Cantàbric', 'Anxoves de l\'Escala en oli d\'oliva. Llauna 100g.', 9.80, false, $conserves->id],
            ['Espàrrecs de Navarra DOP', 'Espàrrecs blancs extra, collita artesana. Pot 400g.', 11.50, false, $conserves->id],
            ['Ventresca de tonyina', 'Ventresca de tonyina blanca en oli d\'oliva. 200g.', 13.90, true, $conserves->id],

            // Dolços
            ['Torró de Xixona IGP', 'Torró tou d\'ametlla segons recepta tradicional. 250g.', 9.50, false, $dolcos->id],
            ['Xocolata artesana 75% cacau', 'Xocolata negra amb cacau d\'origen únic. Tauleta 100g.', 5.80, true, $dolcos->id],
            ['Melmelada de figa', 'Melmelada artesana de figa negra amb poc sucre. Pot 280g.', 6.20, false, $dolcos->id],
        ];

        foreach ($productes as $p) {
            Producte::create([
                'nom' => $p[0],
                'descripcio' => $p[1],
                'preu' => $p[2],
                'destacat' => $p[3],
                'seccio_id' => $p[4],
                'stock' => 50,
            ]);
        }

        // --- OFERTES ---
        Oferta::create([
            'nom' => '2x1 en Formatges curats',
            'missatge' => 'Aquesta setmana, emporta\'t dos formatges curats pel preu d\'un. Vàlid fins a diumenge!',
            'activa' => true,
        ]);

        Oferta::create([
            'nom' => '-20% en Vins DO Priorat',
            'missatge' => 'Descompte del 20% en tota la selecció de vins del Priorat. No et quedis sense la teva ampolla.',
            'activa' => true,
        ]);

        Oferta::create([
            'nom' => 'Enviament gratuït a partir de 50€',
            'missatge' => 'Per a comandes superiors a 50€, l\'enviament a tota Catalunya és gratuït.',
            'activa' => true,
        ]);
    }
}
