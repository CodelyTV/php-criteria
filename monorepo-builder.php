<?php

declare(strict_types=1);

use Symplify\MonorepoBuilder\Config\MBConfig;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\PushTagReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\SetCurrentMutualDependenciesReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\TagVersionReleaseWorker;
use Symplify\MonorepoBuilder\Release\ReleaseWorker\UpdateReplaceReleaseWorker;

return static function (MBConfig $mbConfig): void {
	$mbConfig->packageDirectories([__DIR__ . '/packages']);

	$mbConfig->defaultBranch('main');

	$mbConfig->workers([
		UpdateReplaceReleaseWorker::class,
		SetCurrentMutualDependenciesReleaseWorker::class,
		TagVersionReleaseWorker::class,
		PushTagReleaseWorker::class,
	]);
};
