<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromLaravelRequestToEloquent;

use CodelyTv\Criteria\Eloquent\CriteriaToEloquentConverter;
use CodelyTv\Criteria\FromLaravelRequest\CriteriaFromLaravelRequestConverter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class CriteriaFromLaravelRequestToEloquentConverter
{
	public static function convert(Builder $queryBuilder, Request $request): Builder {
		$criteria = CriteriaFromLaravelRequestConverter::convert($request);

		return CriteriaToEloquentConverter::convert($queryBuilder, $criteria);
	}
}
