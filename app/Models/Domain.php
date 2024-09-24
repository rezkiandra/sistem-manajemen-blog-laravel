<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
	use HasFactory;

	protected $primaryKey = 'domain_id';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'domain_id',
		'domain',
		'provider',
		'email',
		'password',
		'masa_aktif',
		'expired_at'
	];

	protected static function boot()
	{
		parent::boot();
		static::creating(function ($model) {
			if (!$model->getKey()) {
				$model->setAttribute($model->getKeyName(), Str::ulid());
			}
		});
	}

	protected function getProviderOption()
	{
		return [
			'Telkomsel' => 'Telkomsel',
			'Google' => 'Google',
			'Indosat' => 'Indosat'
		];
	}
}
