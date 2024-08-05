<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\OrderBy;
use Faker\Factory;

final class OrderByMother
{
	public static function create(?string $fieldName = null): OrderBy
	{
		return new OrderBy($fieldName ?? Factory::create()->word());
	}
}
