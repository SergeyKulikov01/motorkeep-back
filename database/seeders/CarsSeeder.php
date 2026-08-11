<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            // Japan
            'Toyota' => ['country' => 'JP', 'models' => ['Camry', 'Corolla', 'RAV4', 'Land Cruiser', 'Land Cruiser Prado', 'Hilux', 'Yaris', 'Prius', 'Highlander', 'Avalon', 'C-HR', 'Fortuner', 'Alphard', 'Sienna', 'Venza', 'Sequoia', 'Tundra', '4Runner', 'Crown', 'Mark II']],
            'Honda' => ['country' => 'JP', 'models' => ['Civic', 'Accord', 'CR-V', 'Pilot', 'HR-V', 'Fit', 'Odyssey', 'Ridgeline', 'Passport', 'Insight', 'Stepwgn', 'Freed', 'Vezel']],
            'Nissan' => ['country' => 'JP', 'models' => ['Qashqai', 'X-Trail', 'Almera', 'Note', 'Juke', 'Murano', 'Patrol', 'Teana', 'Sentra', 'Altima', 'Pathfinder', 'Navara', 'Terrano', 'Leaf', '370Z', 'GT-R', 'Kicks']],
            'Mazda' => ['country' => 'JP', 'models' => ['Mazda2', 'Mazda3', 'Mazda6', 'CX-3', 'CX-5', 'CX-30', 'CX-9', 'CX-60', 'MX-5', 'BT-50']],
            'Subaru' => ['country' => 'JP', 'models' => ['Forester', 'Outback', 'Impreza', 'XV', 'Legacy', 'WRX', 'Ascent', 'BRZ', 'Levorg']],
            'Mitsubishi' => ['country' => 'JP', 'models' => ['Outlander', 'ASX', 'Pajero', 'Lancer', 'L200', 'Eclipse Cross', 'Pajero Sport', 'Colt', 'Galant']],
            'Suzuki' => ['country' => 'JP', 'models' => ['Vitara', 'Swift', 'SX4', 'Jimny', 'Grand Vitara', 'Baleno', 'Ignis', 'Ertiga']],
            'Lexus' => ['country' => 'JP', 'models' => ['RX', 'NX', 'ES', 'LX', 'IS', 'GX', 'LS', 'UX', 'RC']],
            'Infiniti' => ['country' => 'JP', 'models' => ['QX50', 'QX60', 'Q50', 'QX56', 'FX', 'G37']],
            'Acura' => ['country' => 'JP', 'models' => ['MDX', 'RDX', 'TLX', 'ILX', 'NSX']],
            'Isuzu' => ['country' => 'JP', 'models' => ['D-Max', 'Trooper', 'MU-X', 'Bighorn']],
            'Daihatsu' => ['country' => 'JP', 'models' => ['Terios', 'Sirion', 'Mira', 'Copen']],
            'Datsun' => ['country' => 'JP', 'models' => ['on-DO', 'mi-DO', 'GO']],

            // Germany
            'BMW' => ['country' => 'DE', 'models' => ['1 Series', '2 Series', '3 Series', '4 Series', '5 Series', '6 Series', '7 Series', '8 Series', 'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7', 'Z4', 'i3', 'i4', 'iX']],
            'Audi' => ['country' => 'DE', 'models' => ['A1', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'Q2', 'Q3', 'Q5', 'Q7', 'Q8', 'TT', 'R8', 'e-tron']],
            'Mercedes-Benz' => ['country' => 'DE', 'models' => ['A-Class', 'B-Class', 'C-Class', 'E-Class', 'S-Class', 'CLA', 'CLS', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS', 'G-Class', 'V-Class', 'Sprinter']],
            'Volkswagen' => ['country' => 'DE', 'models' => ['Golf', 'Passat', 'Tiguan', 'Polo', 'Jetta', 'Touareg', 'Teramont', 'Arteon', 'T-Roc', 'Taos', 'Atlas', 'Caddy', 'Transporter', 'Amarok', 'ID.4']],
            'Porsche' => ['country' => 'DE', 'models' => ['911', 'Cayenne', 'Macan', 'Panamera', 'Taycan', 'Boxster', 'Cayman', '718']],
            'Opel' => ['country' => 'DE', 'models' => ['Astra', 'Insignia', 'Corsa', 'Mokka', 'Zafira', 'Vectra', 'Antara', 'Grandland']],
            'Smart' => ['country' => 'DE', 'models' => ['Fortwo', 'Forfour']],

            // United States
            'Ford' => ['country' => 'US', 'models' => ['Focus', 'Mondeo', 'Explorer', 'Kuga', 'F-150', 'Mustang', 'EcoSport', 'Fiesta', 'Fusion', 'Edge', 'Ranger', 'Bronco', 'Escape', 'Expedition', 'Transit', 'Maverick']],
            'Chevrolet' => ['country' => 'US', 'models' => ['Cruze', 'Aveo', 'Captiva', 'Niva', 'Tahoe', 'Malibu', 'Camaro', 'Silverado', 'Trailblazer', 'Equinox', 'Suburban', 'Spark', 'Corvette', 'Blazer', 'Traverse']],
            'Jeep' => ['country' => 'US', 'models' => ['Grand Cherokee', 'Wrangler', 'Compass', 'Cherokee', 'Renegade', 'Gladiator', 'Patriot']],
            'Dodge' => ['country' => 'US', 'models' => ['Charger', 'Challenger', 'Durango', 'Journey', 'Ram 1500']],
            'Chrysler' => ['country' => 'US', 'models' => ['300', 'Pacifica', 'Voyager']],
            'Cadillac' => ['country' => 'US', 'models' => ['Escalade', 'XT5', 'CT5', 'XT4', 'XT6', 'CT4']],
            'GMC' => ['country' => 'US', 'models' => ['Sierra', 'Yukon', 'Terrain', 'Acadia', 'Canyon']],
            'Buick' => ['country' => 'US', 'models' => ['Enclave', 'Encore', 'Envision', 'LaCrosse']],
            'Lincoln' => ['country' => 'US', 'models' => ['Navigator', 'Aviator', 'Corsair', 'Nautilus']],
            'Tesla' => ['country' => 'US', 'models' => ['Model 3', 'Model S', 'Model X', 'Model Y', 'Cybertruck']],
            'Ram' => ['country' => 'US', 'models' => ['1500', '2500', '3500']],
            'Hummer' => ['country' => 'US', 'models' => ['H2', 'H3', 'EV']],

            // South Korea
            'Hyundai' => ['country' => 'KR', 'models' => ['Solaris', 'Creta', 'Tucson', 'Santa Fe', 'Elantra', 'Sonata', 'Accent', 'Palisade', 'Kona', 'i30', 'ix35', 'Getz', 'Genesis Coupe', 'Staria']],
            'Kia' => ['country' => 'KR', 'models' => ['Rio', 'Sportage', 'Sorento', 'Ceed', 'Optima', 'Cerato', 'Soul', 'Picanto', 'Stinger', 'Telluride', 'Seltos', 'Carnival', 'K5']],
            'Genesis' => ['country' => 'KR', 'models' => ['G70', 'G80', 'G90', 'GV70', 'GV80']],
            'SsangYong' => ['country' => 'KR', 'models' => ['Korando', 'Rexton', 'Actyon', 'Tivoli', 'Kyron', 'Musso']],
            'Daewoo' => ['country' => 'KR', 'models' => ['Nexia', 'Matiz', 'Lanos', 'Gentra']],

            // France
            'Renault' => ['country' => 'FR', 'models' => ['Logan', 'Duster', 'Sandero', 'Megane', 'Kaptur', 'Arkana', 'Clio', 'Fluence', 'Koleos', 'Captur', 'Talisman', 'Scenic', 'Kangoo']],
            'Peugeot' => ['country' => 'FR', 'models' => ['208', '308', '408', '508', '2008', '3008', '5008', 'Partner', 'Traveller']],
            'Citroën' => ['country' => 'FR', 'models' => ['C3', 'C4', 'C5 Aircross', 'Berlingo', 'C4 Cactus', 'C5', 'Jumpy']],
            'DS' => ['country' => 'FR', 'models' => ['DS 3', 'DS 4', 'DS 7', 'DS 9']],

            // Italy
            'Fiat' => ['country' => 'IT', 'models' => ['Panda', '500', 'Tipo', 'Doblo', 'Punto', 'Albea', 'Ducato', '500X']],
            'Alfa Romeo' => ['country' => 'IT', 'models' => ['Giulia', 'Stelvio', 'Giulietta', '4C', 'MiTo']],
            'Lancia' => ['country' => 'IT', 'models' => ['Ypsilon', 'Delta', 'Thema']],
            'Ferrari' => ['country' => 'IT', 'models' => ['488', 'Roma', 'Portofino', 'F8 Tributo', 'SF90', '812 Superfast']],
            'Lamborghini' => ['country' => 'IT', 'models' => ['Huracan', 'Urus', 'Aventador', 'Revuelto']],
            'Maserati' => ['country' => 'IT', 'models' => ['Ghibli', 'Levante', 'Quattroporte', 'MC20', 'Grecale']],

            // United Kingdom
            'Land Rover' => ['country' => 'GB', 'models' => ['Range Rover', 'Discovery', 'Defender', 'Range Rover Evoque', 'Range Rover Sport', 'Range Rover Velar', 'Discovery Sport', 'Freelander']],
            'Jaguar' => ['country' => 'GB', 'models' => ['XE', 'XF', 'F-Pace', 'XJ', 'E-Pace', 'F-Type', 'I-Pace']],
            'Mini' => ['country' => 'GB', 'models' => ['Cooper', 'Countryman', 'Clubman', 'Paceman']],
            'Bentley' => ['country' => 'GB', 'models' => ['Continental', 'Bentayga', 'Flying Spur', 'Mulsanne']],
            'Rolls-Royce' => ['country' => 'GB', 'models' => ['Phantom', 'Ghost', 'Cullinan', 'Wraith', 'Dawn']],
            'Aston Martin' => ['country' => 'GB', 'models' => ['DB11', 'Vantage', 'DBX', 'DBS Superleggera']],
            'Vauxhall' => ['country' => 'GB', 'models' => ['Astra', 'Corsa', 'Insignia', 'Mokka']],
            'MG' => ['country' => 'GB', 'models' => ['ZS', 'HS', '5', 'MG3', 'Marvel R']],
            'McLaren' => ['country' => 'GB', 'models' => ['720S', 'Artura', 'GT', '570S']],

            // Sweden
            'Volvo' => ['country' => 'SE', 'models' => ['XC40', 'XC60', 'XC90', 'S60', 'S90', 'V60', 'V90', 'C40']],
            'Saab' => ['country' => 'SE', 'models' => ['9-3', '9-5']],

            // Czech Republic
            'Škoda' => ['country' => 'CZ', 'models' => ['Octavia', 'Rapid', 'Kodiaq', 'Karoq', 'Superb', 'Fabia', 'Yeti', 'Kamiq', 'Scala']],

            // Spain
            'SEAT' => ['country' => 'ES', 'models' => ['Leon', 'Ibiza', 'Ateca', 'Arona', 'Toledo', 'Tarraco']],

            // Romania
            'Dacia' => ['country' => 'RO', 'models' => ['Duster', 'Sandero', 'Logan', 'Dokker', 'Lodgy', 'Spring']],

            // Russia
            'Lada' => ['country' => 'RU', 'models' => ['Vesta', 'Granta', 'Niva', 'XRAY', 'Largus', '2107', '2110', 'Kalina', 'Priora', 'Niva Travel']],
            'GAZ' => ['country' => 'RU', 'models' => ['Gazelle', 'Sobol', 'Volga']],
            'UAZ' => ['country' => 'RU', 'models' => ['Patriot', 'Hunter', 'Buhanka', 'Pickup']],
            'Moskvich' => ['country' => 'RU', 'models' => ['3', '6', '412']],

            // China
            'Geely' => ['country' => 'CN', 'models' => ['Coolray', 'Atlas', 'Emgrand', 'Tugella', 'Monjaro', 'Okavango']],
            'Chery' => ['country' => 'CN', 'models' => ['Tiggo 7', 'Tiggo 8', 'Tiggo 4', 'Arrizo', 'Tiggo 3']],
            'Great Wall' => ['country' => 'CN', 'models' => ['Poer', 'Hover H6']],
            'Haval' => ['country' => 'CN', 'models' => ['Jolion', 'F7', 'H6', 'Dargo', 'M6']],
            'BYD' => ['country' => 'CN', 'models' => ['Han', 'Tang', 'Song Plus', 'Atto 3', 'Seal', 'Dolphin']],
            'Changan' => ['country' => 'CN', 'models' => ['CS35 Plus', 'CS55', 'Uni-K', 'Uni-T', 'Eado']],
            'GAC' => ['country' => 'CN', 'models' => ['GS4', 'GS8', 'Empow']],
            'Lifan' => ['country' => 'CN', 'models' => ['X60', 'Solano', 'Smily']],
            'FAW' => ['country' => 'CN', 'models' => ['Besturn X40', 'Bestune T77']],
            'Zeekr' => ['country' => 'CN', 'models' => ['001', 'X', '009']],
            'Omoda' => ['country' => 'CN', 'models' => ['C5']],
            'Exeed' => ['country' => 'CN', 'models' => ['TXL', 'VX', 'LX']],

            // India
            'Tata' => ['country' => 'IN', 'models' => ['Nexon', 'Harrier', 'Safari', 'Tiago', 'Punch']],
            'Mahindra' => ['country' => 'IN', 'models' => ['Scorpio', 'XUV700', 'Thar', 'Bolero']],

            // Malaysia
            'Proton' => ['country' => 'MY', 'models' => ['Saga', 'X70', 'Persona']],

            // Iran
            'Iran Khodro' => ['country' => 'IR', 'models' => ['Samand', 'Dena', 'Runna']],

            // Ukraine
            'ZAZ' => ['country' => 'UA', 'models' => ['Lanos', 'Sens', 'Vida']],
        ];

        foreach ($brands as $brandName => $data) {
            $brand = Brand::create([
                'name' => $brandName,
                'country_code' => $data['country'],
            ]);

            foreach ($data['models'] as $modelName) {
                $brand->carModels()->create(['name' => $modelName]);
            }
        }
    }
}
