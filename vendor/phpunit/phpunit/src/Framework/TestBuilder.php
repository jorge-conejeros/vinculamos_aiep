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

use function assert;
use function count;
use function get_class;
use function sprintf;
use function trim;
use PHPUnit\Util\Filter;
use PHPUnit\Util\InvalidDataSetException;
use PHPUnit\Util\Test as TestUtil;
use ReflectionClass;
use Throwable;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class TestBuilder
{
    public function build(ReflectionClass $theClass, string $methodName): Test
    {
        $className = $theClass->getName();

        if (!$theClass->isInstantiable()) {
            return new ErrorTestCase(
<<<<<<< HEAD
                sprintf('Cannot instantiate class "%s".', $className)
=======
                sprintf('Cannot instantiate class "%s".', $className),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            );
        }

        $backupSettings = TestUtil::getBackupSettings(
            $className,
<<<<<<< HEAD
            $methodName
=======
            $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );

        $preserveGlobalState = TestUtil::getPreserveGlobalStateSettings(
            $className,
<<<<<<< HEAD
            $methodName
=======
            $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );

        $runTestInSeparateProcess = TestUtil::getProcessIsolationSettings(
            $className,
<<<<<<< HEAD
            $methodName
=======
            $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );

        $runClassInSeparateProcess = TestUtil::getClassProcessIsolationSettings(
            $className,
<<<<<<< HEAD
            $methodName
=======
            $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );

        $constructor = $theClass->getConstructor();

        if ($constructor === null) {
            throw new Exception('No valid test provided.');
        }

        $parameters = $constructor->getParameters();

        // TestCase() or TestCase($name)
        if (count($parameters) < 2) {
            $test = $this->buildTestWithoutData($className);
        } // TestCase($name, $data)
        else {
            try {
                $data = TestUtil::getProvidedData(
                    $className,
<<<<<<< HEAD
                    $methodName
=======
                    $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );
            } catch (IncompleteTestError $e) {
                $message = sprintf(
                    "Test for %s::%s marked incomplete by data provider\n%s",
                    $className,
                    $methodName,
<<<<<<< HEAD
                    $this->throwableToString($e)
=======
                    $this->throwableToString($e),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );

                $data = new IncompleteTestCase($className, $methodName, $message);
            } catch (SkippedTestError $e) {
                $message = sprintf(
                    "Test for %s::%s skipped by data provider\n%s",
                    $className,
                    $methodName,
<<<<<<< HEAD
                    $this->throwableToString($e)
=======
                    $this->throwableToString($e),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );

                $data = new SkippedTestCase($className, $methodName, $message);
            } catch (Throwable $t) {
                $message = sprintf(
                    "The data provider specified for %s::%s is invalid.\n%s",
                    $className,
                    $methodName,
<<<<<<< HEAD
                    $this->throwableToString($t)
=======
                    $this->throwableToString($t),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );

                $data = new ErrorTestCase($message);
            }

            // Test method with @dataProvider.
            if (isset($data)) {
                $test = $this->buildDataProviderTestSuite(
                    $methodName,
                    $className,
                    $data,
                    $runTestInSeparateProcess,
                    $preserveGlobalState,
                    $runClassInSeparateProcess,
<<<<<<< HEAD
                    $backupSettings
=======
                    $backupSettings,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );
            } else {
                $test = $this->buildTestWithoutData($className);
            }
        }

        if ($test instanceof TestCase) {
            $test->setName($methodName);
            $this->configureTestCase(
                $test,
                $runTestInSeparateProcess,
                $preserveGlobalState,
                $runClassInSeparateProcess,
<<<<<<< HEAD
                $backupSettings
=======
                $backupSettings,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            );
        }

        return $test;
    }

    /** @psalm-param class-string $className */
    private function buildTestWithoutData(string $className)
    {
        return new $className;
    }

    /** @psalm-param class-string $className */
    private function buildDataProviderTestSuite(
        string $methodName,
        string $className,
        $data,
        bool $runTestInSeparateProcess,
        ?bool $preserveGlobalState,
        bool $runClassInSeparateProcess,
        array $backupSettings
    ): DataProviderTestSuite {
        $dataProviderTestSuite = new DataProviderTestSuite(
<<<<<<< HEAD
            $className . '::' . $methodName
=======
            $className . '::' . $methodName,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );

        $groups = TestUtil::getGroups($className, $methodName);

        if ($data instanceof ErrorTestCase ||
            $data instanceof SkippedTestCase ||
            $data instanceof IncompleteTestCase) {
            $dataProviderTestSuite->addTest($data, $groups);
        } else {
            foreach ($data as $_dataName => $_data) {
                $_test = new $className($methodName, $_data, $_dataName);

                assert($_test instanceof TestCase);

                $this->configureTestCase(
                    $_test,
                    $runTestInSeparateProcess,
                    $preserveGlobalState,
                    $runClassInSeparateProcess,
<<<<<<< HEAD
                    $backupSettings
=======
                    $backupSettings,
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
                );

                $dataProviderTestSuite->addTest($_test, $groups);
            }
        }

        return $dataProviderTestSuite;
    }

    private function configureTestCase(
        TestCase $test,
        bool $runTestInSeparateProcess,
        ?bool $preserveGlobalState,
        bool $runClassInSeparateProcess,
        array $backupSettings
    ): void {
        if ($runTestInSeparateProcess) {
            $test->setRunTestInSeparateProcess(true);

            if ($preserveGlobalState !== null) {
                $test->setPreserveGlobalState($preserveGlobalState);
            }
        }

        if ($runClassInSeparateProcess) {
            $test->setRunClassInSeparateProcess(true);

            if ($preserveGlobalState !== null) {
                $test->setPreserveGlobalState($preserveGlobalState);
            }
        }

        if ($backupSettings['backupGlobals'] !== null) {
            $test->setBackupGlobals($backupSettings['backupGlobals']);
        }

        if ($backupSettings['backupStaticAttributes'] !== null) {
            $test->setBackupStaticAttributes(
<<<<<<< HEAD
                $backupSettings['backupStaticAttributes']
=======
                $backupSettings['backupStaticAttributes'],
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            );
        }
    }

    private function throwableToString(Throwable $t): string
    {
        $message = $t->getMessage();

        if (empty(trim($message))) {
            $message = '<no message>';
        }

        if ($t instanceof InvalidDataSetException) {
            return sprintf(
                "%s\n%s",
                $message,
<<<<<<< HEAD
                Filter::getFilteredStacktrace($t)
=======
                Filter::getFilteredStacktrace($t),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
            );
        }

        return sprintf(
            "%s: %s\n%s",
            get_class($t),
            $message,
<<<<<<< HEAD
            Filter::getFilteredStacktrace($t)
=======
            Filter::getFilteredStacktrace($t),
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
        );
    }
}
