<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\FilterField;
use Faker\Factory;

final class FilterFieldMother
{
	public static function create(?string $fieldName = null): FilterField
	{
		return new FilterField($fieldName ?? Factory::create()->word());
	}
}
