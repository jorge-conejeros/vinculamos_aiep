<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject;

use function call_user_func_array;
use function func_get_args;
use PHPUnit\Framework\MockObject\Rule\AnyInvokedCount;

/**
 * @internal This trait is not covered by the backward compatibility promise for PHPUnit
 */
trait Method
{
    public function method()
    {
        $expects = $this->expects(new AnyInvokedCount);

        return call_user_func_array(
            [$expects, 'method'],
<<<<<<< HEAD
            func_get_args()
=======
            func_get_args(),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );
    }
}
