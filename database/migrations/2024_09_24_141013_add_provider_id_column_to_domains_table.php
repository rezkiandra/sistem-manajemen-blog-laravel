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
		Schema::table('domains', function (Blueprint $table) {
			$table->foreignUlid('provider_id')->nullable()->after('domain')->constrained()->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('domains', function (Blueprint $table) {
			$table->dropForeign(['provider_id']);
			$table->dropColumn('provider_id');
		});
	}
};
