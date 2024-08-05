<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\FromUrl\Tests;

use CodelyTv\Criteria\FromUrl\CriteriaFromUrlConverter;
use CodelyTv\Criteria\Mother\CriteriaMother;
use PHPUnit\Framework\TestCase;

final class CriteriaFromUrlConverterTest extends TestCase
{
	private CriteriaFromUrlConverter $converter;

	protected function setUp(): void
	{
		$this->converter = new CriteriaFromUrlConverter();
	}

	public function test_converts_url_with_one_filter(): void
	{
		$url = 'http://localhost:3000/api/users?filters[0][field]=name&filters[0][operator]=CONTAINS&filters[0][value]=Javi';

		$expectedCriteria = CriteriaMother::withOneFilter('name', 'CONTAINS', 'Javi');

		$this->assertEquals($expectedCriteria, $this->converter->toCriteria($url));
	}

	public function test_converts_url_with_multiple_filters(): void
	{
		$url = 'http://localhost:3000/api/users?filters[0][field]=name&filters[0][operator]=CONTAINS&filters[0][value]=Javi&filters[1][field]=email&filters[1][operator]=CONTAINS&filters[1][value]=gmail';

		$expectedCriteria = CriteriaMother::fromPrimitives([
			'filters' => [
				[
					'field' => 'name',
					'operator' => 'CONTAINS',
					'value' => 'Javi',
				],
				[
					'field' => 'email',
					'operator' => 'CONTAINS',
					'value' => 'gmail',
				],
			],
			'orderBy' => null,
			'orderType' => null,
			'pageSize' => null,
			'pageNumber' => null,
		]);

		$this->assertEquals($expectedCriteria, $this->converter->toCriteria($url));
	}

	public function test_converts_url_with_multiple_filters_without_order_and_pagination(): void
	{
		$url = 'http://localhost:3000/api/users'
			. '?filters[0][field]=name&filters[0][operator]=CONTAINS&filters[0][value]=Javi'
			. '&filters[1][field]=email&filters[1][operator]=CONTAINS&filters[1][value]=gmail';

		$expectedCriteria = CriteriaMother::fromPrimitives([
			'filters' => [
				[
					'field' => 'name',
					'operator' => 'CONTAINS',
					'value' => 'Javi',
				],
				[
					'field' => 'email',
					'operator' => 'CONTAINS',
					'value' => 'gmail',
				],
			],
			'orderBy' => null,
			'orderType' => null,
			'pageSize' => null,
			'pageNumber' => null,
		]);

		$this->assertEquals($expectedCriteria, $this->converter->toCriteria($url));
	}

	public function test_converts_url_with_multiple_filters_order_and_pagination(): void
	{
		$url = 'http://localhost:3000/api/users'
			. '?filters[0][field]=name&filters[0][operator]=CONTAINS&filters[0][value]=Javi'
			. '&filters[1][field]=email&filters[1][operator]=CONTAINS&filters[1][value]=gmail'
			. '&orderBy=name&order=asc'
			. '&pageSize=10&pageNumber=2';

		$expectedCriteria = CriteriaMother::fromPrimitives([
			'filters' => [
				[
					'field' => 'name',
					'operator' => 'CONTAINS',
					'value' => 'Javi',
				],
				[
					'field' => 'email',
					'operator' => 'CONTAINS',
					'value' => 'gmail',
				],
			],
			'orderBy' => 'name',
			'orderType' => 'asc',
			'pageSize' => 10,
			'pageNumber' => 2,
		]);

		$this->assertEquals($expectedCriteria, $this->converter->toCriteria($url));
	}
}
