<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Centro di Assistenza-------------------------------------------------
        $centerId = DB::table('assistance_centers')->insertGetId([
            'name' => 'SmartFix',
            'address' => 'Via Roma 10',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $centerId = DB::table('assistance_centers')->insertGetId([
            'name' => 'FixHome',
            'address' => 'Via Enzo Ferrari 7',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $centerId = DB::table('assistance_centers')->insertGetId([
            'name' => 'TecnoRipara',
            'address' => 'Via Dante Alighieri 3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $centerId = DB::table('assistance_centers')->insertGetId([
            'name' => 'ElettroCare',
            'address' => 'Via Agrigento 9',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        //Tecnico Centro di Assistenza ----------------------------------------
        //Tecnico1 -----------------------------------------------
        $technicianUserId = DB::table('users')->insertGetId([
            'username' => 'tecntecn',
            'password' => Hash::make('ETTfETTf'),
            'role' => 'technician',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('assistance_technicians')->insert([
            'user_id' => $technicianUserId,
            'first_name' => 'Mario',
            'last_name' => 'Rossi',
            'birth_date' => '1990-05-10',
            'specialization' => 'Frigoriferi', //
            'assistance_center_id' => $centerId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //--------------------------------------------------------

        //Tecnico Staff Aziendale ---------------------------------------------
        //Staff1 -------------------------------------------------
        $staffUserId = DB::table('users')->insertGetId([
            'username' => 'staffstaff',
            'password' => Hash::make('ETTfETTf'),
            'role' => 'staff',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $staffId = DB::table('staff_technicians')->insertGetId([
            'user_id' => $staffUserId,
            'first_name' => 'Luigi',
            'last_name' => 'Verdi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //--------------------------------------------------------

        //Amministratore -------------------------------------------------------
        DB::table('users')->insert([
            'username' => 'adminadmin',
            'password' => Hash::make('ETTfETTf'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Prodotto ------------------------------------------------------------
        $product1 = DB::table('products')->insertGetId([ //Chiedere perchè product1 e non productId
            'name' => 'Cappa Glem Gas',
            'description' => 'Comandi a pulsante 1 motore, Aspirazione 498 m3/h, 
            Filtro metallico antigrasso lavabile in lavastoviglie, 
            Filtri carbone 3 velocità 2 lampade led da 4 W Rumorosità 67 db(A)',
            'category' => 'Cappa',
            'image' => 'cappa1.png',
            'installation' => 'Posizionarla sopra il piano cottura,
            Fissare la cappa con le viti,
            Collegare il tubo di aspirazione,
            Collegarla alla corrente e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product2 = DB::table('products')->insertGetId([
            'name' => 'Cappa Faber Cooker',
            'description' => 'Comandi a pulsante Profilo slim - 4 cm 1 motore, Aspirazione 650 m³/h, 
            Filtri metallici antigrasso lavabili in lavastoviglie 
            Filtri carbone 3 velocità 2 spot led da 2 W Rumorosità 68 db(A)',
            'category' => 'Cappa',
            'image' => 'cappa2.png',
            'installation' => 'Posizionarla sopra il piano cottura,
            Fissare la cappa con le viti,
            Collegare il tubo di aspirazione,
            Collegarla alla corrente e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product3 = DB::table('products')->insertGetId([
            'name' => 'Forno Whirlpool',
            'description' => 'Forno multifunzione Inox 11 funzioni classe A+ 71Lt, Pirolisi e Idrolisi',
            'category' => 'Forno',
            'image' => 'forno1.png',
            'installation' => 'Inserire il forno nel mobile della cucina,
            Collegarlo alla corrente,
            Fissarlo con le viti,
            Accenderlo e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product4 = DB::table('products')->insertGetId([
            'name' => 'Forno Hotpoint Ariston',
            'description' => 'Tecnologia elettrica avanzata per cucinare risparmiando energia',
            'category' => 'Forno',
            'image' => 'forno2.png',
            'installation' => 'Inserire il forno nel mobile della cucina,
            Collegarlo alla corrente,
            Fissarlo con le viti,
            Accenderlo e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product5 = DB::table('products')->insertGetId([
            'name' => 'Frigorifero LG Electronics',
            'description' => 'Ripiani in vetro, robusti ed eleganti al tempo stesso. 
            Comodo porta-bottiglie per conservarle con sicurezza',
            'category' => 'Frigorifero',
            'image' => 'frigo1.png',
            'installation' => 'Posizionarlo nello spazio della cucina,
            Collegarlo alla presa elettrica,
            Attendere qualche ora prima di accenderlo,
            Impostare la temperatura e verificare che raffreddi.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product6 = DB::table('products')->insertGetId([
            'name' => 'Frigorifero Hotpoint Ariston',
            'description' => 'Ripiani con finiture metalliche e vassoio scorrevole nel freezer.
            Display smooth touch',
            'category' => 'Frigorifero',
            'image' => 'frigo2.png',
            'installation' => 'Posizionarlo nello spazio della cucina,
            Collegarlo alla presa elettrica,
            Attendere qualche ora prima di accenderlo,
            Impostare la temperatura e verificare che raffreddi.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product7 = DB::table('products')->insertGetId([
            'name' => 'Microonde Whirlpool',
            'description' => 'Funzione Jet Defrost per uno sbrinamento eccezionalmente rapido e uniforme',
            'category' => 'Microonde',
            'image' => 'micro1.png',
            'installation' => 'Posizionarlo su una superficie stabile,
            Lasciare spazio per la ventilazione,
            Collegarlo alla presa elettrica,
            Impostare orologio e potenza e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product8 = DB::table('products')->insertGetId([
            'name' => 'Microonde Pro Whirlpool',
            'description' => 'Funzione grill e funzione Jet Defrost per uno sbrinamento eccezionalmente rapido e uniforme.',
            'category' => 'Microonde',
            'image' => 'micro2.png',
            'installation' => 'Posizionarlo su una superficie stabile,
            Lasciare spazio per la ventilazione,
            Collegarlo alla presa elettrica,
            Impostare orologio e potenza e verificare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product9 = DB::table('products')->insertGetId([
            'name' => 'Piano Cottura Whirlpool',
            'description' => 'Fornelli ad alta efficienza, per ridurre il consumo di energia.',
            'category' => 'PianoCottura',
            'image' => 'piano1.png',
            'installation' => 'Inserirlo nel foro del piano della cucina,
            Applicare la guarnizione,
            Collegarlo al gas e alla corrente,
            Controllare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $product10 = DB::table('products')->insertGetId([
            'name' => 'Piano Cottura Candy',
            'description' => 'Superficie in iXelium resistente alle macchie per una facile pulizia.',
            'category' => 'PianoCottura',
            'image' => 'piano2.png',
            'installation' => 'Inserirlo nel foro del piano della cucina,
            Applicare la guarnizione,
            Collegarlo al gas e alla corrente,
            Controllare che funzioni.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Malfunzionamento ----------------------------------------------------
        $malfunction1 = DB::table('malfunctions')->insertGetId([
            'product_id' => $product1,
            'description' => 'Il dispositivo non si avvia',
            'solution' => 'Controllare l\'alimentazione',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $malfunction2 = DB::table('malfunctions')->insertGetId([
            'product_id' => $product1,
            'description' => 'Rumore forte durante il funzionamento',
            'solution' => 'Controllare ventola o motore',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //Relazione Staff → Prodotti ------------------------------------------
        DB::table('product_staff_technician')->insert([
            [
                'product_id' => $product1,
                'staff_technician_id' => $staffId,
            ],
            [
                'product_id' => $product2,
                'staff_technician_id' => $staffId,
            ]
        ]);
    }
}