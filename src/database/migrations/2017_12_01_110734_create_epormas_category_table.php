<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpormasCategoryTable extends Migration {

	public function up()
	{
		Schema::create('epormas_category', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 191)->index();
		});
	}

	public function down()
	{
		Schema::dropIfExists('epormas_category');
	}
}
