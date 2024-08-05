<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Eloquent;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\FilterOperator;
use Illuminate\Database\Eloquent\Builder;

final readonly class CriteriaToEloquentConverter
{
	private const OPERATORS = [
		FilterOperator::EQUAL->value => '=',
		FilterOperator::NOT_EQUAL->value => '!=',
		FilterOperator::GT->value => '>',
		FilterOperator::LT->value => '<',
		FilterOperator::CONTAINS->value => 'like',
		FilterOperator::NOT_CONTAINS->value => 'not like',
	];

	public function convert(Builder $queryBuilder, Criteria $criteria): Builder
	{
		foreach ($criteria->filters()->filters() as $filter) {
			$operator = self::OPERATORS[$filter->operator()->value];

			$value = $filter->operator()->isContaining() ? "%{$filter->value()->value()}%" : $filter->value()->value();

			$queryBuilder->where($filter->field()->value(), $operator, $value);
		}

		if ($criteria->hasOrder()) {
			$queryBuilder->orderBy($criteria->order()->orderBy()->value(), $criteria->order()->orderType()->value);
		}

		if ($criteria->hasPagination()) {
			$queryBuilder->offset(($criteria->pageNumber() - 1) * $criteria->pageSize());
			$queryBuilder->limit($criteria->pageSize());
		}

		return $queryBuilder;
	}
}
