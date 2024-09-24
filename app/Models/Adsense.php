<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adsense extends Model
{
	use HasFactory, HasUlids;

	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'domain',
		'email',
		'password',
		'status'
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

	protected function getOptionStatus()
	{
		return [
			'PIN PO' => 'PIN PO',
			'PIN' => 'PIN',
			'Fresh' => 'Fresh',
			'Kosong' => 'Kosong',
		];
	}
}
