<?php

/**
 * This file is part of the ramsey/collection library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Ben Ramsey <ben@benramsey.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

declare(strict_types=1);

namespace Ramsey\Collection\Exception;

<<<<<<< HEAD
/**
 * Thrown when attempting to extract a value for a method or property that does not exist.
 */
class ValueExtractionException extends \RuntimeException
=======
use RuntimeException;

/**
 * Thrown when attempting to extract a value for a method or property that does not exist.
 */
class ValueExtractionException extends RuntimeException
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
{
}
