<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск планировок");
?>
<?php
if ( isset($_POST) ) 
{
	if ( !empty($_POST['rooms']) && !empty($_POST['project']) && !empty($_POST['area']) )
	{
		if (\Bitrix\Main\Loader::includeModule('disk'))
		{
		    $driver = \Bitrix\Disk\Driver::getInstance();
		    //$storage = $driver->getStorageByUserId(1);//пользователя
		    //$storage = $driver->getStorageByGroupId(33);//группы
		    $storage = $driver->getStorageByCommonId('plans-disc_s1');//идентификатор
		    //$storage = \Bitrix\Disk\Storage::loadById(494);//знаем идентификатор хранилища
		    
		    if ($storage)
		    {
		        //можем работать с хранилищем
		       $folder = $storage->getChild( 
		            array( 		                
		                '=NAME' => $_POST['rooms'],
		                //'TYPE' => \Bitrix\Disk\Internals\FolderTable::TYPE_FOLDER 
		            )
		        );

				if ($folder)
				{
					$project = $folder->getChild(
						array(
							'=NAME' => $_POST['project'],
		                	//'TYPE' => \Bitrix\Disk\Internals\FolderTable::TYPE_FOLDER
							)
						);

					if ($project)
					{
						$area = $project->getChild(
							array(
								'=NAME' => $_POST['area'],
		                		//'TYPE' => \Bitrix\Disk\Internals\FolderTable::TYPE_FOLDER
								)
							);

						if ($area) 
						{
							$file = $area->getChild(
								array(
									//'=NAME' => '',
		                			//'TYPE' => \Bitrix\Disk\Internals\FolderTable::TYPE_FOLDER
									)
								);

							if ($file)
							{
							    //получение айди физического файла
							    $file_det = CFile::GetFileArray($file->getFileId());
							    //$file_det2 = CFile::MakeFileArray($file->getFileId());
							    
								$_SESSION['file_det'] = $file_det;
							}
						}
					}
				}
		    }
		}
	}
}
header('Location:'.$_SERVER['HTTP_REFERER']);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>