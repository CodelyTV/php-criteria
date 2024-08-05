<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\Filter;
use CodelyTv\Criteria\FilterField;
use CodelyTv\Criteria\FilterOperator;
use CodelyTv\Criteria\FilterValue;
use Faker\Factory;

final class FilterMother
{
	public static function create(
		?FilterField $field = null,
		?FilterOperator $operator = null,
		?FilterValue $value = null
	): Filter {
		return new Filter(
			$field ?? FilterFieldMother::create(),
			$operator ?? self::randomOperator(),
			$value ?? FilterValueMother::create()
		);
	}

	/** @param string[] $values */
	public static function fromPrimitives(array $values): Filter
	{
		return Filter::fromPrimitives($values);
	}

	private static function randomOperator(): FilterOperator
	{
		return Factory::create()->randomElement(
			[
				FilterOperator::EQUAL,
				FilterOperator::NOT_EQUAL,
				FilterOperator::GT,
				FilterOperator::LT,
				FilterOperator::CONTAINS,
				FilterOperator::NOT_CONTAINS,
			]
		);
	}
}
