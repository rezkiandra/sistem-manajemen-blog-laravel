<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
	use HasFactory, HasUlids;

	protected $primaryKey = 'provider_id';
	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'provider_id',
		'name',
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
}
