<?php
namespace FMUP\Import\Config\Field\Validator;

use FMUP\Import\Config\Field\Validator;

class Integer implements Validator
{
    private $empty;

    public function __construct($empty = false)
    {
        $this->setCanEmpty($empty);
    }

    public function setCanEmpty($empty = false)
    {
        $this->empty = (bool)$empty;
        return $this;
    }

    public function getCanEmpty()
    {
        return (bool)$this->empty;
    }

    public function validate($value)
    {
        if ($this->getCanEmpty() && $value == '') {
            return true;
        }
        if (is_float($value) && ((int)$value === 0)) {
            return false;
        }
        $valueTest = (int) $value;
        return ($valueTest === 0) ? is_numeric($value) : ($valueTest == $value);
    }

    public function getErrorMessage()
    {
        return "Le champ reçu n'est pas un nombre entier";
    }
}
