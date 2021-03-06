<?php
namespace FMUP\ErrorHandler\Plugin;

use FMUP\Bootstrap;
use FMUP\Exception;
use FMUP\Request;
use FMUP\Response;
use FMUP\Sapi;

abstract class Abstraction
{
    private $response;
    private $request;
    private $bootstrap;

    /**
     * @var \Exception
     */
    private $exception;

    /**
     * @param Bootstrap $bootstrap
     * @return $this
     */
    public function setBootstrap(Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
        return $this;
    }

    /**
     * @return Bootstrap
     * @throws Exception
     */
    public function getBootstrap()
    {
        if (!$this->bootstrap) {
            throw new Exception('Unable to access bootstrap. Not set');
        }
        return $this->bootstrap;
    }

    /**
     * @param Response $response
     * @return $this
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return Response
     * @throws Exception
     */
    public function getResponse()
    {
        if (!$this->response) {
            throw new Exception('Unable to access response. Not set');
        }
        return $this->response;
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return Request
     * @throws Exception
     */
    public function getRequest()
    {
        if (!$this->request) {
            throw new Exception('Unable to access request. Not set');
        }
        return $this->request;
    }

    public function setException(\Exception $e)
    {
        $this->exception = $e;
        return $this;
    }

    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return $this
     */
    abstract public function handle();

    /**
     * @return bool
     */
    abstract public function canHandle();
}
