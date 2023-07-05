<?php

declare(strict_types=1);

/*
 * This file is part of the league/commonmark package.
 *
 * (c) Colin O'Dell <colinodell@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\CommonMark;

<<<<<<< HEAD
use League\CommonMark\Output\RenderedContentInterface;
=======
use League\CommonMark\Exception\CommonMarkException;
use League\CommonMark\Output\RenderedContentInterface;
use League\Config\Exception\ConfigurationExceptionInterface;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c

/**
 * Interface for a service which converts content from one format (like Markdown) to another (like HTML).
 */
interface ConverterInterface
{
    /**
<<<<<<< HEAD
     * @throws \RuntimeException
=======
     * @throws CommonMarkException
     * @throws ConfigurationExceptionInterface
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    public function convert(string $input): RenderedContentInterface;
}
