<?php

namespace Stratedge\Regulator\Filters;

use Stratedge\Regulator\Filters\Filter;
use Stratedge\Regulator\Mutation;

class Text extends Filter
{
    /**
     * @var string
     */
    protected $field;

    /**
     * @var string
     */
    protected $comparator = "=";


    public function filter(Mutation $mutation)
    {
        if ($mutation->request()->has($this->field())) {
            $mutation->node(
                $mutation->node()->where(
                    $this->field(),
                    $this->comparator(),
                    $mutation->request()->{$this->field}
                )
            );
        }

        return $mutation;
    }

    public function field($field = null)
    {
        if (is_null($field)) {
            return $this->getField();
        } else {
            return $this->setField($field);
        }
    }


    public function getField()
    {
        return $this->field;
    }


    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }


    public function comparator($comparator = null)
    {
        if (is_null($comparator)) {
            return $this->getComparator();
        } else {
            return $this->setComparator($comparator);
        }
    }


    public function getComparator()
    {
        return $this->comparator;
    }


    public function setComparator($comparator)
    {
        $this->comparator = $comparator;
        return $this;
    }


    public function like()
    {
        return $this->comparator("LIKE");
    }
}
