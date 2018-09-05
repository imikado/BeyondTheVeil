<?php
class Action
{
    protected $sType=null;
    protected $sParam=null;

    public function __construct($sType_, $sParam_)
    {
        $this->sType=$sType_;
        $this->sParam=$sParam_;
    }

    public function getType()
    {
        return $this->sType;
    }

    public function getParam()
    {
        return $this->sParam;
    }
}
