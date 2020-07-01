<?php

namespace Mleczek\Enum\Exceptions;

use Exception;
use Mleczek\Enum\Enum;

class InvalidEnumValueException extends Exception
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string
     */
    private $enumClass;

    /**
     * InvalidEnumValueException constructor.
     *
     * @param string $enumClass
     * @param mixed $value
     */
    public function __construct(string $enumClass, $value)
    {
        $this->value = $value;
        $this->enumClass = $enumClass;

        $enumValues = array_map(
            fn(Enum $enum) => $enum->getValue(),
            $enumClass::all()
        );

        $availableStr = implode(', ', $enumValues);
        parent::__construct("Cannot parse the '$value' value to the '$enumClass' enum, expected one of: $availableStr.", 2, null);
    }
}
