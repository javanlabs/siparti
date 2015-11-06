<?php
namespace Laravolt\SemanticForm;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Contracts\Config\Repository as Config;
use Lang;

class SemanticForm
{

    protected $form;
    protected $html;
    protected $config;

    protected $semanticClasses = [
        'form'  => 'form ui',
        'field' => 'field',
        'text'  => '',
    ];

    /**
     * SemanticForm constructor.
     * @param $form
     * @param $html
     * @param $config
     */
    public function __construct(FormBuilder $form, HtmlBuilder $html, Config $config)
    {
        $this->form = $form;
        $this->html = $html;
        $this->config = $config;
    }

    public function open(array $options = [])
    {
        $options = $this->decorateOptions($options, 'form');

        return $this->form->open($options);
    }

    /**
     * Create a new model based form builder.
     *
     * @param  mixed $model
     * @param  array $options
     *
     * @return string
     */
    public function model($model, array $options = [])
    {
        return $this->form->model($model, $options);
    }

    /**
     * Set the model instance on the form builder.
     *
     * @param  mixed $model
     *
     * @return void
     */
    public function setModel($model)
    {
        $this->form->setModel($model);
    }

    /**
     * Close the current form.
     *
     * @return string
     */
    public function close()
    {
        return $this->form->close();
    }

    /**
     * Create a text input field.
     *
     * @param  string $name
     * @param  string $value
     * @param  array $options
     *
     * @return string
     */
    public function text($name, $label = null, $value = null, $options = [])
    {
        $title = $this->getLabelTitle($label, $name);
        $label = $this->form->label($name, $title);
        $input = $this->form->text($name, $value, $options);

        return $this->wrapInput($input, $label);
    }

    /**
     * Create a Semantic-UI submit button.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    public function submit($value = null, array $options = [])
    {
        $options = array_merge(['class' => 'ui button', 'type' => 'submit'], $options);

        return $this->form->button($value, $options);
    }

    protected function decorateOptions($options, $type)
    {
        $semanticClass = array_get($this->semanticClasses, $type, '');
        $options['class'] = trim($semanticClass . ' ' . array_get($options, 'class', ''));

        return $options;
    }

    /**
     * Get the label title for a form field, first by using the provided one
     * or titleizing the field name.
     *
     * @param  string $label
     * @param  string $name
     * @return string
     */
    protected function getLabelTitle($label, $name)
    {
        if (is_null($label) && Lang::has("forms.{$name}")) {
            return Lang::get("forms.{$name}");
        }

        return $label ?: title_case($name);
    }

    protected function wrapInput($input, $label)
    {
        return '<div class="field">' . $label . $input . '</div>';
    }
}
