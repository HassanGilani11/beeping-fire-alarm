<?php


namespace rednaowooextraproduct\core\Managers\FormManager\Fields;


class FBSurveyField extends FBFieldBase
{
    public function GetValue()
    {
        return $this->GetEntryValue('Value','');
    }

    public function GetText()
    {
        return $this->GetEntryValue('Value','');
    }

    public function GetLineItems(){
        if($this->Entry==null||$this->GetEntryValue('SelectedValues','')==='')
            return array();

        return array((object)\array_merge((array)$this->Entry,array(
            'Id'=>$this->Options->Id,
            'FieldName'=>$this->Options->FieldName,
            'Type'=>$this->Options->Type
        )));
    }

}