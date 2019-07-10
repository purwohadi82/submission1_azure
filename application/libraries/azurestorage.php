<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once __DIR__ . '/azurestorage/vendor/autoload.php';
/*
use MicrosoftAzure\Storage\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Queue\Models\CreateQueueOptions;
use MicrosoftAzure\Storage\Queue\Models\PeekMessagesOptions;
use MicrosoftAzure\Storage\Table\Models\Entity;
use MicrosoftAzure\Storage\Table\Models\EdmType;
*/
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;


class Azurestorage
{
    public function __construct()
    {
        // nothing to see here
	}
	public function getConnectionString()
	{
		/*
        $storageaccountkey = getenv('STORAGE_ACCOUNT_KEY');
		$storageaccountname = getenv('STORAGE_ACCOUNT_NAME');
        */
        $storageaccountkey = 'QldD9fFpWIqyvZcFtiXmDAGIX8RWD6HF8r2dNG4XUom01XKHfyQe6tU5PjrvLKUX/FHPzZl+0gwJaerG5QRYXw==';
		$storageaccountname = 'purwowebapp';
		return "DefaultEndpointsProtocol=https;AccountName=$storageaccountname;AccountKey=$storageaccountkey";
	}
	
    
    public function uploadBlob($connectionString,$file){
        //die($file["fileToUpload"]["name"]." ");
        $containerName = "blobpurwo";
        // Create table REST proxy.
        $fileToUpload = strtolower($file["fileToUpload"]["name"]);
        $content = fopen($file["fileToUpload"]["tmp_name"], "r");
        // echo fread($content, filesize($fileToUpload));
        //$blobClient->createBlockBlob($containerName, $fileToUpload, $content);
        
        if($blobClient->createBlockBlob($containerName, $fileToUpload, $content)){
                return TRUE; 
            }else{
                return FALSE; 
            }
            
    }
    
    
	public function createTable($connectionString, $tableName)
	{
		// Create table REST proxy.
		$tableRestProxy = ServicesBuilder::getInstance()->createTableService($connectionString);
		try    {
			// Create table.
			$tableRestProxy->createTable($tableName);
		}
		catch(ServiceException $e){
			// Handle exception based on error codes and messages.
			// Error codes and messages can be found here:
			// http://msdn.microsoft.com/library/azure/dd179438.aspx
			$code = $e->getCode();
			$error_message = $e->getMessage();
			log_message('error', "$code - $error_message");
		}
	}
	
}