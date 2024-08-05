<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromSymfonyRequest;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\FromUrl\CriteriaFromUrlConverter;
use Symfony\Component\HttpFoundation\Request;

final class CriteriaFromSymfonyRequestConverter
{
	private CriteriaFromUrlConverter $converter;

	public function __construct()
	{
		$this->converter = new CriteriaFromUrlConverter();
	}

	public function toCriteria(Request $request): Criteria
	{
		$url = $request->getRequestUri();

		return $this->converter->toCriteria($url);
	}

	public function toFiltersPrimitives(Request $request): array
	{
		$url = $request->getRequestUri();

		return $this->converter->toFiltersPrimitives($url);
	}
}
