<?php
namespace Laravolt\SemanticForm;

use AdamWathan\Form\ErrorStore\ErrorStoreInterface;
use AdamWathan\Form\OldInput\OldInputInterface;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use AdamWathan\Form\FormBuilder;
use Laravolt\SemanticForm\Elements\GroupWrapper;
use Laravolt\SemanticForm\Elements\InputGroup;
use Laravolt\SemanticForm\Elements\FormGroup;

class SemanticForm
{

    protected $builder;

    public function __construct(FormBuilder $builder, ErrorStoreInterface $errorBag, OldInputInterface $oldInput)
    {
        $this->builder = $builder;
        $this->builder->setErrorStore($errorBag);
        $this->builder->setOldInputProvider($oldInput);
    }

    public function open()
    {
        return $this->builder->open()->addClass('ui form');
    }

    public function text($name, $label = null, $value = null)
    {
        $control = $this->builder->text($name)->value($value);

        return $this->formGroup($label, $name, $control);
    }

    public function password($name, $label = null)
    {
        $control = $this->builder->password($name);

        return $this->formGroup($label, $name, $control);
    }

    public function button($value, $name = null, $type = "")
    {
        return $this->builder->button($value, $name)->addClass('ui button')->addClass($type);
    }

    public function submit($value = "Submit", $type = "")
    {
        return $this->builder->submit($value)->addClass('ui button')->addClass($type);
    }

    public function select($name, $label = null, $options = array())
    {
        $control = $this->builder->select($name, $options);

        return $this->formGroup($label, $name, $control);
    }

    public function checkbox($name, $label = null)
    {
        $control = $this->builder->checkbox($name);
        $label = $this->getLabelTitle($label, $name);

        return $this->checkGroup($name, $label, $control);
    }

    public function inlineCheckbox($name, $label = null)
    {
        return $this->checkbox($name, $label)->inline();
    }

    protected function checkGroup($name, $label, $control)
    {
        $checkGroup = $this->buildCheckGroup($name, $label, $control);

        return $this->wrap($checkGroup->addClass('checkbox'));
    }

    protected function buildCheckGroup($name, $label, $control)
    {
        $label = $this->builder->label($label, $name)->after($control)->addClass('control-label');

        $checkGroup = new CheckGroup($label);

        if ($this->builder->hasError($name)) {
            $checkGroup->helpBlock($this->builder->getError($name));
            $checkGroup->addClass('has-error');
        }

        return $checkGroup;
    }

    public function radio($name, $label = null, $value = null)
    {
        if (is_null($value)) {
            $value = $label;
        }

        $control = $this->builder->radio($name, $value);
        $label = $this->getLabelTitle($label, $name);

        return $this->radioGroup($name, $label, $control);
    }

    public function inlineRadio($label, $name, $value = null)
    {
        return $this->radio($label, $name, $value)->inline();
    }

    protected function radioGroup($label, $name, $control)
    {
        $checkGroup = $this->buildCheckGroup($label, $name, $control);

        return $this->wrap($checkGroup->addClass('radio'));
    }

    public function textarea($name, $label = null)
    {
        $control = $this->builder->textarea($name);
        $label = $this->getLabelTitle($label, $name);

        return $this->formGroup($label, $name, $control);
    }

    public function date($name, $label = null, $value = null)
    {
        $control = $this->builder->date($name)->value($value);
        $label = $this->getLabelTitle($label, $name);

        return $this->formGroup($label, $name, $control);
    }

    public function email($name, $label = null, $value = null)
    {
        $control = $this->builder->email($name)->value($value);
        $label = $this->getLabelTitle($label, $name);

        return $this->formGroup($label, $name, $control);
    }

    //public function file($label, $name, $value = null)
    //{
    //    $control = $this->builder->file($name)->value($value);
    //    $label = $this->builder->label($label, $name)->addClass('control-label')->forId($name);
    //    $control->id($name);
    //
    //    $formGroup = new FormGroup($label, $control);
    //
    //    if ($this->builder->hasError($name)) {
    //        $formGroup->helpBlock($this->builder->getError($name));
    //        $formGroup->addClass('has-error');
    //    }
    //
    //    return $this->wrap($formGroup);
    //}

    public function inputGroup($name, $label = null, $value = null)
    {
        $control = new InputGroup($name);
        if (!is_null($value) || !is_null($value = $this->getValueFor($name))) {
            $control->value($value);
        }

        return $this->formGroup($label, $name, $control);
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this->builder, $method), $parameters);
    }

    protected function formGroup($label, $name, $control)
    {
        $title = $this->getLabelTitle($label, $name);
        $label = $this->builder->label($title, $name)->forId($name);
        $control->id($name);

        $formGroup = new FormGroup($label, $control);

        if ($this->builder->hasError($name)) {
            $formGroup->helpBlock($this->builder->getError($name));
            $formGroup->addClass('has-error');
        }

        return $this->wrap($formGroup);
    }

    protected function wrap($group)
    {
        return new GroupWrapper($group);
    }

    protected function getLabelTitle($label, $name)
    {
        if (is_null($label) && Lang::has("forms.{$name}")) {
            return Lang::get("forms.{$name}");
        }

        return $label ?: Str::title($name);
    }
}
