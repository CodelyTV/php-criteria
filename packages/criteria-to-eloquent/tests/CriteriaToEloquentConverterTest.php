<?php

declare(strict_types=1);

namespace CodelyTv\Criteria\Eloquent\Tests;

use CodelyTv\Criteria\Eloquent\CriteriaToEloquentConverter;
use CodelyTv\Criteria\Eloquent\Tests\Models\User;
use CodelyTv\Criteria\Mother\CriteriaMother;
use Illuminate\Database\Capsule\Manager as DB;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CriteriaToEloquentConverterTest extends TestCase
{
	private CriteriaToEloquentConverter $converter;

	protected function setUp(): void
	{
		parent::setUp();

		$this->setUpDatabase();
		$this->converter = new CriteriaToEloquentConverter();
	}

	private function setUpDatabase(): void
	{
		$db = new DB;
		$db->addConnection([
			'driver' => 'sqlite',
			'database' => ':memory:',
		]);

		$db->setAsGlobal();
		$db->bootEloquent();

		$db->getConnection()->getSchemaBuilder()->create('users', function ($table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('age');
			$table->timestamps();
		});
	}

	#[Test]
	public function it_should_generate_simple_select_with_an_empty_criteria(): void
	{
		$actualQuery = $this->converter->convert(User::query(), CriteriaMother::empty());

		$this->assertEquals('select * from "users"', $actualQuery->toRawSql());
	}

	#[Test] public function it_should_generate_select_with_order()
	{
		$actualQuery = $this->converter->convert(User::query(), CriteriaMother::emptySorted('id', 'desc'));

		$this->assertEquals('select * from "users" order by "id" desc', $actualQuery->toRawSql());
	}

	#[Test] public function it_should_generate_select_with_one_filter()
	{
		$actualQuery = $this->converter->convert(User::query(), CriteriaMother::withOneFilter('name', '=', 'javier'));

		$this->assertEquals('select * from "users" where "name" = \'javier\'', $actualQuery->toRawSql());
	}

	#[Test] public function it_should_generate_a_paginated_select()
	{
		$actualQuery = $this->converter->convert(User::query(), CriteriaMother::withPagination(100, 3));

		$this->assertEquals('select * from "users" limit 100 offset 200', $actualQuery->toRawSql());
	}
}
