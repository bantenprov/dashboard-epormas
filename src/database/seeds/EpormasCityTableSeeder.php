<?php

use Illuminate\Database\Seeder;
use Bantenprov\DashboardEpormas\Models\EpormasCity;

class EpormasCityTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('epormas_city')->delete();

		// create_epormas_city_20171201000000
		EpormasCity::create(array(
				'name' => 'Kabupaten Pandeglang'
			));
		EpormasCity::create(array(
				'name' => 'Kabupaten Lebak'
			));
		EpormasCity::create(array(
				'name' => 'Kabupaten Tangerang'
			));
		EpormasCity::create(array(
				'name' => 'Kabupaten Serang'
			));
		EpormasCity::create(array(
				'name' => 'Kota Tangerang'
			));
		EpormasCity::create(array(
				'name' => 'Kota Cilegon'
			));
		EpormasCity::create(array(
				'name' => 'Kota Serang'
			));
		EpormasCity::create(array(
				'name' => 'Kota Tangerang Selatan'
			));
	}
}
