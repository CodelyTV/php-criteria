<p align="center">
  <a href="https://codely.com">
    <picture>
      <source media="(prefers-color-scheme: dark)" srcset="https://codely.com/logo/codely_logo-dark.svg">
      <source media="(prefers-color-scheme: light)" srcset="https://codely.com/logo/codely_logo-light.svg">
      <img alt="Codely logo" src="https://codely.com/logo/codely_logo.svg">
    </picture>
  </a>
</p>

<h1 align="center">
  🎼 Criteria for PHP
</h1>

<p align="center">
    <a href="https://github.com/CodelyTV"><img src="https://img.shields.io/badge/Codely-OS-green.svg?style=flat-square" alt="codely.com"/></a>
</p>

## 📥 Installation

To install the base criteria dependency, run the following command:
```sh
composer require codelytv/criteria
```

Then, install the preferred criteria transformer. You can transform in two directions:

Create a Criteria from:
- [Laravel Request](./packages/criteria-from-laravel-request)
- [Symfony Request](./packages/criteria-from-symfony-request)
- [URL](./packages/criteria-from-url)

Convert a Criteria to:
- [Doctrine](./packages/criteria-to-doctrine)
- [Elasticsearch](./packages/criteria-to-elasticsearch)
- [Eloquent](./packages/criteria-to-eloquent)

Also, you can use Plug&Play transformer for your preferred framework:
- [Laravel](./packages/criteria-from-laravel-request-to-eloquent)

### ✅ Testing
To facilitate the testing of the criteria, you can use the provided [object mothers](https://www.martinfowler.com/bliki/ObjectMother.html):

```sh
composer require codelytv/criteria-test-mother --dev
```
## ⬇️ Adding dependencies to packages

* Don't add the dependency with the command `composer require`, but modify the `composer.json` file directly.
* Don't touch the root `composer.json` file, but the `packages/*/composer.json` one.
* After adding a new dependency, execute `vendor/bin/monorepo-builder merge && composer update` to add the changes to the general `composer.json`.

## 🚀 Release packages

This project is using [monorepo-builder](https://github.com/symplify/monorepo-builder) to manage the monorepo.

To release a new version you should execute:
* `patch` version release: make release-patch
* `minor` version release: make release-minor
* `major` version release: make release-major
