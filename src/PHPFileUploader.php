<?php
namespace VVS\PHPFileUploader;
/**
 * PHPFileUploadclass
 * 
 * @author Vadim Vagin
 */

class PHPFileUploader
{
    protected $blacklist;
    
    
    public function __construct() {
        $this->blacklist=array(".php", ".phtml", ".php3", ".php4");
    }


    public function loadFile($path,$fileid)
    {
             $in_blacklist=false;
             foreach ($this->blacklist as $item) 
             {
                 
                if(preg_match("/$item\$/i", $_FILES[$fileid]['name'])) 
                {    
                    $data['status']="error file in black list";
                    $data['filename']="";
                    $in_blacklist=true;
                }
            }
            if(!$in_blacklist)
            {
                $uploaddir = $path.'/';
                $uploadfile = $uploaddir . basename($_FILES[$fileid]['name']);
                if (move_uploaded_file($_FILES[$fileid]['tmp_name'], $uploadfile)) 
                {
                    $data['status']="success";
                    $data['filename']=$uploadfile;
                    
                                 
                } 
                else 
                {
                    $data['status']="Cannot move file ".$uploadfile." error number: ".$_FILES[$fileid]["error"];
                    $data['filename']="";
                }
            }
            return $data;
            
        }
    
};






