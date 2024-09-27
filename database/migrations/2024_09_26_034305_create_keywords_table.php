<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('keywords', function (Blueprint $table) {
			$table->ulid('id')->primary();
			$table->foreignUlid('blog_id')->nullable()->constrained()->cascadeOnDelete();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('keywords');
	}
};
