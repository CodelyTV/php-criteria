<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\FilterOperator;
use CodelyTv\Criteria\Filters;
use CodelyTv\Criteria\Order;
use CodelyTv\Criteria\OrderType;

final class CriteriaMother
{
	public static function create(
		Filters $filters,
		Order $order = null,
		?int $pageSize = null,
		?int $pageNumber = null
	): Criteria {
		return new Criteria($filters, $order ?: OrderMother::none(), $pageSize, $pageNumber);
	}

	public static function empty(): Criteria
	{
		return self::create(FiltersMother::blank(), OrderMother::none());
	}

	public static function fromPrimitives(array $values): Criteria
	{
		$filters = [];
		foreach ($values['filters'] ?? [] as $filter) {
			$filters[] = FilterMother::create(
				FilterFieldMother::create($filter['field']),
				FilterOperator::from($filter['operator']),
				FilterValueMother::create($filter['value'])
			);
		}

		$order = null;
		if (isset($values['orderBy']) && isset($values['orderType'])) {
			$order = OrderMother::create(OrderByMother::create($values['orderBy']), OrderType::from($values['orderType']));
		}

		return new Criteria(
			FiltersMother::create($filters),
			$order ?: OrderMother::none(),
			$values['pageSize'] ?? null,
			$values['pageNumber'] ?? null
		);
	}

	public static function withOneFilter(string $field, string $operator, string $value): Criteria
	{
		return self::create(FiltersMother::createOne(FilterMother::create(
			FilterFieldMother::create($field),
			FilterOperator::from($operator),
			FilterValueMother::create($value)
		)), OrderMother::none());
	}

	public static function emptySorted(string $orderBy, string $orderType): Criteria
	{
		return self::create(
			FiltersMother::blank(),
			OrderMother::create(OrderByMother::create($orderBy), OrderType::from($orderType))
		);
	}

	public static function withPagination(?int $pageSize, ?int $pageNumber): Criteria
	{
		return self::create(FiltersMother::blank(), OrderMother::none(), $pageSize, $pageNumber);
	}
}
