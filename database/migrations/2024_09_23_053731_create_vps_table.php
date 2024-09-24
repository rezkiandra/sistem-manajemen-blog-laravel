<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('vps', function (Blueprint $table) {
			$table->ulid('vps_id')->primary();
			$table->string('provider', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('password', 100)->nullable();
			$table->string('ip', 45)->nullable();
			$table->integer('cpu')->nullable();
			$table->integer('ram')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('vps');
	}
};
