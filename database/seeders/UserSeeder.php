<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$user = new User();
		$user = $user->create([
			'name' => 'admin',
			'email' => 'admin@localhost.com',
			'password' => Hash::make('laravel')
		]);
	}
}
