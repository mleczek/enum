# PHP Enum

This package was created to provide simple way to create typed enums in PHP with IDE autocompletion. The package is an alternative for `SplEnum` extension.

## Installation

```
composer require mleczek/enum
```

## Strict type

Properties, parameters and return types... strict type is everywhere.

```php
function printStatus(StatusEnum $status) {
    echo $status->getDisplayName();
}

printStatus(StatusEnum::active()); // Active
printStatus(MyEnum::all()[0]); // PHP Fatal error:  Uncaught TypeError: Argument 1 passed to printStatus() must be an instance of StatusEnum, instance of MyEnum given
```

## Accessing

One enum value or all available values? Not a problem.

```php
StatusEnum::active(); // StatusEnum
StatusEnum::inactive(); // StatusEnum
StatusEnum::all(); // StatusEnum[]
```

The `all()` method returns enums that are sorted by value (case-insensitive for strings).

## Comparing

The same enum instance is always returned, don't worry while using [*identical*](https://www.php.net/manual/en/language.operators.comparison.php) comparision.

```php
StatusEnum::active() === StatusEnum::active(); // true
StatusEnum::active() === StatusEnum::inactive(); // false
```

## Serializing

Serialize...

```php
$value = $enum->getValue();
```

## Deserializing

...and deserialize.

```php
StatusEnum::parse($value); // StatusEnum
StatusEnum::parseOrDefault($value, StatusEnum::inactive()); // StatusEnum
```

**Note:** Implementation accept any type as enum value and use [*identical*](https://www.php.net/manual/en/language.operators.comparison.php) comparision. For complex types (which are not recommended) manually [`serialize`](https://www.php.net/manual/en/function.serialize.php) and [`unserialize`](https://www.php.net/manual/en/function.unserialize.php) values.

## Creating

Make class which extends `Mleczek\Enum\Enum` and define some static methods. That's all.

```php
use Mleczek\Enum\Enum;

final class StatusEnum extends Enum
{
    public static function active(): self
    {
        return self::make('A', 'Active');
    }

    public static function inactive(): self
    {
        return self::make('I', 'Inactive');
    }
}
```
