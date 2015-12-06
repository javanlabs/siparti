<?php
namespace Laravolt\Tablet;

use Laravolt\Tablet\Contracts\Component;

class Builder
{

    protected $collection = null;

    protected $headers = [];

    protected $fields = [];

    protected $title = null;

    protected $toolbars = [];

    /**
     * Builder constructor.
     */
    public function __construct()
    {
    }

    public function source($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    public function columns(array $columns)
    {
        foreach ($columns as $column) {
            $this->headers[] = $this->getHeader($column);
            $this->fields[] = $column;
        }

        return $this;
    }

    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    public function addToolbar($html)
    {
        $this->toolbars[] = $html;

        return $this;
    }

    public function render()
    {
        $data = [
            'collection' => $this->collection,
            'headers'    => $this->headers,
            'fields'     => $this->fields,
            'title'      => $this->title,
            'toolbars'   => $this->toolbars,
            'builder'   => $this
        ];

        return view('tablet::table', $data)->render();
    }

    public function renderCell($field, $data)
    {
        if(array_has($field, 'field')) {
            return $data[$field['field']];
        }

        if(array_has($field, 'present')) {
            return $data->present($field['present']);
        }

        if(array_has($field, 'view')) {
            return render($field['view'], compact('data'));
        }

        if($field instanceof Component) {
            return $field->cell($data);
        }

        return false;
    }

    protected function getHeader($column)
    {
        if(is_array($column)) {
            return array_get($column, 'header', '');
        }

        if ($column instanceof Component) {
            return $column->header();
        }
    }
}
