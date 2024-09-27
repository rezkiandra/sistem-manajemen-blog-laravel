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
		Schema::create('blogs', function (Blueprint $table) {
			$table->ulid('id')->primary();
			$table->string('domain', 100)->nullable();
			$table->ipAddress('ip')->nullable();
			$table->foreignUlid('provider_id')->nullable()->constrained()->cascadeOnDelete();
			$table->foreignUlid('topic_id')->nullable()->constrained()->cascadeOnDelete();
			$table->integer('traffic_views')->nullable();
			$table->string('status', 100)->nullable();
			$table->integer('domain_authority')->nullable();
			$table->integer('domain_rating')->nullable();
			$table->enum('lang', ['Indonesia', 'Inggris'])->nullable();
			$table->string('pic', 100)->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('blogs');
	}
};
