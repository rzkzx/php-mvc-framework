<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public const TYPE_EMAIL = 'email';

    public string $type;
    public Model $model;
    public string $name;
    public string $attribute;

    public function __construct(Model $model, string $name, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->name = $name;
        $this->attribute = $attribute;
    }
    
    public function __toString()
    {
        return sprintf('
            <div class="form-group mb-3">
                <label>%s</label>
                <input type="%s" name="%s" value="%s" class="form-control %s"/>
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ', 
            $this->name,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->getFirstError($this->attribute)
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function numberField()
    {
        $this->type = self::TYPE_NUMBER;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }
}

?>