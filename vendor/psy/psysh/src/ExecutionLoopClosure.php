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

namespace Psy;

use Psy\Exception\BreakException;
<<<<<<< HEAD
use Psy\Exception\ErrorException;
use Psy\Exception\ThrowUpException;
use Psy\Exception\TypeErrorException;
=======
use Psy\Exception\ThrowUpException;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c

/**
 * The Psy Shell's execution loop scope.
 *
 * @todo Once we're on PHP 5.5, we can switch ExecutionClosure to a generator
 * and get rid of the duplicate closure implementations :)
 */
class ExecutionLoopClosure extends ExecutionClosure
{
    /**
     * @param Shell $__psysh__
     */
    public function __construct(Shell $__psysh__)
    {
        $this->setClosure($__psysh__, function () use ($__psysh__) {
            // Restore execution scope variables
            \extract($__psysh__->getScopeVariables(false));

            while (true) {
                $__psysh__->beforeLoop();

                try {
                    $__psysh__->getInput();

                    try {
                        // Pull in any new execution scope variables
                        if ($__psysh__->getLastExecSuccess()) {
                            \extract($__psysh__->getScopeVariablesDiff(\get_defined_vars()));
                        }

                        // Buffer stdout; we'll need it later
                        \ob_start([$__psysh__, 'writeStdout'], 1);

                        // Convert all errors to exceptions
                        \set_error_handler([$__psysh__, 'handleError']);

                        // Evaluate the current code buffer
                        $_ = eval($__psysh__->onExecute($__psysh__->flushCode() ?: ExecutionClosure::NOOP_INPUT));
                    } catch (\Throwable $_e) {
                        // Clean up on our way out.
                        if (\ob_get_level() > 0) {
                            \ob_end_clean();
                        }

                        throw $_e;
                    } finally {
                        // Won't be needing this anymore
                        \restore_error_handler();
                    }

                    // Flush stdout (write to shell output, plus save to magic variable)
                    \ob_end_flush();

                    // Save execution scope variables for next time
                    $__psysh__->setScopeVariables(\get_defined_vars());

                    $__psysh__->writeReturnValue($_);
                } catch (BreakException $_e) {
                    $__psysh__->writeException($_e);

                    return;
                } catch (ThrowUpException $_e) {
                    $__psysh__->writeException($_e);

                    throw $_e;
<<<<<<< HEAD
                } catch (\TypeError $_e) {
                    $__psysh__->writeException(TypeErrorException::fromTypeError($_e));
                } catch (\Error $_e) {
                    $__psysh__->writeException(ErrorException::fromError($_e));
                } catch (\Exception $_e) {
=======
                } catch (\Throwable $_e) {
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                    $__psysh__->writeException($_e);
                }

                $__psysh__->afterLoop();
            }
        });
    }
}
