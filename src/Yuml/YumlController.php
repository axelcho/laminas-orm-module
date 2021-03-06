<?php

namespace DoctrineORMModule\Yuml;

use Laminas\Http\Client;
use Laminas\Http\Request;
use Laminas\Http\Response;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Controller\Plugin\Redirect;
use UnexpectedValueException;

/**
 * Utility to generate Yuml compatible strings from metadata graphs
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @author  Marco Pivetta <ocramius@gmail.com>
 */
class YumlController extends AbstractActionController
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @param Client $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Redirects the user to a YUML graph drawn with the provided `dsl_text`
     *
     * @return Response
     *
     * @throws UnexpectedValueException if the YUML service answered incorrectly
     */
    public function indexAction()
    {
        /* @var $request Request */
        $request = $this->getRequest();
        $this->httpClient->setMethod(Request::METHOD_POST);
        $this->httpClient->setParameterPost(['dsl_text' => $request->getPost('dsl_text')]);
        $response = $this->httpClient->send();

        if (! $response->isSuccess()) {
            throw new UnexpectedValueException('HTTP Request failed');
        }

        /* @var $redirect Redirect */
        $redirect = $this->plugin('redirect');

        return $redirect->toUrl('https://yuml.me/' . $response->getBody());
    }
}
