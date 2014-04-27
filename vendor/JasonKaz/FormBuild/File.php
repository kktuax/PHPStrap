<?php
namespace JasonKaz\FormBuild;

class File extends GeneralInput
{
    public function __construct($Attribs = array())
    {
        $this->Attribs = $Attribs;

        parent::__construct('file', $this->Attribs);
    }
}
