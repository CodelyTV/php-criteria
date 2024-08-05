<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromLaravelRequest;

use CodelyTv\Criteria\Criteria;
use CodelyTv\Criteria\FromUrl\CriteriaFromUrlConverter;
use Illuminate\Http\Request;

final class CriteriaFromLaravelRequestConverter
{
	private CriteriaFromUrlConverter $converter;

	public function __construct()
	{
		$this->converter = new CriteriaFromUrlConverter();
	}

	public static function convert(Request $request): Criteria
	{
		return (new self())->toCriteria($request);
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
