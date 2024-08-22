<?php
namespace PHPStrap\Form;

class Label extends FormElement
{
    private $Text, $ScreenReaderOnly;

    /**
     * @param string $Text
     * @param array  $Attribs
     * @param bool   $ScreenReaderOnly
     * @param        $FormType
     * @param        $LabelWidth
     */
    public function __construct($Text = '', $Attribs = [], $ScreenReaderOnly = false, $FormType = FormType::Normal, $LabelWidth = 2)
    {
        $this->Attribs          = $Attribs;
        $this->Text             = $Text;
        $this->ScreenReaderOnly = $ScreenReaderOnly;

        if ($FormType === FormType::Horizontal) {
            $this->Attribs = $this->setAttributeDefaults(array('class' => 'control-label col-sm-' . $LabelWidth));
        }

        if ($FormType === FormType::Inline && $ScreenReaderOnly === true) {
            $this->Attribs = $this->setAttributeDefaults(array('class' => 'sr-only'));
        }
    }
    
    /**
     * @return string
     */
    public function __toString(){
    	return '<label ' . $this->parseAttribs($this->Attribs) . '>' . $this->Text . '</label>';
    }
    
}
