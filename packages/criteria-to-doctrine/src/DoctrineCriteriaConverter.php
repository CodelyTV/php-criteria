<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Doctrine;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\Filter;
use CodelyTv\Criteria\FilterField;
use CodelyTv\Criteria\OrderBy;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

final readonly class DoctrineCriteriaConverter
{
	public function __construct(
		private array $criteriaToDoctrineFields = [],
		private array $hydrators = []
	) {}

	public function convert(Criteria $criteria): DoctrineCriteria
	{
		return new DoctrineCriteria(
			$this->buildExpression($criteria),
			$this->formatOrder($criteria),
			$criteria->pageNumber(),
			$criteria->pageSize()
		);
	}

	private function buildExpression(Criteria $criteria): ?CompositeExpression
	{
		if ($criteria->hasFilters()) {
			return new CompositeExpression(
				CompositeExpression::TYPE_AND,
				array_map($this->buildComparison(), $criteria->plainFilters())
			);
		}

		return null;
	}

	private function buildComparison(): callable
	{
		return function (Filter $filter): Comparison {
			$field = $this->mapFieldValue($filter->field());
			$value = $this->existsHydratorFor($field)
				? $this->hydrate($field, $filter->value()->value())
				: $filter->value()->value();

			return new Comparison($field, $filter->operator()->value, $value);
		};
	}

	private function mapFieldValue(FilterField $field): mixed
	{
		return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
			? $this->criteriaToDoctrineFields[$field->value()]
			: $field->value();
	}

	private function formatOrder(Criteria $criteria): ?array
	{
		if (!$criteria->hasOrder()) {
			return null;
		}

		return [$this->mapOrderBy($criteria->order()->orderBy()) => $criteria->order()->orderType()];
	}

	private function mapOrderBy(OrderBy $field): mixed
	{
		return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
			? $this->criteriaToDoctrineFields[$field->value()]
			: $field->value();
	}

	private function existsHydratorFor(mixed $field): bool
	{
		return array_key_exists($field, $this->hydrators);
	}

	private function hydrate(mixed $field, string $value): mixed
	{
		return $this->hydrators[$field]($value);
	}
}
