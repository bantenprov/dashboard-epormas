<?php

use Illuminate\Database\Seeder;
use Bantenprov\DashboardEpormas\Models\EpormasCategory;

class EpormasCategoryTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('epormas_category')->delete();

		// create_epormas_category_20171201000000
		EpormasCategory::create(array(
				'name' => 'Pendidikan'
			));
	}
}
