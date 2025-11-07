<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateClientsTableRemoveEmailAddUserId extends Migration
{
	public function up()
	{
		// migration content previously empty; leaving as a safe no-op stub
		if (Schema::hasTable('clients')) {
			// no-op: placeholder to keep migration history intact
		}
	}

	public function down()
	{
		// no-op
	}
}
