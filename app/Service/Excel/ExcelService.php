<?php

namespace App\Service\Excel;

class ExcelService
{
    private $filePath;
    private $chunkSize;
    private $filter;
    private $excelReader;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->chunkSize = 250;

        $this->filter = new \App\Service\Excel\ChunkReadFilter();
        $this->excelReader = \PHPExcel_IOFactory::createReaderForFile($this->filePath);
        $this->excelReader->setReadFilter($this->filter);
    }

    public function setChunkSize($chunkSize){
        $this->chunkSize = $chunkSize;
        return $this;
    }

    public function setFilter(\PHPExcel_Reader_IReadFilter $filter){
        $this->filter = $filter;
        return $this;
    }

    public function search($key, $column = null){
        $hasMoreRows = true;
        $startRow = 1;

        while($hasMoreRows){
            $this->filter->setRows($startRow, $this->chunkSize);
            $excelObj = $this->excelReader->load($this->filePath);
            if($excelObj->getActiveSheet()->getHighestDataRow() == 1){
                return null;
            }
            $data = $excelObj->getActiveSheet()->rangeToArray(
                'A'.$startRow.':'.$excelObj->getActiveSheet()->getHighestColumn().($startRow+$this->chunkSize-1),
                null, false, false, true
            );
            foreach ($data as $row){
                foreach ($row as $col=>$val){
                    if($column){
                        if(array_key_exists($col, $column)){
                            if($key == trim($val)) return $row;
                        }
                    }else{
                        if($key == trim($val)) return $row;
                    }
                }
            }
        }
        return null;
    }

    public function chunk(Callable $callback){
        $hasMoreRows = true;
        $startRow = 1;

        while($hasMoreRows){
            $this->filter->setRows($startRow, $this->chunkSize);
            $excelObj = $this->excelReader->load($this->filePath);
            if($excelObj->getActiveSheet()->getHighestDataRow() == 1){
                return null;
            }
            $data = $excelObj->getActiveSheet()->rangeToArray(
                'A'.$startRow.':'.$excelObj->getActiveSheet()->getHighestColumn().($startRow+$this->chunkSize-1),
                null, false, false, true
            );
            call_user_func($callback, $data);
        }
    }
}