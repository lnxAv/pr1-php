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

protected function replace($comparator, $newData) {
    $this->open("r+");
    $tempFile = tempnam(sys_get_temp_dir(), 'temp');
    $temp = fopen($tempFile, "w");
    
    $replaced = false;
    while (($line = fgets($this->file)) !== false) {
        if (!$replaced && $comparator($line)) {
            fwrite($temp, $this->toString($newData) . PHP_EOL);
            $replaced = true;
        } else {
            fwrite($temp, $line);
        }
    }
    
    fclose($temp);
    $this->close();
    
    unlink($this->filePath);
    rename($tempFile, $this->filePath);
    
    return $replaced;
}

// protected function remove 

public function  remove($comparator) {
    $this->remove([$comparator]);
}


public function test() {
    // Ajout de quelques étudiants pour le test
    $student1 = new Etudiant('Dupont', 'Jean', '1990-01-01', 'jean.dupont@email.com');
    $student2 = new Etudiant('Martin', 'Marie', '1992-05-15', 'marie.martin@email.com');
    $student3 = new Etudiant('Durand', 'Pierre', '1988-11-30', 'pierre.durand@email.com');

    $this->push($this->toString($student1));
    $this->push($this->toString($student2));
    $this->push($this->toString($student3));

    echo "Étudiants ajoutés.\n";
    $this->displayFileContents();


    
    // Test de la fonction replace
    $newStudent = new Etudiant('Martin', 'Sophie', '1993-07-20', 'sophie.martin@email.com');
    $replaced = $this->replace(
        function($line) { 
            return strpos($line, 'marie.martin@email.com') !== false; 
        },
        $newStudent
    );
    if ($replaced) {
        echo "Remplacement effectué : Marie Martin a été remplacée par Sophie Martin.\n";
    } else {
        echo "Aucun remplacement effectué.\n";
    }
    echo "Contenu du fichier après remplacement :\n";
    $this->displayFileContents();
}
private function displayFileContents() {
    $this->open("r");
    while (($line = fgets($this->file)) !== false) {
        echo $line;
    }
    $this->close();
    echo "\n";
    }
}

?>

