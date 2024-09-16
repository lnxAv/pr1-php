<?php namespace Modules\Gestionnaire;

abstract class GestionnaireDesEtudiants extends OperationsEtudiantes {

    protected $filePath;
    private $file;

    public function __construct($filePath = "student.txt") {
        $this->filePath = $filePath;
    }

    abstract protected function toString();
    abstract protected function fromString();

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

Class to manipulate the file
/* -variable
  protected filePath
  private file
*/
/*
* abstract protected function toString()
* abstract protected function fromString()

* protected function open
* @desc - Open the file at filePath
* @return - fopen Result

* protected function close
* @desc   - fclose if $file exist

* protected function push
* @input  - string
* @desc   - add string at the end of file

* protected function replace
* @input  - Array of (string $line)=> Boolean, Boolean reduce
* @desc   - Uses the array of comparators
* If function return true replace,
* else next line
* If reduce is set to true
* remove comparator from the array when found

* protected function remove
* @input  - Array of (string $line)=> Boolean, Boolean reduce
* @desc   - Uses the array of comparators
* If function return true remove,
* else next line
* If reduce is set to true
* remove comparator from the array when found
*/