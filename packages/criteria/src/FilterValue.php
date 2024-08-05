<?php

declare(strict_types=1);

namespace CodelyTv\Criteria;

final class FilterValue
{
	public function __construct(protected string $value) {}

	public function value(): string
	{
		return $this->value;
	}
}
