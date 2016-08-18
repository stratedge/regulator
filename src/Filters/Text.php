<?php

namespace Stratedge\Regulator\Filters;

use Stratedge\Regulator\Filters\Filter;
use Stratedge\Regulator\Regulation;

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


    public function filter(Regulation $regulation)
    {
        if ($regulation->request()->has($this->field())) {
            $regulation->source(
                $regulation->source()->where(
                    $this->field(),
                    $this->comparator(),
                    $regulation->request()->{$this->field}
                )
            );
        }

        return $regulation;
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
