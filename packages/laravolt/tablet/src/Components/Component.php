<?php
namespace Laravolt\Tablet\Components;

use Laravolt\Tablet\Builder;
use Laravolt\Tablet\Contracts\Component as ComponentInterface;

abstract class Component implements ComponentInterface
{
    protected $builder;

    public function boot(Builder $builder)
    {
        $this->builder = $builder;
    }
}
