<?php

namespace Application\CommandQuery;

abstract class ListQuery
{
    protected $criteria = [];
    protected $page = 1;

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function getPage()
    {
        return $this->page;
    }
}
