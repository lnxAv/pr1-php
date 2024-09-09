<?php   
abstract class GestionnaireDesEtudiants extends OperationsEtudiantes {

    protected $filePath;
    private $file;

    abstract protected function toString();
    abstract protected function fromString();

    protected function close() {
        if($file){
            fclose($file);
        }
    }

    protected function open($state) {
        $this->close();
        $file = fopen(filePath,$state);
    }

    protected function push() {
        $this->open("w");
        fwrite($this->$file, "Bonjour");
        fclose($file);

    }
 }

/* -variable
  protected filePath
  private file

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
?>