<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vps extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'provider_id',
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

	public function provider()
	{
		return $this->belongsTo(Provider::class, 'provider_id');
	}
}
