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

    
    public function testWithStudent(Etudiant $studentTest) {
        $this->push($this->toString($studentTest));
        echo "Étudiant de test ajouté.\n";
        $this->displayFileContents();
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
    public function remove($comparator) {
        $this->remove([$comparator]);
    }

    public function test() {

        $student1 = new Etudiant('Dupont', 'Jean', '1990-01-01', 'jean.dupont@email.com');
        $student2 = new Etudiant('Martin', 'Marie', '1992-05-15', 'marie.martin@email.com');
        $student3 = new Etudiant('Durand', 'Pierre', '1988-11-30', 'pierre.durand@email.com');

        $this->push($this->toString($student1));
        $this->push($this->toString($student2));
        $this->push($this->toString($student3));

        echo "Étudiants ajoutés.\n";

        $this->remove(function($line) {
            return strpos($line, 'Martin;Marie') !== false;
        });

        echo "Étudiant 'Martin Marie' supprimé.\n";

        $this->displayFileContents();
    }
    private function displayFileContents() {
        $this->open("r");
        echo "Contenu du fichier après suppression :\n";
        while (($line = fgets($this->file)) !== false) {
            echo $line;
        }
        $this->close();
    }
}
?>

