<?php

namespace App\Models;

use App\Models\Topic;
use App\Models\Provider;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
	use HasFactory, HasUlids;

	protected $keyType = 'string';
	public $incrementing = false;

	protected $fillable = [
		'domain',
		'ip',
		'provider_id',
		'topic_id',
		'traffic_views',
		'status',
		'domain_authority',
		'domain_rating',
		'lang',
		'pic',
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
		return $this->belongsTo(Provider::class);
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}
	
	public function blogKeyword()
	{
		return $this->hasMany(BlogKeyword::class);
	}

	protected function getLanguages()
	{
		return [
			['Indonesia' => 'Indonesia'],
			['Inggris' => 'Inggris'],
		];
	}
}
