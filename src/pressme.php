<?php
ini_set('memory_limit', '2M');
error_reporting(E_ALL ^ E_NOTICE);
ini_set('max_execution_time', 0);
set_time_limit(0);
/**
 * Created by PhpStorm.
 * User: jlmconsulting
 * Date: 6/21/18
 * Time: 5:34 PM
 * Class pressme
 * Supports the following compression formats:
 * .txt
 */
class pressme
{
    /**
     * @var int
     * @var array
     * @var array
     * @var string
     * @var string
     */
    private $stamp = 0;
    private $success = array();
    private $errors = array();
    public $savedFile = '';
    public $savedFolder = '';

    /**
     * pressme constructor.
     * Pre - Setting:
     * TimeStamp
     * Directory
     */
    public function __construct()
    {
        $data = new DateTime();
        $this->stamp = $data->getTimestamp();
        $this->savedFolder = dirname(dirname(__FILE__)) . '/web/files/';

    }

    /**
     * @param $file
     * @return mixed|string
     * Convert filename withUID and back
     */
    public function hashFile($file)
    {

        $fileName = preg_replace('/(\\.\\d+\\.)/', '.', $file);
        if ($fileName !== $file)
            return $this->success['filename'] = $fileName;
        $nameArray = explode(".", $file);
        $extPop = array_splice($nameArray, (sizeof($nameArray) - 1));

        //$extPop[0] can add .gz extension here!
        array_push($nameArray, $this->stamp, $extPop[0]);
        return $this->success['filename'] = implode(".", $nameArray);

    }
    /**
     * @return bool
     */
    private function fetchFile()
    {

        if (is_file($this->savedFile)) {
            array_push($this->success, 'File exists');
            $this->fileStats($this->savedFile);
            return true;
        }
        array_push($this->errors, 'File does not exists');
        return false;
    }

    /**
     * @param $file
     * @return array
     * add file details to array
     */
    private function fileStats($file)
    {
        return $this->success['stats'] = stat($file);
    }

    /**
     * @param $file
     * @return array
     */
    public function fileCompressor($file)
    {
        $this->savedFile = $this->savedFolder . $file;
        if ($this->fetchFile()) {
            $this->success['content'] = file_get_contents($this->savedFile);
            $this->putFile($file, serialize(gzcompress($this->success['content'], 9)));
            return $this->success;
        }
        return $this->errors;
    }

    /**
     * @param $file
     * @return array
     */
    public function fileDecompressor($file)
    {
        $this->savedFile = $this->savedFolder . $file;
        if ($this->fetchFile()) {
            $this->success['content'] = $this->pullFile();
            $this->putFile($file, gzuncompress(unserialize($this->success['content'])));
            return $this->success;
        }
        return $this->errors;
    }

    /**
     * @return string
     */
    private function pullFile()
    {
        return file_get_contents(($this->savedFile));
    }

    /**
     * @param $file
     * @param $data
     */
    private function putFile($file, $data)
    {
        file_put_contents($this->savedFolder . $this->hashFile($file), $data);
    }

}