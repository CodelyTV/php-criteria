<?php

declare(strict_types=1);

namespace CodelyTv\Criteria;

final readonly class Criteria
{
	/** @throws InvalidCriteria */
	public function __construct(
		private Filters $filters,
		private Order $order,
		private ?int $pageSize,
		private ?int $pageNumber
	) {
		if ($pageNumber !== null && $pageSize === null) {
			throw new InvalidCriteria();
		}
	}

	/** @throws InvalidCriteria */
	public static function fromPrimitives(
		array $filters,
		?string $orderBy,
		?string $orderType,
		?int $pageSize,
		?int $pageNumber
	): self {
		return new self(
			Filters::fromPrimitives($filters),
			Order::fromPrimitives($orderBy, $orderType),
			$pageSize,
			$pageNumber
		);
	}

	/** @throws InvalidCriteria */
	public static function withFilters(array $filters): self
	{
		return self::fromPrimitives($filters, null, null, null, null);
	}

	public function hasFilters(): bool
	{
		return $this->filters->count() > 0;
	}

	public function hasOrder(): bool
	{
		return !$this->order->isNone();
	}

	public function plainFilters(): array
	{
		return $this->filters->filters();
	}

	public function filters(): Filters
	{
		return $this->filters;
	}

	public function order(): Order
	{
		return $this->order;
	}

	public function pageSize(): ?int
	{
		return $this->pageSize;
	}

	public function pageNumber(): ?int
	{
		return $this->pageNumber;
	}

	public function serialize(): string
	{
		return sprintf(
			'%s~~%s~~%s~~%s',
			$this->filters->serialize(),
			$this->order->serialize(),
			$this->pageSize ?? 'none',
			$this->pageNumber ?? 'none'
		);
	}

	public function hasPagination(): bool
	{
		return $this->pageSize !== null && $this->pageNumber !== null;
	}
}
