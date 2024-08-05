<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Elasticsearch;

use CodelyTv\Criteria\Criteria;

use function Lambdish\Phunctional\reduce;

final class CriteriaToElasticsearchConverter
{
	public function convert(string $indexName, Criteria $criteria): array
	{
		return [
			'index' => $indexName,
			'body' => array_merge(
				$this->formatPagination($criteria),
				$this->formatQuery($criteria),
				$this->formatSort($criteria)
			),
		];
	}

	private function formatPagination(Criteria $criteria): array
	{
		$pageSize = $criteria->pageSize() ?? 1000;
		$pageNumber = $criteria->pageNumber() ?? 1;

		$from = ($pageNumber - 1) * $pageSize;

		return [
			'from' => $from,
			'size' => $pageSize,
		];
	}

	private function formatQuery(Criteria $criteria): array
	{
		if ($criteria->hasFilters()) {
			return [
				'query' => [
					'bool' => reduce(new ElasticQueryGenerator(), $criteria->filters(), []),
				],
			];
		}

		return [];
	}

	private function formatSort(Criteria $criteria): array
	{
		if ($criteria->hasOrder()) {
			$order = $criteria->order();

			return [
				'sort' => [
					$order->orderBy()->value() => [
						'order' => $order->orderType()->value,
					],
				],
			];
		}

		return [];
	}
}
