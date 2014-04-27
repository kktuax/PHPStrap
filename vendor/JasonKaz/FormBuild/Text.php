<?php
namespace JasonKaz\FormBuild;

class Text extends GeneralInput
{
    public function __construct($Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        parent::__construct('text', $this->Attribs);
    }
}
