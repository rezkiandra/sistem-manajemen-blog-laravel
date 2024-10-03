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
		Schema::create('blog_keywords', function (Blueprint $table) {
			$table->ulid('id')->primary();
			$table->foreignUlid('blog_id')->constrained()->cascadeOnDelete();
			$table->json('keyword')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('blog_keywords');
	}
};