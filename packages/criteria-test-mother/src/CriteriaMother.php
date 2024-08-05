<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\Filters;
use CodelyTv\Criteria\Order;

final class CriteriaMother
{
	public static function create(
		Filters $filters,
		Order $order = null,
		int $offset = null,
		int $limit = null
	): Criteria {
		return new Criteria($filters, $order ?: OrderMother::none(), $offset, $limit);
	}

	public static function empty(): Criteria
	{
		return self::create(FiltersMother::blank(), OrderMother::none());
	}
}
