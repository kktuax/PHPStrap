<?php


namespace JasonKaz\FormBuild;


class StaticText extends FormElement
{
    public function __construct($Text, $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(array('class' => 'form-control-static'));

        $this->Code = '<p' . $this->parseAttribs($this->Attribs) . '>' . $Text . '</p>';
    }
}
