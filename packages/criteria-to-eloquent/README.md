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
  🎼 Criteria to Eloquent
</h1>

# 🔒 Read-only repository
Any modification must be done in the [main repository](https://github.com/CodelyTV/php-criteria).

## 📥 Installation

```sh
composer require codelytv/criteria-to-eloquent
```

## 💻 Usage

There are two ways to use this package.

Classic way:
```php
$toConverter = new CriteriaToEloquentConverter();
$users = $toConverter->applyCriteria(User::query(), $criteria)->get();
```

Laravel way:
```php
$users = CriteriaToEloquentConverter::convert(User::query(), $criteria)->get();
```
