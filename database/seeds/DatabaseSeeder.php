<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        FOR SOME REASON, LINES ARE BEING INSERTED AS BLANK LINES!
        $dmls = glob(database_path() . DIRECTORY_SEPARATOR . 'sqls' . DIRECTORY_SEPARATOR . '*-dml.sql');
        foreach ($dmls as $dml) {
            $inserts = file($dml);
            foreach ($inserts as $insert) {
                if (strpos($insert, 'INSERT INTO') === 0) {
                    DB::insert($insert);
                }
            }
        }
//        /**
//         * Partners
//         */
//        for ($i = 1; $i <= 5; $i++) {
//            DB::table('partner')->insert([
//                'name' => str_random('Partner ' . $i)
//            ]);
//        }
//
//        /**
//         * Currency
//         */
//        DB::table('currency')->insert([
//            'name' => str_random('Great Britain Pound'),
//            'abbreviation' => str_random('GBP')
//        ]);
//        DB::table('currency')->insert([
//            'name' => str_random('Euro'),
//            'abbreviation' => str_random('EUR')
//        ]);
//        DB::table('currency')->insert([
//            'name' => str_random('US Dollars'),
//            'abbreviation' => str_random('USD')
//        ]);
//
//
//        /**
//         * exchange_rate
//         */
//        DB::table('exchange_rate')->insert([
//            'currency_id' => 2,
//            'rate_start_date' => '2016-01-01',
//            'rate_end_date' => '2016-01-26',
//            'rate_value' => 1.371
//        ]);
//        DB::table('exchange_rate')->insert([
//            'currency_id' => 3,
//            'rate_start_date' => '2016-01-01',
//            'rate_end_date' => '2016-01-26',
//            'rate_value' => 1.2978
//        ]);
//        DB::table('exchange_rate')->insert([
//            'currency_id' => 2,
//            'rate_start_date' => '2016-01-27',
//            'rate_end_date' => '2016-01-31',
//            'rate_value' => 1.5003
//        ]);
//        DB::table('exchange_rate')->insert([
//            'currency_id' => 3,
//            'rate_start_date' => '2016-01-27',
//            'rate_end_date' => '2016-01-31',
//            'rate_value' => 1.4144
//        ]);
    }
}
