<?php

use Illuminate\Database\Seeder;
use ErnySans\Laraworld\Models\Countries;

class CountriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return  void
     */
    public function run()
    {
        // Empty the table
        Countries::truncate();

        // Get all from the JSON file
        $JSON_countries = Countries::allJSON();

        foreach ($JSON_countries as $country) {
            Countries::create([
                'name'              => ((isset($country['name'])) ? $country['name'] : null),
                'capital'           => ((isset($country['capital'])) ? $country['capital'] : null),
                'citizenship'       => ((isset($country['citizenship'])) ? $country['citizenship'] : null),
                'currency'          => ((isset($country['currency'])) ? $country['currency'] : null)
            ]);
        }
    }
}
