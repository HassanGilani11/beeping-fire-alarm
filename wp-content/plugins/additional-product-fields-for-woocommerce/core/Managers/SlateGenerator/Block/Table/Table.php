<?php


namespace rednaowooextraproduct\core\Managers\SlateGenerator\Block\Table;


use rednaowooextraproduct\core\Managers\SlateGenerator\Core\NodeElementBase;

class Table extends NodeElementBase
{

    /**
     * @inheritDoc
     */
    public function GetNodeName()
    {
        return 'table';
    }

    public function Process()
    {
        $with=$this->GetDataValue('Width','200');
        $height=$this->GetDataValue('Height','200');

        $this->Node->AddStyles(array('width'=>$with.'px','height'=>$height.'px','table-layout'=>'fixed','border-collapse'=>'collapse'));
        parent::Process(); // TODO: Change the autogenerated stub
    }


}