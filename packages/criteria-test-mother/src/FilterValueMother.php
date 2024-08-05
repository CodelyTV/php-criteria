<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\FilterValue;
use Faker\Factory;

final class FilterValueMother
{
	public static function create(?string $value = null): FilterValue
	{
		return new FilterValue($value ?? Factory::create()->word());
	}
}
