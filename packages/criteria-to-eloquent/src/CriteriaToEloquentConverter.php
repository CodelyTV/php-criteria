<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Eloquent;

use CodelyTv\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;

final readonly class CriteriaToEloquentConverter
{
	public function convert(Builder $queryBuilder, Criteria $criteria): Builder
	{
		foreach ($criteria->filters()->filters() as $filter) {
			$queryBuilder->where($filter->field()->value(), $filter->operator()->value, $filter->value()->value());
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
