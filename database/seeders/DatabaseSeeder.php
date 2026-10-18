<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::firstOrCreate(['email' => 'admin@fixit.sn'], [
            'name'     => 'Admin FIXIT',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

        // CLIENT TEST
        User::firstOrCreate(['email' => 'client@fixit.sn'], [
            'name'     => 'Client Test',
            'password' => Hash::make('client123'),
            'role'     => 'user',
        ]);

        // ===================== CATÉGORIES =====================
        $outillage    = Category::firstOrCreate(['name' => 'Outillage à main']);
        $electrique   = Category::firstOrCreate(['name' => 'Outillage électrique']);
        $electricite  = Category::firstOrCreate(['name' => 'Électricité']);
        $plomberie    = Category::firstOrCreate(['name' => 'Plomberie']);
        $visserie     = Category::firstOrCreate(['name' => 'Visserie & Fixation']);
        $peinture     = Category::firstOrCreate(['name' => 'Peinture & Décoration']);
        $construction = Category::firstOrCreate(['name' => 'Matériaux de construction']);
        $soudure      = Category::firstOrCreate(['name' => 'Soudure & Métallurgie']);
        $securite     = Category::firstOrCreate(['name' => 'Sécurité & EPI']);
        $jardinage    = Category::firstOrCreate(['name' => 'Jardinage & Extérieur']);

        // ===================== PRODUITS =====================
        $products = [

            // ─── OUTILLAGE À MAIN ───
            [
                'name'        => 'Marteau de charpentier 500g',
                'price'       => 8500,
                'stock'       => 50,
                'category_id' => $outillage->id,
                'description' => 'Marteau professionnel à manche en bois de hêtre, tête en acier forgé 500g.',
                'image_url'   => 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=600&q=80',
            ],
            [
                'name'        => 'Tournevis cruciforme PH2',
                'price'       => 2500,
                'stock'       => 120,
                'category_id' => $outillage->id,
                'description' => 'Tournevis cruciforme PH2, manche bi-matière ergonomique, lame trempée.',
                'image_url'   => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=600&q=80',
            ],
            [
                'name'        => 'Clé à molette 250mm',
                'price'       => 12000,
                'stock'       => 35,
                'category_id' => $outillage->id,
                'description' => 'Clé universelle à mâchoire réglable, acier chromé-vanadium, ouverture max 30mm.',
                'image_url'   => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&q=80',
            ],
            [
                'name'        => 'Scie égoïne 550mm',
                'price'       => 9500,
                'stock'       => 25,
                'category_id' => $outillage->id,
                'description' => 'Scie à main pour bois, 7 dents/pouce, lame trempée induction.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Niveau à bulle 60cm',
                'price'       => 7000,
                'stock'       => 40,
                'category_id' => $outillage->id,
                'description' => 'Niveau aluminium 3 fioles, précision 0.5mm/m, avec protection caoutchouc.',
                'image_url'   => 'https://images.unsplash.com/photo-1517581177682-a085bb7ffb15?w=600&q=80',
            ],
            [
                'name'        => 'Pince multiprise 250mm',
                'price'       => 6500,
                'stock'       => 60,
                'category_id' => $outillage->id,
                'description' => 'Pince multiprise à joint glissant, ouverture réglable, mâchoires cromées.',
                'image_url'   => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=600&q=80',
            ],
            [
                'name'        => 'Mètre ruban 5m',
                'price'       => 3500,
                'stock'       => 100,
                'category_id' => $outillage->id,
                'description' => 'Ruban à mesurer 5m × 19mm, blocage automatique, crochet magnétique.',
                'image_url'   => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&q=80',
            ],
            [
                'name'        => 'Ciseau à bois 25mm',
                'price'       => 4500,
                'stock'       => 45,
                'category_id' => $outillage->id,
                'description' => 'Ciseau à bois professionnel, acier CR-V, manche en chêne, bague métal.',
                'image_url'   => 'https://images.unsplash.com/photo-1572981779307-38b8cabb2407?w=600&q=80',
            ],

            // ─── OUTILLAGE ÉLECTRIQUE ───
            [
                'name'        => 'Perceuse à percussion 750W',
                'price'       => 55000,
                'stock'       => 15,
                'category_id' => $electrique->id,
                'description' => 'Perceuse électrique 750W, mandrin 13mm, 2 vitesses, mode marteau.',
                'image_url'   => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&q=80',
            ],
            [
                'name'        => 'Meuleuse angulaire 125mm 900W',
                'price'       => 48000,
                'stock'       => 20,
                'category_id' => $electrique->id,
                'description' => 'Meuleuse d\'angle 900W, disque 125mm, vitesse 11000 tr/min, protection réglable.',
                'image_url'   => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&q=80',
            ],
            [
                'name'        => 'Scie circulaire 1200W',
                'price'       => 75000,
                'stock'       => 10,
                'category_id' => $electrique->id,
                'description' => 'Scie circulaire 1200W, plateau 185mm, profondeur de coupe 65mm, laser.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Ponceuse orbitale 300W',
                'price'       => 35000,
                'stock'       => 18,
                'category_id' => $electrique->id,
                'description' => 'Ponceuse excentrique 300W, plateau 125mm, vitesse variable, sac collecteur.',
                'image_url'   => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=600&q=80',
            ],

            // ─── ÉLECTRICITÉ ───
            [
                'name'        => 'Câble électrique 2.5mm² (100m)',
                'price'       => 45000,
                'stock'       => 20,
                'category_id' => $electricite->id,
                'description' => 'Câble souple H07V-R 2.5mm², isolation PVC, rouge, rouleau 100m.',
                'image_url'   => 'https://images.unsplash.com/photo-1621905251189-08b45249ff78?w=600&q=80',
            ],
            [
                'name'        => 'Disjoncteur 16A bipolaire',
                'price'       => 8500,
                'stock'       => 60,
                'category_id' => $electricite->id,
                'description' => 'Disjoncteur modulaire 16A 2P, pouvoir de coupure 6kA, norme NF EN 60898.',
                'image_url'   => 'https://images.unsplash.com/photo-1621905251189-08b45249ff78?w=600&q=80',
            ],
            [
                'name'        => 'Prise de courant 2P+T',
                'price'       => 1500,
                'stock'       => 200,
                'category_id' => $electricite->id,
                'description' => 'Prise de courant encastrée 16A, 250V, avec protection enfants, blanc.',
                'image_url'   => 'https://images.unsplash.com/photo-1621905251189-08b45249ff78?w=600&q=80',
            ],
            [
                'name'        => 'Tableau électrique 8 modules',
                'price'       => 22000,
                'stock'       => 25,
                'category_id' => $electricite->id,
                'description' => 'Coffret électrique encastrable 8 modules, avec porte transparente.',
                'image_url'   => 'https://images.unsplash.com/photo-1621905251189-08b45249ff78?w=600&q=80',
            ],
            [
                'name'        => 'Câble souple 1.5mm² (50m)',
                'price'       => 18000,
                'stock'       => 40,
                'category_id' => $electricite->id,
                'description' => 'Câble H05VV-F 3G1.5mm², noir, souple, gaine PVC résistante.',
                'image_url'   => 'https://images.unsplash.com/photo-1621905251189-08b45249ff78?w=600&q=80',
            ],

            // ─── PLOMBERIE ───
            [
                'name'        => 'Tube PVC pression 50mm (3m)',
                'price'       => 6500,
                'stock'       => 80,
                'category_id' => $plomberie->id,
                'description' => 'Tube rigide PVC pression DN50, norme NF EN 1452, pour eau froide sous pression.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Robinet d\'arrêt quart de tour 3/4"',
                'price'       => 7500,
                'stock'       => 55,
                'category_id' => $plomberie->id,
                'description' => 'Robinet laiton 1/4 tour 3/4", commande papillon, pression max 16 bars.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Coude PVC 90° 32mm (lot 10)',
                'price'       => 3500,
                'stock'       => 100,
                'category_id' => $plomberie->id,
                'description' => 'Coudes PVC mâle-femelle DN32 pour réseau eau froide, lot de 10 pièces.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Ruban téflon 12m',
                'price'       => 800,
                'stock'       => 300,
                'category_id' => $plomberie->id,
                'description' => 'Ruban PTFE 12m × 12mm pour étanchéité des raccords filetés.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Pompe à eau 0.5 CV',
                'price'       => 85000,
                'stock'       => 12,
                'category_id' => $plomberie->id,
                'description' => 'Pompe centrifuge 0.5CV, débit 2.4m³/h, hauteur manométrique 35m, 220V.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],
            [
                'name'        => 'Mitigeur lavabo chromé',
                'price'       => 28000,
                'stock'       => 30,
                'category_id' => $plomberie->id,
                'description' => 'Mitigeur monocommande lavabo, corps laiton chromé, cartouche céramique.',
                'image_url'   => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80',
            ],

            // ─── VISSERIE ───
            [
                'name'        => 'Vis à bois 4×40mm (boîte 200)',
                'price'       => 3500,
                'stock'       => 150,
                'category_id' => $visserie->id,
                'description' => 'Vis autoperceuses tête fraisée Pz2, acier zingué, boîte de 200 pièces.',
                'image_url'   => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=600&q=80',
            ],
            [
                'name'        => 'Chevilles murales 8mm (100 pcs)',
                'price'       => 2500,
                'stock'       => 200,
                'category_id' => $visserie->id,
                'description' => 'Chevilles nylon universelles 8×40mm pour béton, brique et parpaing.',
                'image_url'   => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=600&q=80',
            ],
            [
                'name'        => 'Boulons M10×50mm (50 pcs)',
                'price'       => 4000,
                'stock'       => 80,
                'category_id' => $visserie->id,
                'description' => 'Boulons tête hexagonale M10×50, acier zingué, avec écrous et rondelles.',
                'image_url'   => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=600&q=80',
            ],
            [
                'name'        => 'Clous en vrac 3mm (1kg)',
                'price'       => 1800,
                'stock'       => 200,
                'category_id' => $visserie->id,
                'description' => 'Clous tête ronde en acier galvanisé 3×70mm, sac 1kg.',
                'image_url'   => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=600&q=80',
            ],

            // ─── PEINTURE ───
            [
                'name'        => 'Peinture acrylique blanche 10L',
                'price'       => 28000,
                'stock'       => 35,
                'category_id' => $peinture->id,
                'description' => 'Peinture mur et plafond acrylique, finition mate, grande opacité, séchage 2h.',
                'image_url'   => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=600&q=80',
            ],
            [
                'name'        => 'Rouleau peinture 23cm + bac',
                'price'       => 5500,
                'stock'       => 60,
                'category_id' => $peinture->id,
                'description' => 'Kit rouleau laine 23cm avec bac plastique 30cm et manchon polyamide.',
                'image_url'   => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=600&q=80',
            ],
            [
                'name'        => 'Enduit de rebouchage 1kg',
                'price'       => 3200,
                'stock'       => 90,
                'category_id' => $peinture->id,
                'description' => 'Enduit pâte prêt à l\'emploi pour rebouchage de trous et fissures.',
                'image_url'   => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=600&q=80',
            ],
            [
                'name'        => 'Peinture façade grise 15L',
                'price'       => 42000,
                'stock'       => 20,
                'category_id' => $peinture->id,
                'description' => 'Peinture façade microporeuse, résistance aux intempéries, coloris gris ciment.',
                'image_url'   => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=600&q=80',
            ],
            [
                'name'        => 'Pinceau plat 50mm',
                'price'       => 1500,
                'stock'       => 150,
                'category_id' => $peinture->id,
                'description' => 'Pinceau plat 50mm, soies synthétiques, pour peintures acryliques et glycéros.',
                'image_url'   => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=600&q=80',
            ],

            // ─── MATÉRIAUX DE CONSTRUCTION ───
            [
                'name'        => 'Sac de ciment Portland 50kg',
                'price'       => 5500,
                'stock'       => 200,
                'category_id' => $construction->id,
                'description' => 'Ciment Portland CEM II 42.5N, sac 50kg, pour béton, mortier et enduits.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Sable fin (sac 40kg)',
                'price'       => 3000,
                'stock'       => 500,
                'category_id' => $construction->id,
                'description' => 'Sable fin lavé de carrière, granulométrie 0/2mm, sac 40kg, pour enduits.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Sable grossier (sac 40kg)',
                'price'       => 2800,
                'stock'       => 500,
                'category_id' => $construction->id,
                'description' => 'Sable grossier 0/4mm, sac 40kg, pour fabrication de béton et mortier.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Gravier concassé (sac 40kg)',
                'price'       => 3200,
                'stock'       => 400,
                'category_id' => $construction->id,
                'description' => 'Gravier concassé 4/14mm, sac 40kg, pour béton structurel.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Fer à béton HA10 (barre 6m)',
                'price'       => 8500,
                'stock'       => 300,
                'category_id' => $construction->id,
                'description' => 'Acier HA10, barre de 6 mètres, haute adhérence, pour armature béton armé.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Fer à béton HA12 (barre 6m)',
                'price'       => 12500,
                'stock'       => 250,
                'category_id' => $construction->id,
                'description' => 'Acier HA12, barre de 6 mètres, haute adhérence, pour armature béton armé.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Parpaing creux 20×20×40cm',
                'price'       => 650,
                'stock'       => 2000,
                'category_id' => $construction->id,
                'description' => 'Parpaing creux en béton, dimensions 20×20×40cm, résistance 50 bars.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Carrelage grès cérame 60×60 (m²)',
                'price'       => 12000,
                'stock'       => 150,
                'category_id' => $construction->id,
                'description' => 'Carrelage grès cérame rectifié 60×60cm, finition mate, résistance R10.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Colle carrelage gris 25kg',
                'price'       => 7500,
                'stock'       => 100,
                'category_id' => $construction->id,
                'description' => 'Mortier colle C2 pour carrelage intérieur et extérieur, sac 25kg.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Tôle ondulée galvanisée 3m',
                'price'       => 18000,
                'stock'       => 80,
                'category_id' => $construction->id,
                'description' => 'Tôle acier galvanisée ondulée, épaisseur 0.45mm, longueur 3m, largeur utile 86cm.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Enduit de façade (sac 25kg)',
                'price'       => 8000,
                'stock'       => 120,
                'category_id' => $construction->id,
                'description' => 'Enduit monocouche hydraulique pour façades, sac 25kg, application à la machine.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],

            // ─── SOUDURE ───
            [
                'name'        => 'Poste à souder à l\'arc 160A',
                'price'       => 95000,
                'stock'       => 8,
                'category_id' => $soudure->id,
                'description' => 'Poste de soudure à l\'arc MMA 160A, 220V, avec câbles et porte-électrode.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Électrodes de soudure E6013 (2.5mm, boîte 5kg)',
                'price'       => 18000,
                'stock'       => 30,
                'category_id' => $soudure->id,
                'description' => 'Électrodes rutiles E6013, diamètre 2.5mm, boîte de 5kg, tous aciers courants.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Masque de soudure auto-obscurcissant',
                'price'       => 35000,
                'stock'       => 15,
                'category_id' => $soudure->id,
                'description' => 'Masque de soudure à assombrissement automatique, DIN 9-13 réglable.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],

            // ─── SÉCURITÉ / EPI ───
            [
                'name'        => 'Casque de chantier jaune',
                'price'       => 8500,
                'stock'       => 50,
                'category_id' => $securite->id,
                'description' => 'Casque de protection HDPE, jaune, réglable 53-63cm, conforme EN 397.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Gants de travail cuir T9',
                'price'       => 4500,
                'stock'       => 80,
                'category_id' => $securite->id,
                'description' => 'Gants de travail cuir fleur, protection mécanique niveau 4, taille 9.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Chaussures de sécurité S3 T43',
                'price'       => 42000,
                'stock'       => 25,
                'category_id' => $securite->id,
                'description' => 'Chaussures de sécurité S3 SRC, embout acier, semelle anti-perforation, T43.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],
            [
                'name'        => 'Lunettes de protection anti-éclaboussures',
                'price'       => 3500,
                'stock'       => 100,
                'category_id' => $securite->id,
                'description' => 'Lunettes de protection enveloppantes, anti-buée, anti-rayures, EN 166.',
                'image_url'   => 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=600&q=80',
            ],

            // ─── JARDINAGE ───
            [
                'name'        => 'Brouette 90L acier',
                'price'       => 38000,
                'stock'       => 20,
                'category_id' => $jardinage->id,
                'description' => 'Brouette benne acier 90L, roue pneumatique, charge max 180kg.',
                'image_url'   => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80',
            ],
            [
                'name'        => 'Pelle ronde à bêcher',
                'price'       => 12000,
                'stock'       => 40,
                'category_id' => $jardinage->id,
                'description' => 'Pelle ronde professionnelle, lame acier forgé, manche bois frêne 120cm.',
                'image_url'   => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80',
            ],
            [
                'name'        => 'Tuyau d\'arrosage 25m Ø19mm',
                'price'       => 22000,
                'stock'       => 35,
                'category_id' => $jardinage->id,
                'description' => 'Tuyau d\'arrosage tricouche 25m, diamètre 19mm, résistance 25 bars.',
                'image_url'   => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80',
            ],
        ];

        foreach ($products as $p) {
            $imageUrl = $p['image_url'];
            unset($p['image_url']);
            // Stocker l'URL directement dans le champ image
            $p['image'] = $imageUrl;
            Product::firstOrCreate(['name' => $p['name']], $p);
        }
    }
}
