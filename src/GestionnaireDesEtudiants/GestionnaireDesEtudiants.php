<?php 

include 'OperationsEtudiantes.php';

abstract class GestionnaireDesEtudiants implements OperationEtudiant {

    protected $filePath;
    private $file;

    public function __construct($filePath = "student.txt") {
        $this->filePath = $filePath;
    }

    abstract protected function toString($filePath);
    abstract protected function fromString($data);

        // protected function close


    protected function close() {
        if ($this->file) {
            fclose($this->file);
        }
    }

        // protected function open


    protected function open($state) {
        $this->close(); 
        $this->file = fopen($this->filePath, $state);
    }

    // protected function push

    
    protected function push($data) {
        echo $data; 
        $this->open("w"); 
        fwrite($this->file, $data);
        $this->close(); 
    }


// protected function replace


    protected function replace(array $comparators, bool $reduce = false) {
        $this->open("r+");
        $tempFile = tempnam(sys_get_temp_dir(), 'temp');
        $temp = fopen($tempFile, "w");
        while (($line = fgets($this->file)) !== false) {
            $replaced = false;
            foreach ($comparators as $key => $comparator) {
                if ($comparator($line)) {
                    $newLine = $this->toString();
                    fwrite($temp, $newLine . PHP_EOL);
                    $replaced = true;
                    if ($reduce) {
                        unset($comparators[$key]);
                    }
                    break;
                }
            }
            if (!$replaced) {
                fwrite($temp, $line);
            }
        }
        fclose($temp);
        $this->close();
        unlink($this->filePath);
        rename($tempFile, $this->filePath);
    }

    // protected function remove


    protected function remove(array $comparators, bool $reduce = false) {
        $this->open("r");
        $tempFile = tempnam(sys_get_temp_dir(), 'temp');
        $tempHandle = fopen($tempFile, "w");

        while (($line = fgets($this->file)) !== false) {
            $shouldRemove = false;
            foreach ($comparators as $key => $comparator) {
                if ($comparator($line)) {
                    $shouldRemove = true;
                    if ($reduce) {
                        unset($comparators[$key]);
                    }
                    break;
                }
            }
            if (!$shouldRemove) {
                fwrite($tempHandle, $line);
            }
        }
        fclose($tempHandle);
        $this->close();
        unlink($this->filePath);
        rename($tempFile, $this->filePath);
    }
}
?>

