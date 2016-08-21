<?php

namespace Stratedge\Regulator\Regulators;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Stratedge\Regulator\Regulation;
use Stratedge\Regulator\Parsers\Parser;
use Stratedge\Regulator\Filters\Filter;

abstract class Regulator
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $parsers = [];

    /**
     * @var mixed
     */
    protected $source;

    /**
     * @var array
     */
    protected $filters = [];


    /**
     * @var integer
     */
    protected $status = 200;


    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->registerParsers();
    }


    /**
     * Core method that completes the regulation of the output. Returns a
     * Regulation object after processing
     *
     * @return Regulation
     */
    abstract public function regulate();


    /**
     * Core method that sets the list of Parsers on the $parser property that
     * the Regulator will use to regulate the output
     *
     * @return null
     */
    abstract public function registerParsers();


    /**
     * Convenience wrapper for both getRequest and setRequest. Without input
     * willreturn the $request property, otherwise will set the $request
     * property and return self
     *
     * @param  Request|null $request
     * @return Request|null|self
     */
    public function request(Request $request = null)
    {
        if (is_null($request)) {
            return $this->getRequest();
        } else {
            return $this->setRequest($request);
        }
    }


    /**
     * Returns the value of the $request property
     *
     * @return Request|null
     */
    public function getRequest()
    {
        return $this->request;
    }


    /**
     * Sets the value of the $request property. Returns self
     *
     * @param  Request $request
     * @return self
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }


    /**
     * Convenience wrapper for both getParsers and setParsers. Without input
     * will return the $parsers property, otherwise will set the $parsers
     * property and return self. Input can be a single Parser, a listing of
     * Parsers, or a single array of Parsers
     *
     * @param  Parser|array|null $parser
     * @return array|self
     */
    public function parsers($parser = null)
    {
        if (is_null($parser)) {
            return $this->getParsers();
        } else if (!is_array($parser)) {
            return $this->setParsers(func_get_args());
        } else {
            return $this->setParsers($parser);
        }
    }


    public function addParser($parser)
    {
        if (!is_array($parser)) {
            $parser = func_get_args();
        }

        foreach ($parser as $obj) {
            if (is_string($obj)) {
                $obj = app($obj);
            }

            if ($obj instanceof Parser == false) {
                throw new InvalidArgumentException();
            }

            $this->parsers[] = $obj;
        }

        return $this;
    }


    public function getParsers()
    {
        return $this->parsers;
    }


    public function setParsers($parser)
    {
        if (!is_array($parser)) {
            $parser = func_get_args();
        }

        foreach ($parser as &$obj) {
            if (is_string($obj)) {
                $obj = app($obj);
            }

            if ($obj instanceof Parser == false) {
                throw new InvalidArgumentException();
            }
        }

        $this->parsers = $parser;

        return $this;
    }


    public function source($source = null)
    {
        if (is_null($source)) {
            return $this->getSource();
        } else {
            return $this->setSource($source);
        }
    }


    public function getSource()
    {
        return $this->source;
    }


    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }


    public function filters($filters = null)
    {
        if (is_null($filters)) {
            return $this->getFilters();
        } else {
            return call_user_func_array([$this, "setFilters"], func_get_args());
        }
    }


    public function addFilters($filters)
    {
        if (!is_array($filters)) {
            $filters = func_get_args();
        }

        foreach ($filters as $filter) {
            if ($filter instanceof Filter == false) {
                throw new InvalidArgumentException();
            }
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

        foreach ($filters as $filter) {
            if ($filter instanceof Filter == false) {
                throw new InvalidArgumentException();
            }
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


    public function filter(Regulation $regulation)
    {
        foreach ($this->filters as $filter) {
            $regulation = $filter->filter($regulation);
        }

        return $regulation;
    }


    public function parse(Regulation $regulation)
    {
        foreach ($this->parsers as $parser) {
            $regulation = $parser->parse($regulation);
        }

        return $regulation;
    }


    public function makeRegulation()
    {
        return app(Regulation::class, [
            $this->request(),
            $this->source(),
            $this->filters(),
            $this->status()
        ]);
    }


    public function __toString()
    {
        return "";
    }
}
