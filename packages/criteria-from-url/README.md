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
  🎼 Criteria from URL
</h1>

# 🔒 Read-only repository
Any modification must be done in the [main repository](https://github.com/CodelyTV/php-criteria).

## 📥 Installation

```sh
composer require codelytv/criteria-from-url
```

## 💻 Usage

```php
$url = 'http://localhost:3000/api/users?filters[0][field]=name&filters[0][operator]=CONTAINS&filters[0][value]=Javi';

$converter = new CriteriaFromUrlConverter();

$criteria = $converter->toCriteria($url);
```
