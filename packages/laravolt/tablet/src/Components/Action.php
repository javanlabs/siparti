<?php
namespace Laravolt\Tablet\Components;

use Laravolt\Tablet\Components\Component as BaseComponent;
use Laravolt\Tablet\Contracts\Component as ComponentContract;

class Action extends BaseComponent implements ComponentContract
{
    public function header()
    {
        return 'Aksi';
    }

    public function cell($data)
    {
        $view = $this->builder->getRoute('show', $data->id);
        $edit = $this->builder->getRoute('edit', $data->id);
        $delete = $this->builder->getRoute('destroy', $data->id);

        return render('tablet::buttons.action', compact('view', 'edit', 'delete', $data));
    }
}
