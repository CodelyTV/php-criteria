<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Mother;

use CodelyTv\Criteria\Order;
use CodelyTv\Criteria\OrderBy;
use CodelyTv\Criteria\OrderType;
use Faker\Factory;

final class OrderMother
{
	public static function create(?OrderBy $orderBy = null, ?OrderType $orderType = null): Order
	{
		return new Order($orderBy ?? OrderByMother::create(), $orderType ?? self::randomOrderType());
	}

	public static function none(): Order
	{
		return Order::none();
	}

	private static function randomOrderType(): Order
	{
		return Factory::create()->randomElement([OrderType::ASC, OrderType::DESC, OrderType::NONE]);
	}
}
