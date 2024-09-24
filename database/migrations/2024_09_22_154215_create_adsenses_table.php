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
		Schema::create('adsenses', function (Blueprint $table) {
			$table->ulid('id')->primary();
			$table->string('domain', 100)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('password')->nullable();
			$table->string('status', 10)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('adsenses');
	}
};
