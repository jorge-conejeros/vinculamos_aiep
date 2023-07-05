<?php
/**
 * Whoops - php errors for cool kids
 * @author Filipe Dobreira <http://github.com/filp>
 */

namespace Whoops\Handler;

<<<<<<< HEAD
use Whoops\Exception\Inspector;
=======
use Whoops\Inspector\InspectorInterface;
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
use Whoops\RunInterface;

/**
 * Abstract implementation of a Handler.
 */
abstract class Handler implements HandlerInterface
{
    /*
     Return constants that can be returned from Handler::handle
     to message the handler walker.
     */
    const DONE         = 0x10; // returning this is optional, only exists for
                               // semantic purposes
    /**
     * The Handler has handled the Throwable in some way, and wishes to skip any other Handler.
     * Execution will continue.
     */
    const LAST_HANDLER = 0x20;
    /**
     * The Handler has handled the Throwable in some way, and wishes to quit/stop execution
     */
    const QUIT         = 0x30;

    /**
     * @var RunInterface
     */
    private $run;

    /**
<<<<<<< HEAD
     * @var Inspector $inspector
=======
     * @var InspectorInterface $inspector
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    private $inspector;

    /**
     * @var \Throwable $exception
     */
    private $exception;

    /**
     * @param RunInterface $run
     */
    public function setRun(RunInterface $run)
    {
        $this->run = $run;
    }

    /**
     * @return RunInterface
     */
    protected function getRun()
    {
        return $this->run;
    }

    /**
<<<<<<< HEAD
     * @param Inspector $inspector
     */
    public function setInspector(Inspector $inspector)
=======
     * @param InspectorInterface $inspector
     */
    public function setInspector(InspectorInterface $inspector)
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
    {
        $this->inspector = $inspector;
    }

    /**
<<<<<<< HEAD
     * @return Inspector
=======
     * @return InspectorInterface
>>>>>>> f70250d9eaeafb7a42f9b666563f4cef7991e46c
     */
    protected function getInspector()
    {
        return $this->inspector;
    }

    /**
     * @param \Throwable $exception
     */
    public function setException($exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return \Throwable
     */
    protected function getException()
    {
        return $this->exception;
    }
}
