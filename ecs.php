<?php

declare(strict_types=1);

use CodelyTv\CodingStyle;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return function (ECSConfig $ecsConfig): void {
	$ecsConfig->paths([
		__DIR__ . '/ecs.php',
		__DIR__ . '/monorepo-builder.php',
		__DIR__ . '/packages/criteria/src',
		__DIR__ . '/packages/criteria-test-mother/src',
		__DIR__ . '/packages/criteria-to-elasticsearch/src',
		__DIR__ . '/packages/criteria-to-elasticsearch/tests',
	]);

	$ecsConfig->sets([CodingStyle::DEFAULT]);
};
