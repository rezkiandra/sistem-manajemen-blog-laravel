<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueKeywordArray implements ValidationRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!is_array($value)) {
			$fail($attribute . ' harus dalam bentuk array')->translate();
			return;
		}

		$uniqueValues = array_unique($value);

		if (count($uniqueValues) !== count($value)) {
			$fail($attribute . ' yang dimasukkan harus unik')->translate();
		}
	}
}
