<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalGovtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'lga' => 'Abia west',
                'lga_code' => '011',
                'state_id' => '1',
            ],

            [
                'lga' => 'Aba North',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Aba South',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Arochukwu',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Bende',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Ikwuano',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Isiala Ngwa North',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Isiala Ngwa South',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Isuikwuato',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Obi Ngwa',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Ohafia',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Osisioma',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Ugwunagbo',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Ukwa East',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Ukwa West',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Umuahia North',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Umuahia South',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Umu Nneochi',
                'lga_code' => '4201',
                'state_id' => '1',
            ],

            [
                'lga' => 'Demsa',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Fufure',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Ganye',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Gayuk',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Gombi',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Grie',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Hong',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Jada',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Larmurde',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Madagali',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Maiha',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Mayo Belwa',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Michika',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Mubi North',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Mubi South',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Numan',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Shelleng',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Song',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Toungo',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Yola North',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Yola South',
                'lga_code' => '4202',
                'state_id' => '2',
            ],

            [
                'lga' => 'Abak',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Eastern Obolo',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Eket',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Esit Eket',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Essien Udim',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Etim Ekpo',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Etinan',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ibeno',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ibesikpo Asutan',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ibiono-Ibom',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ika',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ikono',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ikot Abasi',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ikot Ekpene',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ini',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Itu',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Mbo',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Mkpat-Enin',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Nsit-Atai',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Nsit-Ibom',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Nsit-Ubium',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Obot Akara',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Okobo',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Onna',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Oron',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Oruk Anam',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Udung-Uko',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Ukanafun',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Uruan',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Urue-Offong/Oruko',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Uyo',
                'lga_code' => '4203',
                'state_id' => '3',
            ],

            [
                'lga' => 'Aguata',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Anambra East',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Anambra West',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Anaocha',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Awka North',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Awka South',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Ayamelum',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Dunukofia',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Ekwusigo',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Idemili North',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Idemili South',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Ihiala',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Njikoka',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Nnewi North',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Nnewi South',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Ogbaru',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Onitsha North',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Onitsha South',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Orumba North',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Orumba South',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Oyi',
                'lga_code' => '4204',
                'state_id' => '4',
            ],

            [
                'lga' => 'Alkaleri',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Bauchi',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Bogoro',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Damban',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Darazo',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Dass',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Gamawa',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Ganjuwa',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Giade',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Itas/Gadau',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => "Jama'are",
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Katagum',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Kirfi',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Misau',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Ningi',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Shira',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Tafawa Balewa',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Toro',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Warji',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Zaki',
                'lga_code' => '4205',
                'state_id' => '5',
            ],

            [
                'lga' => 'Brass',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Ekeremor',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Kolokuma/Opokuma',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Nembe',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Ogbia',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Sagbama',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Southern Ijaw',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Yenagoa',
                'lga_code' => '4206',
                'state_id' => '6',
            ],

            [
                'lga' => 'Agatu',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Apa',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Ado',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Buruku',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Gboko',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Guma',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Gwer East',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Gwer West',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Katsina-Ala',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Konshisha',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Kwande',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Logo',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Makurdi',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Obi',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Ogbadibo',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Ohimini',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Oju',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Okpokwu',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Oturkpo',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Tarka',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Ukum',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Ushongo',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Vandeikya',
                'lga_code' => '4207',
                'state_id' => '7',
            ],

            [
                'lga' => 'Abadam',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Askira/Uba',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Bama',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Bayo',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Biu',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Chibok',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Damboa',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Dikwa',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Gubio',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Guzamala',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Gwoza',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Hawul',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Jere',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Kaga',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Kala/Balge',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Konduga',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Kukawa',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Kwaya Kusar',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Mafa',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Magumeri',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Maiduguri',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Marte',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Mobbar',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Monguno',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Ngala',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Nganzai',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Shani',
                'lga_code' => '4208',
                'state_id' => '8',
            ],

            [
                'lga' => 'Abi',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Akamkpa',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Akpabuyo',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Bakassi',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Bekwarra',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Biase',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Boki',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Calabar Municipal',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Calabar South',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Etung',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Ikom',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Obanliku',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Obubra',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Obudu',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Odukpani',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Ogoja',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Yakuur',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Yala',
                'lga_code' => '4209',
                'state_id' => '9',
            ],

            [
                'lga' => 'Aniocha North',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Aniocha South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Bomadi',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Burutu',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ethiope East',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ethiope West',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ika North East',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ika South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Isoko North',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Isoko South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ndokwa East',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ndokwa West',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Okpe',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Oshimili North',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Oshimili South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Patani',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Sapele',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Udu',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ughelli North',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ughelli South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Ukwuani',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Uvwie',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Warri North',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Warri South',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Warri South West',
                'lga_code' => '4210',
                'state_id' => '10',
            ],

            [
                'lga' => 'Abakaliki',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Afikpo North',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Afikpo South',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ebonyi',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ezza North',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ezza South',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ikwo',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ishielu',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ivo',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Izzi',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ohaozara',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Ohaukwu',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Onicha',
                'lga_code' => '4211',
                'state_id' => '11',
            ],

            [
                'lga' => 'Akoko-Edo',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Egor',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Esan Central',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Esan North-East',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Esan South-East',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Esan West',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Etsako Central',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Etsako East',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Etsako West',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Igueben',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Ikpoba Okha',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Orhionmwon',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Oredo',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Ovia North-East',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Ovia South-West',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Owan East',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Owan West',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Uhunmwonde',
                'lga_code' => '4212',
                'state_id' => '12',
            ],

            [
                'lga' => 'Ado Ekiti',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Efon',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ekiti East',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ekiti South-West',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ekiti West',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Emure',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Gbonyin',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ido Osi',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ijero',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ikere',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ikole',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ilejemeje',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Irepodun/Ifelodun',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Ise/Orun',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Moba',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Oye',
                'lga_code' => '4213',
                'state_id' => '13',
            ],

            [
                'lga' => 'Aninri',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Awgu',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Enugu East',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Enugu North',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Enugu South',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Ezeagu',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Igbo Etiti',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Igbo Eze North',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Igbo Eze South',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Isi Uzo',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Nkanu East',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Nkanu West',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Nsukka',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Oji River',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Udenu',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Udi',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Uzo Uwani',
                'lga_code' => '4214',
                'state_id' => '14',
            ],

            [
                'lga' => 'Akko',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Balanga',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Billiri',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Dukku',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Funakaye',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Gombe',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Kaltungo',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Kwami',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Nafada',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Shongom',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Yamaltu/Deba',
                'lga_code' => '4215',
                'state_id' => '15',
            ],

            [
                'lga' => 'Aboh Mbaise',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ahiazu Mbaise',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ehime Mbano',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ezinihitte',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ideato North',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ideato South',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ihitte/Uboma',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ikeduru',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Isiala Mbano',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Isu',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Mbaitoli',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ngor Okpala',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Njaba',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Nkwerre',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Nwangele',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Obowo',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Oguta',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Ohaji/Egbema',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Okigwe',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Orlu',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Orsu',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Oru East',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Oru West',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Owerri Municipal',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Owerri North',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Owerri West',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Unuimo',
                'lga_code' => '4216',
                'state_id' => '16',
            ],

            [
                'lga' => 'Auyo',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Babura',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Biriniwa',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Birnin Kudu',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Buji',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Dutse',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Gagarawa',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Garki',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Gumel',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Guri',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Gwaram',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Gwiwa',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Hadejia',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Jahun',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Kafin Hausa',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Kazaure',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Kiri Kasama',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Kiyawa',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Kaugama',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Maigatari',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Malam Madori',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Miga',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Ringim',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Roni',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Sule Tankarkar',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Taura',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Yankwashi',
                'lga_code' => '4217',
                'state_id' => '17',
            ],

            [
                'lga' => 'Birnin Gwari',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Chikun',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Giwa',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Igabi',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Ikara',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Jaba',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => "Jema'a",
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kachia',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kaduna North',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kaduna South',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kagarko',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kajuru',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kaura',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kauru',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kubau',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Kudan',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Lere',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Makarfi',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Sabon Gari',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Sanga',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Soba',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Zangon Kataf',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Zaria',
                'lga_code' => '4218',
                'state_id' => '18',
            ],

            [
                'lga' => 'Ajingi',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Albasu',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Bagwai',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Bebeji',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Bichi',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Bunkure',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Dala',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Dambatta',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Dawakin Kudu',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Dawakin Tofa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Doguwa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Fagge',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Gabasawa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Garko',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Garun Mallam',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Gaya',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Gezawa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Gwale',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Gwarzo',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kabo',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kano Municipal',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Karaye',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kibiya',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kiru',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kumbotso',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kunchi',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Kura',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Madobi',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Makoda',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Minjibir',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Nasarawa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Rano',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Rimin Gado',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Rogo',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Shanono',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Sumaila',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Takai',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Tarauni',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Tofa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Tsanyawa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Tudun Wada',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Ungogo',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Warawa',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Wudil',
                'lga_code' => '4219',
                'state_id' => '19',
            ],

            [
                'lga' => 'Bakori',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Batagarawa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Batsari',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Baure',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Bindawa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Charanchi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Dandume',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Danja',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Dan Musa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Daura',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Dutsi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Dutsin Ma',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Faskari',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Funtua',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Ingawa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Jibia',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kafur',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kaita',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kankara',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kankia',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Katsina',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kurfi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Kusada',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => "Mai'Adua",
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Malumfashi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Mani',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Mashi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Matazu',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Musawa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Rimi',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Sabuwa',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Safana',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Sandamu',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Zango',
                'lga_code' => '4220',
                'state_id' => '20',
            ],

            [
                'lga' => 'Aleiro',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Arewa Dandi',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Argungu',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Augie',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Bagudo',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Birnin Kebbi',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Bunza',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Dandi',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Fakai',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Gwandu',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Jega',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Kalgo',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Koko/Besse',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Maiyama',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Ngaski',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Sakaba',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Shanga',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Suru',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Wasagu/Danko',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Yauri',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Zuru',
                'lga_code' => '4221',
                'state_id' => '21',
            ],

            [
                'lga' => 'Adavi',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ajaokuta',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ankpa',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Bassa',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Dekina',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ibaji',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Idah',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Igalamela Odolu',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ijumu',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Kabba/Bunu',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Kogi',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Lokoja',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Mopa Muro',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ofu',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Ogori/Magongo',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Okehi',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Okene',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Olamaboro',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Omala',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Yagba East',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Yagba West',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Asa',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Baruten',
                'lga_code' => '4222',
                'state_id' => '22',
            ],

            [
                'lga' => 'Edu',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Ekiti',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Ifelodun',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Ilorin East',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Ilorin South',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Ilorin West',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Irepodun',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Isin',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Kaiama',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Moro',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Offa',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Oke Ero',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Oyun',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Pategi',
                'lga_code' => '4223',
                'state_id' => '23',
            ],

            [
                'lga' => 'Agege',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ajeromi-Ifelodun',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Alimosho',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Amuwo-Odofin',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Apapa',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Badagry',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Epe',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Eti Osa',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ibeju-Lekki',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ifako-Ijaiye',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ikeja',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ikorodu',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Kosofe',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Lagos Island',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Lagos Mainland',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Mushin',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Ojo',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Oshodi-Isolo',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Shomolu',
                'lga_code' => '4224',
                'state_id' => '24',
            ],

            [
                'lga' => 'Akwanga',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Awe',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Doma',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Karu',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Keana',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Keffi',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Kokona',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Lafia',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Nasarawa',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Nasarawa Egon',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Obi',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Toto',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Wamba',
                'lga_code' => '4225',
                'state_id' => '25',
            ],

            [
                'lga' => 'Agaie',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Agwara',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Bida',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Borgu',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Bosso',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Chanchaga',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Edati',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Gbako',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Gurara',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Katcha',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Kontagora',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Lapai',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Lavun',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Magama',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Mariga',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Mashegu',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Mokwa',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Moya',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Paikoro',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Rafi',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Rijau',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Shiroro',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Suleja',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Tafa',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Wushishi',
                'lga_code' => '4226',
                'state_id' => '26',
            ],

            [
                'lga' => 'Abeokuta North',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Abeokuta South',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ado-Odo/Ota',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Egbado North',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Egbado South',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ewekoro',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ifo',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ijebu East',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ijebu North',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ijebu North East',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ijebu Ode',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ikenne',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Imeko Afon',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ipokia',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Obafemi Owode',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Odeda',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Odogbolu',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Ogun Waterside',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Remo North',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Shagamu',
                'lga_code' => '4227',
                'state_id' => '27',
            ],

            [
                'lga' => 'Akoko North-East',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Akoko North-West',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Akoko South-West',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Akoko South-East',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Akure North',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Akure South',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ese Odo',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Idanre',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ifedore',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ilaje',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ile Oluji/Okeigbo',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Irele',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Odigbo',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Okitipupa',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ondo East',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ondo West',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Ose',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Owo',
                'lga_code' => '4228',
                'state_id' => '28',
            ],

            [
                'lga' => 'Atakunmosa East',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Atakunmosa West',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Aiyedaade',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Aiyedire',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Boluwaduro',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Boripe',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ede North',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ede South',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ife Central',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ife East',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ife North',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ife South',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Egbedore',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ejigbo',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ifedayo',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ifelodun',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ila',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ilesa East',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ilesa West',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Irepodun',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Irewole',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Isokan',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Iwo',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Obokun',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Odo Otin',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Ola Oluwa',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Olorunda',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Oriade',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Orolu',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Osogbo',
                'lga_code' => '4229',
                'state_id' => '29',
            ],

            [
                'lga' => 'Afijio',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Akinyele',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Atiba',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Atigbo',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Egbeda',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibadan North',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibadan North-East',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibadan North-West',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibadan South-East',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibadan South-West',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibarapa Central',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibarapa East',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ibarapa North',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ido',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Irepo',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Iseyin',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Itesiwaju',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Iwajowa',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Kajola',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Lagelu',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ogbomosho North',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ogbomosho South',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ogo Oluwa',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Olorunsogo',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Oluyole',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ona Ara',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Orelope',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Ori Ire',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Oyo',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Oyo East',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Saki East',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Saki West',
                'lga_code' => '4230',
                'state_id' => '30',
            ],

            [
                'lga' => 'Bokkos',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Barkin Ladi',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Bassa',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Jos East',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Jos North',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Jos South',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Kanam',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Kanke',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Langtang South',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Langtang North',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Mangu',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Mikang',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Pankshin',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => "Qua'an Pan",
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Riyom',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Shendam',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Wase',
                'lga_code' => '4231',
                'state_id' => '31',
            ],

            [
                'lga' => 'Abua/Odual',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Ahoada East',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Ahoada West',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Akuku-Toru',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Andoni',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Asari-Toru',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Bonny',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Degema',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Eleme',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Emuoha',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Etche',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Gokana',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Ikwerre',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Khana',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Obio/Akpor',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Ogba/Egbema/Ndoni',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Ogu/Bolo',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Okrika',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Omuma',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Opobo/Nkoro',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Oyigbo',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Port Harcourt',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Tai',
                'lga_code' => '4232',
                'state_id' => '32',
            ],

            [
                'lga' => 'Binji',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Bodinga',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Dange Shuni',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Gada',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Goronyo',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Gudu',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Gwadabawa',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Illela',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Isa',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Kebbe',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Kware',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Rabah',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Sabon Birni',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Shagari',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Silame',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Sokoto North',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Sokoto South',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Tambuwal',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Tangaza',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Tureta',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Wamako',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Wurno',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Yabo',
                'lga_code' => '4233',
                'state_id' => '33',
            ],

            [
                'lga' => 'Ardo Kola',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Bali',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Donga',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Gashaka',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Gassol',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Ibi',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Jalingo',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Karim Lamido',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Kumi',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Lau',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Sardauna',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Takum',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Ussa',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Wukari',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Yorro',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Zing',
                'lga_code' => '4234',
                'state_id' => '34',
            ],

            [
                'lga' => 'Bade',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Bursari',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Damaturu',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Fika',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Fune',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Geidam',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Gujba',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Gulani',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Jakusko',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Karasuwa',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Machina',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Nangere',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Nguru',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Potiskum',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Tarmuwa',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Yunusari',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Yusufari',
                'lga_code' => '4235',
                'state_id' => '35',
            ],

            [
                'lga' => 'Anka',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Bakura',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Birnin Magaji/Kiyaw',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Bukkuyum',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Bungudu',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Gummi',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Gusau',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Kaura Namoda',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Maradun',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Maru',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Shinkafi',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Talata Mafara',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Chafe',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Zurmi',
                'lga_code' => '4236',
                'state_id' => '36',
            ],

            [
                'lga' => 'Abaji',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

            [
                'lga' => 'Bwari',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

            [
                'lga' => 'Gwagwalada',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

            [
                'lga' => 'Kuje',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

            [
                'lga' => 'Kwali',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

            [
                'lga' => 'Municipal Area Council',
                'lga_code' => '4200',
                'state_id' => '37',
            ],

        ];

        foreach ($rows as $row) {
            DB::table('local_govts')->insert($row);
        }
    }
}
