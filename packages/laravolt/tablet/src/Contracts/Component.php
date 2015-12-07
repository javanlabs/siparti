<?php
namespace Laravolt\Tablet\Contracts;

use Laravolt\Tablet\Builder;

interface Component
{
    public function boot(Builder $builder);

    public function header();

    public function cell($cell);

}
