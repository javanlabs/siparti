<?php
namespace Laravolt\Tablet\Components;

use Laravolt\Tablet\Contracts\Component;

class Checkall implements Component
{
    public function header()
    {
        return render('tablet::checkall.header');
    }

    public function cell($data)
    {
        return render('tablet::checkall.cell', compact('data'));
    }

}
