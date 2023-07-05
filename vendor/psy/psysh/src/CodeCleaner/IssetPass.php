<?php

/*
 * This file is part of Psy Shell.
 *
<<<<<<< HEAD
 * (c) 2012-2022 Justin Hileman
=======
 * (c) 2012-2023 Justin Hileman
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Psy\CodeCleaner;

use PhpParser\Node;
use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Expr\NullsafePropertyFetch;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use Psy\Exception\FatalErrorException;

/**
 * Code cleaner pass to ensure we only allow variables, array fetch and property
 * fetch expressions in isset() calls.
 */
class IssetPass extends CodeCleanerPass
{
    const EXCEPTION_MSG = 'Cannot use isset() on the result of an expression (you can use "null !== expression" instead)';

    /**
     * @throws FatalErrorException
     *
     * @param Node $node
<<<<<<< HEAD
=======
     *
     * @return int|Node|null Replacement node (or special return value)
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Isset_) {
            return;
        }

        foreach ($node->vars as $var) {
            if (!$var instanceof Variable && !$var instanceof ArrayDimFetch && !$var instanceof PropertyFetch && !$var instanceof NullsafePropertyFetch) {
                throw new FatalErrorException(self::EXCEPTION_MSG, 0, \E_ERROR, null, $node->getLine());
            }
        }
    }
}
