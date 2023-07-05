<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use const PHP_EOL;
use function sprintf;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class ComparisonMethodDoesNotAcceptParameterTypeException extends Exception
{
    public function __construct(string $className, string $methodName, string $type)
    {
        parent::__construct(
            sprintf(
                '%s is not an accepted argument type for comparison method %s::%s().',
                $type,
                $className,
<<<<<<< HEAD
                $methodName
            ),
            0,
            null
=======
                $methodName,
            ),
            0,
            null,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );
    }

    public function __toString(): string
    {
        return $this->getMessage() . PHP_EOL;
    }
}
