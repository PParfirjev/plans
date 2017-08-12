<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Добавление планировок");
?>
<?
if (isset($_POST))
{
	if ( !empty($_POST['element_id']) )
	{
		if ( !empty($_POST['plan_id']) )
		{
			$arFile = CFile::MakeFileArray($_POST['plan_id']);
			//CIBlockElement::SetPropertyValueCode($_POST['element_id'], "PLAN", $arFile);
		}
		elseif ( !empty($_FILES['file_upload']) ) 
		{
			$arr_file=Array(
				"name" => $_FILES['file_upload']['name'],
				"size" => $_FILES['file_upload']['size'],
				"tmp_name" => $_FILES['file_upload']['tmp_name'],
				"type" => $_FILES['file_upload']['type'],
				"old_file" => "",
				"del" => "Y",
				"MODULE_ID" => "main");
			
			$fid = CFile::SaveFile($arr_file, "main");
			
			if (intval($fid)>0)
			{
				$arFile = CFile::MakeFileArray($fid);
			}
		}
		
		CIBlockElement::SetPropertyValueCode($_POST['element_id'], "PLAN", $arFile);
	}
}
header('Location:'.$_SERVER['HTTP_REFERER']);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>