<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromUrl;

use CodelyTv\Criteria\Criteria;
use Illuminate\Http\Request;

final class CriteriaFromLaravelRequestConverter
{
	private CriteriaFromUrlConverter $converter;

	public function __construct()
	{
		$this->converter = new CriteriaFromUrlConverter();
	}

	public function toCriteria(Request $request): Criteria
	{
		$url = $request->fullUrl();

		return $this->converter->toCriteria($url);
	}

	public function toFiltersPrimitives(Request $request): array
	{
		$url = $request->fullUrl();

		return $this->converter->toFiltersPrimitives($url);
	}
}
