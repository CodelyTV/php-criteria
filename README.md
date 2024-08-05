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
composer install codelytv/criteria
```

Then, install the preferred criteria transformer:
- [Elasticsearch](./packages/criteria-to-elasticsearch)
- [Doctrine](./packages/criteria-to-doctrine)

You can also create your custom transformer.

## 💻 Usage

## ⬇️ Installing dependencies

After adding a new dependency, execute `vendor/bin/monorepo-builder merge && composer update` to add the changes to the general `composer.json`.

## 🚀 Release

This project is using [monorepo-builder](https://github.com/symplify/monorepo-builder) to manage the monorepo.

To release a new version you should execute:
    
```sh
vendor/bin/monorepo-builder bump-interdependency "$VERSION$"
```
Where `$VERSION$` is the new version you want to release. `^4.0` for example.

## ✅ Testing
To facilitate testing of the criteria, you can use the provided [object mothers](https://www.martinfowler.com/bliki/ObjectMother.html):

```sh
composer install codelytv/criteria-test-mother --dev
```
