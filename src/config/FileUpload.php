<?php


class FileUpload
{
    private $name;
    private $type;
    private $size;
    private $error;
    private $tmpPath;
    private $fileExtension;
    public function __construct(array $file)
    {
        $this->name = $file['name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->error = $file['error'];
        $this->tmpPath = $file['tmp_name'];
        $this->name();
    }

    private function name()
    {
        preg_match_all('/([a-z]{1,4})$/i', $this->name, $m);
        $fileExtension = strtolower(end(explode('.',$this->name)));
        $this->fileExtension = $fileExtension;
        $name = substr(strtolower(base64_encode($this->name . APP_SALT)), 0, 30).time();
        $name = preg_replace('/(\w{6})/i', '$1_', $name);
        $name = rtrim($name, '_');
        $this->name = $name;
        return $name;
    }




    public function getFileName()
    {
        return $this->name . '.' . $this->fileExtension;
    }

    public function upload()
    {

            $storageFolder = 'http://wp-elshimy.000webhostapp.com/src/img/';

            if(is_writable($storageFolder)) {
                if(move_uploaded_file($this->tmpPath, $storageFolder . DS . $this->getFileName())){

                }else{
                    return false;
                }
            } else {
                throw new \Exception('Sorry the destination folder is not writable');
            }

        return $this;
    }
}