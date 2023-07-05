<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Runner\Filter;

use function end;
use function implode;
use function preg_match;
use function sprintf;
use function str_replace;
use Exception;
use PHPUnit\Framework\ErrorTestCase;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\WarningTestCase;
use PHPUnit\Util\RegularExpression;
use RecursiveFilterIterator;
use RecursiveIterator;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class NameFilterIterator extends RecursiveFilterIterator
{
    /**
     * @var string
     */
    private $filter;

    /**
     * @var int
     */
    private $filterMin;

    /**
     * @var int
     */
    private $filterMax;

    /**
     * @throws Exception
     */
    public function __construct(RecursiveIterator $iterator, string $filter)
    {
        parent::__construct($iterator);

        $this->setFilter($filter);
    }

    /**
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public function accept(): bool
    {
        $test = $this->getInnerIterator()->current();

        if ($test instanceof TestSuite) {
            return true;
        }

        $tmp = \PHPUnit\Util\Test::describe($test);

        if ($test instanceof ErrorTestCase || $test instanceof WarningTestCase) {
            $name = $test->getMessage();
        } elseif ($tmp[0] !== '') {
            $name = implode('::', $tmp);
        } else {
            $name = $tmp[1];
        }

        $accepted = @preg_match($this->filter, $name, $matches);

        if ($accepted && isset($this->filterMax)) {
            $set      = end($matches);
            $accepted = $set >= $this->filterMin && $set <= $this->filterMax;
        }

        return (bool) $accepted;
    }

    /**
     * @throws Exception
     */
    private function setFilter(string $filter): void
    {
        if (RegularExpression::safeMatch($filter, '') === false) {
            // Handles:
            //  * testAssertEqualsSucceeds#4
            //  * testAssertEqualsSucceeds#4-8
            if (preg_match('/^(.*?)#(\d+)(?:-(\d+))?$/', $filter, $matches)) {
                if (isset($matches[3]) && $matches[2] < $matches[3]) {
                    $filter = sprintf(
                        '%s.*with data set #(\d+)$',
<<<<<<< HEAD
                        $matches[1]
=======
                        $matches[1],
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                    );

                    $this->filterMin = (int) $matches[2];
                    $this->filterMax = (int) $matches[3];
                } else {
                    $filter = sprintf(
                        '%s.*with data set #%s$',
                        $matches[1],
<<<<<<< HEAD
                        $matches[2]
=======
                        $matches[2],
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                    );
                }
            } // Handles:
            //  * testDetermineJsonError@JSON_ERROR_NONE
            //  * testDetermineJsonError@JSON.*
            elseif (preg_match('/^(.*?)@(.+)$/', $filter, $matches)) {
                $filter = sprintf(
                    '%s.*with data set "%s"$',
                    $matches[1],
<<<<<<< HEAD
                    $matches[2]
=======
                    $matches[2],
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );
            }

            // Escape delimiters in regular expression. Do NOT use preg_quote,
            // to keep magic characters.
            $filter = sprintf(
                '/%s/i',
                str_replace(
                    '/',
                    '\\/',
<<<<<<< HEAD
                    $filter
                )
=======
                    $filter,
                ),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            );
        }

        $this->filter = $filter;
    }
}
