<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Elasticsearch\Tests;

use CodelyTv\Criteria\Elasticsearch\CriteriaToElasticsearchConverter;
use CodelyTv\Criteria\Mother\CriteriaMother;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CriteriaToElasticsearchConverterTest extends TestCase
{
	private CriteriaToElasticsearchConverter | null $converter;

	protected function setUp(): void
	{
		parent::setUp();

		$this->converter = new CriteriaToElasticsearchConverter();
	}

	#[Test] public function it_should_generate_simple_select_with_an_empty_criteria()
	{
		$actualQuery = $this->converter->convert('users', CriteriaMother::empty());

		$this->assertEquals([
			'index' => 'users',
			'body' => [
				'from' => 0,
				'size' => 1000,
			],
		], $actualQuery);
	}

	#[Test] public function it_should_generate_select_with_order()
	{
		$actualQuery = $this->converter->convert('users', CriteriaMother::emptySorted('id', 'desc'));

		$this->assertEquals([
			'index' => 'users',
			'body' => [
				'from' => 0,
				'size' => 1000,
				'sort' => [
					'id' => ['order' => 'desc'],
				],
			],
		], $actualQuery);
	}

	#[Test] public function it_should_generate_select_with_one_filter()
	{
		$actualQuery = $this->converter->convert('users', CriteriaMother::withOneFilter('name', '=', 'Javier'));

		$this->assertEquals([
			'index' => 'users',
			'body' => [
				'from' => 0,
				'size' => 1000,
				'query' => [
					'bool' => [
						'must' => [
							'term' => ['name' => 'Javier'],
						],
					],
				],
			],
		], $actualQuery);
	}
}
