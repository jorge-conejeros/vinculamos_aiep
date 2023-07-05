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

namespace Psy\TabCompletion\Matcher;

/**
 * A PHP keyword tab completion Matcher.
 *
 * This matcher provides completion for all function-like PHP keywords.
 *
 * @author Marc Garcia <markcial@gmail.com>
 */
class KeywordsMatcher extends AbstractMatcher
{
    protected $keywords = [
        'array', 'clone', 'declare', 'die', 'echo', 'empty', 'eval', 'exit', 'include',
        'include_once', 'isset', 'list', 'print',  'require', 'require_once', 'unset',
    ];

    protected $mandatoryStartKeywords = [
        'die', 'echo', 'print', 'unset',
    ];

    /**
     * Get all (completable) PHP keywords.
     *
<<<<<<< HEAD
     * @return array
=======
     * @return string[]
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Check whether $keyword is a (completable) PHP keyword.
     *
     * @param string $keyword
<<<<<<< HEAD
     *
     * @return bool
=======
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    public function isKeyword(string $keyword): bool
    {
        return \in_array($keyword, $this->keywords);
    }

    /**
     * {@inheritdoc}
     */
    public function getMatches(array $tokens, array $info = []): array
    {
        $input = $this->getInput($tokens);

        return \array_filter($this->keywords, function ($keyword) use ($input) {
            return AbstractMatcher::startsWith($input, $keyword);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function hasMatched(array $tokens): bool
    {
        $token = \array_pop($tokens);
        $prevToken = \array_pop($tokens);

        switch (true) {
            case self::hasToken([self::T_OPEN_TAG, self::T_VARIABLE], $token):
//            case is_string($token) && $token === '$':
            case self::hasToken([self::T_OPEN_TAG, self::T_VARIABLE], $prevToken) &&
<<<<<<< HEAD
                self::tokenIs($token, self::T_STRING):
=======
            self::tokenIs($token, self::T_STRING):
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            case self::isOperator($token):
                return true;
        }

        return false;
    }
}
