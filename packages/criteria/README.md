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

# 🔒 Read-only repository
Any modification must be done in the [main repository](https://github.com/CodelyTV/php-criteria).

## 📥 Installation

```sh
composer require codelytv/criteria
```

## 💻 Usage

### Valid operators
* `=`: Equal
* `!=`: Not equal
* `>`: Greater than
* `<`: Less than
* `CONTAINS`: Contains. It will translate to `like` in SQL.
* `NOT_CONTAINS`: Not contains. It will translate to `not like` in SQL.

```php
$criteria = Criteria::fromPrimitives(
    [
        ['field' => 'email', 'operator' => 'CONTAINS', 'value' => 'javi'],
    ],
    'name',
    'asc',
    100,
    3
)
```
