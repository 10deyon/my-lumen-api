<?php

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                "code" => "044",
                "bankName" => "Access Bank"
            ],
            [
                "code" => "023",
                "bankName" => "CITI Bank"
            ],
            [
                "code" => "063",
                "bankName" => "Access (Diamond) Bank"
            ],
            [
                "code" => "050",
                "bankName" => "EcoBank"
            ],
            [
                "code" => "070",
                "bankName" => "Fidelity Bank"
            ],
            [
                "code" => "011",
                "bankName" => "First Bank"
            ],
            [
                "code" => "214",
                "bankName" => "FCMB"
            ],
            [
                "code" => "058",
                "bankName" => "GT Bank"
            ],
            [
                "code" => "030",
                "bankName" => "Heritage Bank"
            ],
            [
                "code" => "301",
                "bankName" => "Jaiz Bank"
            ],
            [
                "code" => "082",
                "bankName" => "Keystone Bank"
            ],
            [
                "code" => "076",
                "bankName" => "Polaris Bank"
            ],
            [
                "code" => "101",
                "bankName" => "Providus Bank"
            ],
            [
                "code" => "221",
                "bankName" => "Stanbic IBTC"
            ],
            [
                "code" => "068",
                "bankName" => "Standard Chartered"
            ],
            [
                "code" => "232",
                "bankName" => "Sterling Bank"
            ],
            [
                "code" => "032",
                "bankName" => "Union Bank"
            ],
            [
                "code" => "033",
                "bankName" => "UBA"
            ],
            [
                "code" => "215",
                "bankName" => "Unity Bank"
            ],
            [
                "code" => "035",
                "bankName" => "Wema Bank"
            ],
            [
                "code" => "057",
                "bankName" => "Zenith Bank"
            ],
            [
                "code" => "100",
                "bankName" => "SunTrust Bank"
            ]
        ];

        Bank::truncate();
        foreach ($banks as $bank) {
            Bank::create([
                "name" => $bank["bankName"],
                "code" => $bank["code"],
                "active" => true
            ]);
        }
    }
}
