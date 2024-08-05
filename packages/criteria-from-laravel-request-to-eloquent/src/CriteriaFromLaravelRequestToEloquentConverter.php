<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromLaravelRequestToEloquent;

use CodelyTv\Criteria\Eloquent\CriteriaToEloquentConverter;
use CodelyTv\Criteria\FromLaravelRequest\CriteriaFromLaravelRequestConverter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class CriteriaFromLaravelRequestToEloquentConverter
{
	private CriteriaFromLaravelRequestConverter $fromConverter;
	private CriteriaToEloquentConverter $toConverter;

	public function __construct()
	{
		$this->fromConverter = new CriteriaFromLaravelRequestConverter();
		$this->toConverter = new CriteriaToEloquentConverter();
	}

	public static function convert(Builder $queryBuilder, Request $request): Builder {
		$converter = new self();

		return $converter->toEloquent($queryBuilder, $request);
	}

	public function toEloquent(Builder $queryBuilder, Request $request): Builder
	{
		$criteria = $this->fromConverter->toCriteria($request);

		return $this->toConverter->convert($queryBuilder, $criteria);
	}
}
