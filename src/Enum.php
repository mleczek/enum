<?php

namespace Mleczek\Enum;

use Mleczek\Enum\Exceptions\InvalidEnumValueException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

abstract class Enum
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string|null
     */
    private ?string $displayName;

    /**
     * @var array
     */
    private static array $map = [];

    /**
     * Enum constructor.
     *
     * @param mixed $value Enum value.
     * @param string|null $displayName Display name.
     */
    private function __construct($value, ?string $displayName = null)
    {
        $this->value = $value;
        $this->displayName = $displayName;
    }

    /**
     * Initialize enum value.
     *
     * @param mixed $value Enum value.
     * @param string|null $displayName Display name.
     * @return self
     */
    protected static function make($value, ?string $displayName = null): self
    {
        $ns = get_called_class();
        if (!isset(self::$map[$ns])) {
            self::$map[$ns] = [];
        }

        if (!isset(self::$map[$ns][$value])) {
            self::$map[$ns][$value] = new $ns($value, $displayName);
        }

        return self::$map[$ns][$value];
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    public function __toString()
    {
        return (string)$this->getValue();
    }

    /**
     * @return self[]
     */
    public static function all(): array
    {
        try {
            $enumClass = new ReflectionClass(get_called_class());
            $enumMethods = $enumClass->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC);

            $valueMethods = array_filter($enumMethods, function (ReflectionMethod $method) {
                return $method->class === get_called_class();
            });

            $enums = array_map(function (ReflectionMethod $method) {
                $className = get_called_class();
                $methodName = $method->getName();
                return $className::$methodName();
            }, $valueMethods);

            // Sort by value (case-insensitive for strings).
            usort($enums, function (self $a, self $b) {
                if (is_string($a->getValue()) && is_string($b->getValue())) {
                    return strcasecmp($a, $b);
                }

                if ($a->getValue() === $b->getValue()) {
                    return 0;
                }

                return ($a->getValue() < $b->getValue()) ? -1 : 1;
            });

            return $enums;
        } catch (ReflectionException $ex) {
            return [];
        }
    }

    /**
     * @param mixed $value
     * @return self
     * @throws InvalidEnumValueException
     */
    public static function parse($value): self
    {
        $enums = self::all();
        foreach ($enums as $enum) {
            if ($enum->getValue() === $value) {
                return $enum;
            }
        }

        throw new InvalidEnumValueException(get_called_class(), $value);
    }

    /**
     * @param mixed $value
     * @param mixed $default
     * @return self|null
     */
    public static function parseOrDefault($value, ?self $default = null): ?self
    {
        if (empty($value)) {
            return $default;
        }

        try {
            return self::parse($value);
        } catch (InvalidEnumValueException $ex) {
            return $default;
        }
    }
}
