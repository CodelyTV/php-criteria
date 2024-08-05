<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromUrl;

use CodelyTv\Criteria\Criteria;

final class CriteriaFromUrlConverter
{
	public function toCriteria(string $url): Criteria
	{
		$parsedUrl = parse_url($url);
		parse_str($parsedUrl['query'] ?? '', $searchParams);

		return Criteria::fromPrimitives(
			$searchParams['filters'],
			$searchParams['orderBy'] ?? null,
			$searchParams['order'] ?? null,
			isset($searchParams['pageSize']) ? (int) $searchParams['pageSize'] : null,
			isset($searchParams['pageNumber']) ? (int) $searchParams['pageNumber'] : null
		);
	}

	public function toFiltersPrimitives(string $url): array
	{
		$parsedUrl = parse_url($url);
		parse_str($parsedUrl['query'] ?? '', $searchParams);

		return $searchParams['filters'];
	}
}
