<?php

use Illuminate\Database\Seeder;
use Bantenprov\DashboardEpormas\Models\EpormasCounter;

class EpormasCounterTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('epormas_counter')->delete();

		// create_epormas_counter_20171201000000
		EpormasCounter::create(array(
				'tanggal' => '2017-12-01 00:00:12',
				'count' => 1,
				'via' => 'form',
				'user_id' => 1,
				'tahun' => 2017,
				'bulan' => 12,
				'category_id' => 1,
				'city_id' => 1
			));
	}
}
