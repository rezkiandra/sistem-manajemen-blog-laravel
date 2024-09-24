<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vps extends Model
{
	use HasFactory;

	protected $primaryKey = 'vps_id';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'vps_id',
		'provider',
		'email',
		'password',
		'ip',
		'cpu',
		'ram'
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
