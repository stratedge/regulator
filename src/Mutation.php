<?php

namespace Stratedge\Regulator;

use Illuminate\Http\Request;

class Mutation
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $node;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @var integer
     */
    protected $status = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var mixed
     */
    protected $body;


    public function __construct(Request $request, $node, $filters = [], $status = 200)
    {
        $this->request($request);
        $this->node($node);
        $this->filters($filters);
        $this->status($status);
    }


    public function request(Request $request = null)
    {
        if (is_null($request)) {
            return $this->getRequest();
        } else {
            return $this->setRequest($request);
        }
    }


    public function getRequest()
    {
        return $this->request;
    }


    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }


    public function node($node = null)
    {
        if (is_null($node)) {
            return $this->getNode();
        } else {
            return $this->setNode($node);
        }
    }


    public function getNode()
    {
        return $this->node;
    }


    public function setNode($node)
    {
        $this->node = $node;
        return $this;
    }


    public function filters($filters = null)
    {
        if (is_null($filters)) {
            return $this->getFilters();
        } else {
            return $this->setFilters($filters);
        }
    }


    public function addFilters($filters)
    {
        if (!is_array($filters)) {
            $filters = func_get_args();
        }

        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }


    public function getFilters()
    {
        return $this->filters;
    }


    public function setFilters($filters)
    {
        if (!is_array($filters)) {
            $filters = func_get_args();
        }

        $this->filters = $filters;

        return $this;
    }


    public function status($status = null)
    {
        if (is_null($status)) {
            return $this->getStatus();
        } else {
            return $this->setStatus($status);
        }
    }


    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }


    public function headers($key = null, $value = null)
    {
        if (is_null($key)) {
            return $this->getHeaders();
        } else {
            return $this->setHeaders($key, $value);
        }
    }


    public function addHeaders($key, $value = null)
    {
        if (!is_array($key)) {
            $key = [$key => $value];
        }

        $this->headers = array_merge($this->headers, $key);

        return $this;
    }


    public function getHeaders()
    {
        return $this->headers;
    }


    public function setHeaders($key, $value = null)
    {
        if (!is_array($key)) {
            $key = [$key => $value];
        }

        $this->headers = $key;

        return $this;
    }


    public function body($body = null)
    {
        if (is_null($body)) {
            return $this->getBody();
        } else {
            return $this->setBody($body);
        }
    }


    public function getBody()
    {
        return $this->body;
    }


    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
}
