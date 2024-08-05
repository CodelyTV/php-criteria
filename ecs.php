<?php

use CodelyTv\CodingStyle;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return function (ECSConfig $ecsConfig): void {
	$ecsConfig->paths([
		__DIR__ . '/packages/criteria/src',
		__DIR__ . '/packages/criteria-test-mother/src',
		__DIR__ . '/packages/criteria-to-elasticsearch/src',
	]);

	$ecsConfig->sets([CodingStyle::DEFAULT]);
};
