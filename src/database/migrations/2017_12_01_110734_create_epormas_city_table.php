<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpormasCityTable extends Migration {

	public function up()
	{
		Schema::create('epormas_city', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 191)->index();
		});
	}

	public function down()
	{
		Schema::dropIfExists('epormas_city');
	}
}
