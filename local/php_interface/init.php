<? 
AddEventHandler('iblock', 'OnBeforeIBlockElementUpdate', 'CheckUpdateElement');
AddEventHandler('iblock', 'OnIBlockElementDelete', 'CheckDelete');

function CheckDelete($PRODUCT_ID){
    $select = CIBlockElement::GetByID($PRODUCT_ID)->Fetch();
    if($select['SHOW_COUNTER'] == 10000){
        CAdminMessage::ShowMessage('Данный элемент нельзя удалить так как он популярный на сайте');
        return false;
    }
}

function CheckUpdateElement(&$arFields){

    $select_elem = CIBlockElement::GetByID($arFields['ID'])->Fetch();
    \Bitrix\Main\Diag\Debug::dumpToFile(array('arFields' => $select_elem), "arFields", "/arFields.txt"); 

    $date_create = strtotime($select_elem['DATE_CREATE']);
    $date_now = strtotime(date("d.m.Y"));

    if(($date_now - $date_now) >= 604800){
        CAdminMessage::ShowMessage('Данные элемент нельзя изменить так как он старше одной недели!!!!');
        return false;
    }
    // CAdminMessage::ShowMessage('ERROR');

}