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
  🎼 Criteria from Laravel Request
</h1>

# 🔒 Read-only repository
Any modification must be done in the [main repository](https://github.com/CodelyTV/php-criteria).

## 📥 Installation

```sh
composer require codelytv/criteria-from-laravel-request
```

## 💻 Usage

The criteria converter expect an url [with the following format](https://github.com/CodelyTV/php-criteria/tree/main/packages/criteria-from-url).

There are two ways to use this package.

Classic way:
```php
Route::get('users', function (Request $request) {
    $fromConverter = new CriteriaFromLaravelRequestConverter();

    $criteria = $fromConverter->toCriteria($request);
});
```

Laravel way:
```php
Route::get('users', function (Request $request) {
    $criteria = CriteriaFromLaravelRequestConverter::convert($request);
});
```
