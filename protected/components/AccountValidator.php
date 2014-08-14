<?php

class AccountValidator extends CValidator
{
    public $lengths = array();

    /**
     * Validates a single attribute.
     * This method should be overridden by child classes.
     * @param CModel $object the data object being validated
     * @param string $attribute the name of the attribute to be validated.
     * @throws CHttpException
     */
    protected function validateAttribute($object, $attribute)
    {
        if ( is_string($this->lengths) ) {
            $this->lengths = explode(',', str_replace(" ", "", $this->lengths));
        } else if ( is_numeric($this->lengths) ) {
            $this->lengths = array($this->lengths);
        }

        if ( empty($this->lengths) )
            throw new CHttpException(500, 'Для валидатора AccountValidator не задан атрибут lengths');

        $attributeLabel = $object->getAttributeLabel($attribute);
        $value = str_replace(" ", "", $object->$attribute);
        if ( !empty($value) && !is_numeric($value) ) {
            $object->addError($attribute, "Неверный формат {$attributeLabel}");
            return;
        }

        $length = strlen($value);

        if ( $length > 0 && !in_array($length, $this->lengths) ) {
            $errorMessage = "Вы ввели ". Sitehelper::pluralize($length, array('символ', 'символа', 'символов')) .", а необходимо ";
            $count = count($this->lengths);
            if ( $count === 1 ) {
                $errorMessage .= $this->lengths[0];
            } else if ( $count === 2 ) {
                $errorMessage .= $this->lengths[0]." или ".$this->lengths[1];
            } else {
                $parts = implode(', ', array_slice($this->lengths, 0, $count - 1));
                $errorMessage .= $parts.' или '.$this->lengths[$count - 1];
            }
            $object->addError($attribute, $errorMessage);
        }
    }
}