release-patch:
	@GIT_EDITOR='echo "Release" >' vendor/bin/monorepo-builder release patch

release-minor:
	@GIT_EDITOR='echo "Release" >' vendor/bin/monorepo-builder release minor

release-major:
	@GIT_EDITOR='echo "Release" >' vendor/bin/monorepo-builder release major
