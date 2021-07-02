<?

namespace DDS;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\SystemException;
use Bitrix\Main\UserTable;
use Bitrix\Main\Web\Json;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

\CModule::IncludeModule('highloadblock');
class HL
{

    private static $_cache = [];


    /**
     * @param int $HlBlockId
     * @return array
     */
    public static function GetEntityDataClass($HlBlockId)
    {
        if (empty($HlBlockId) || $HlBlockId < 1) {
            return false;
        }
        $hlblock = HLBT::getById($HlBlockId)->fetch();
        $entity = HLBT::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        return $entity_data_class;
    }
    /**
     * @param int $HlBlockId
     * @param int $Element_id
     * @return array
     */
    public static function GetHLElementbyID($HlBlockId, $Element_id)
    {
        if ($HlBlockId) {
            $entity_data_class = HL::GetEntityDataClass($HlBlockId);
            $select = array('select' => array('*'));
            $filter = array('=ID' => $Element_id);
            $rsData = $entity_data_class::getById($Element_id);
            while ($el = $rsData->fetch()) {
                $arItem = $el;
                if ($arItem['UF_LOGO']) {
                    $arItem['UF_LOGO'] = \CFile::GetFileArray($arItem['UF_LOGO']);
                }
            }

        }
        return $arItem;
    }
    /**
     * @param int $HlBlockId
     * @param array $arSelect
     * @param array $arFilter
     * @param array $arOrder
     * @param array $arPageSize
     * @return array
     */
    static public function HLGetlist($HlBlockId = 0,$arSelect = ['*'],$arFilter = [],$arOrder = [],$arPageSize = false) {
        $arItems = [];

        if ($HlBlockId > 0) {
            $entity_data_class = HL::GetEntityDataClass($HlBlockId);
            $arGetList = ['select' => $arSelect, 'filter' => $arFilter, 'order' => $arOrder];
            if ($arPageSize != false) {
                $arGetList['offset'] = $arPageSize['iNumPage'];
                $arGetList['limit'] = $arPageSize['nPageSize'];
                $arGetList['count_total'] = true;
            }
            $rsData = $entity_data_class::getList($arGetList);
            while ($arItem = $rsData->fetch()){
                if($arItem['UF_FILE'])
                    $arItem['UF_FILE'] = \CFile::GetFileArray( $arItem['UF_FILE']);
                $arItems[$arItem['ID']] = $arItem;
            }
        }
        if ($arPageSize != false) {
            return ['ITEMS' => $arItems, 'COUNTER' => $rsData->getCount()];
        }
        return $arItems;
    }
    /**
     * @param int $HlBlockId
     * @param array $arFields
     * @return array
     */
    public static function HLAddElement($HlBlockId,$arFields = [])
    {
        if ($HlBlockId && $arFields) {
            $entity_data_class = HL::GetEntityDataClass($HlBlockId);
            $result = $entity_data_class::add($arFields);
        }
        return $result->getId();
    }
    /**
     * @param int $HlBlockId
     * @param int $id
     * @return array
     */
    public static function HLDeleteElement($HlBlockId,$id)
    {
        if ($HlBlockId ) {
            $entity_data_class = HL::GetEntityDataClass($HlBlockId);
            $result = $entity_data_class::delete($id);
        }
        return $result;
    }
    /**
     * @param int $HlBlockId
     * @param int $id
     * @param array $arFilter
     * @param array $arFields
     * @return array
     */
    public static function updateElement($HlBlockId,$id,$arFields = [])
    {
        $entity_data_class = HL::GetEntityDataClass($HlBlockId);
        $result = $entity_data_class::update($id, $arFields);
        if ($result->isSuccess()) {
            return ['TYPE'=>'SUCCESS'];
        } else {
            return  ['TYPE'=>'ERROR','MESSAGE'=>$result->getErrorMessages()];
        }

    }
    /**
     * @param array $filter
     * @return array
     */
    public static function getUFPropList($filter)
    {
        $rsData = \CUserTypeEntity::GetList( array(), $filter );
        while($arRes = $rsData->Fetch())
        {
            if($arRes['USER_TYPE_ID']=='enumeration'){
                $obEnum = new \CUserFieldEnum;
                $rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => $arRes["ID"]));

                $enum = array();
                while($arEnum = $rsEnum->Fetch())
                {
                    $arRes['VALUES'][$arEnum["ID"]] = $arEnum["VALUE"];
                }

            }
            $arValues[$arRes['FIELD_NAME']] = $arRes;
        }
        return $arValues;
    }
}