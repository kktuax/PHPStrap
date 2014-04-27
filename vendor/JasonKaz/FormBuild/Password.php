<?php
namespace JasonKaz\FormBuild;

class Password extends GeneralInput implements Validable
{
    public function __construct($Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        parent::__construct('password', $this->Attribs);
    }
}
