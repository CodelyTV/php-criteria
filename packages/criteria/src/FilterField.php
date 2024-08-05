<?php

declare(strict_types=1);

namespace CodelyTv\Criteria;

final class FilterField
{
	public function __construct(protected string $value) {}

	public function value(): string
	{
		return $this->value;
	}
}
