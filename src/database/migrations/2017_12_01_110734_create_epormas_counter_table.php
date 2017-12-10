<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpormasCounterTable extends Migration {

	public function up()
	{
		Schema::create('epormas_counter', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('tahun')->unsigned()->index();
			$table->string('bulan', 2)->index();
			$table->datetime('tanggal')->index();
			$table->integer('count')->unsigned()->index();
			$table->string('via')->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('category_id')->unsigned()->index();
			$table->integer('city_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::dropIfExists('epormas_counter');
	}
}
