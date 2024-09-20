<?php 
include 'OperationsEtudiantes.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
abstract class GestionnaireDesEtudiants implements OperationEtudiant {
    protected $filePath;
    private $file;

    public function __construct($filePath = "student.txt") {
        $this->filePath = $filePath;
    }

    abstract protected function toString($filePath);
    abstract protected function fromString($student);

    /* Fermeture et ouverture du fichier */
    protected function close() {
        if ($this->file) {
            fclose($this->file);
            $this->file = null;
        }
    }

    protected function open($state) {
        $this->close(); 
        $this->file = fopen($this->filePath, $state);
    }

    /* Recherche d'étudiant dans le fichier */
    protected function read($filter = 'all', $info='') {
        $this->open("r");
        $students = array();
        $regex= "/^{$info}/i";
        while (($line = fgets($this->file)) !== false) {
            $match = $this->compare($filter, $line, $regex);
            if ($match) {
                $students[] = $match;
            }
        }
        $this->close();
        return $students;
    }

    /* Compare un regex et un étudiant
    * si le regex matche, on retourne l'étudiant
    * sinon on retourne null
    */
    private function compare($filter, $line, $regex) {
        $student = $this->fromString($line);
        if(!$student) return null;
        switch ($filter) {
            case "email":
                return preg_match($regex, $student->email)? $student : null;
                break;
            case "nom":
                return preg_match($regex, $student->nom)? $student : null;
                break;
            case "prenom":
                return preg_match($regex, $student->prenom)? $student : null;
                break;
            case "date_naissance":
                return preg_match($regex, $student->date_naissance)? $student : null;
                break;
            case "all":
                return $student;
                break;
            default:
                return null;
                break;
        }
    }

    /* Ajout d'un étudiant dans le fichier */
    protected function push($student) {
        // si l'email existe déjà dans le fichier, on ne l'ajoute pas
        if (count($this->read("email", $student->email))) {
            return false;
        }
        // on ajoute l'email au fichier
        $stringData = $this->toString($student) . PHP_EOL;
        $this->open("a"); 
        fwrite($this->file, $stringData);
        $this->close(); 
        return true;
    }

    /* Remplacement d'un étudiant dans le fichier */
    protected function replace($oldStudent, $newStudent) {
        // si l'email existe déjà dans le fichier, on ne le remplace pas
        if (count($this->read("email", $newStudent->email))) {
            return false;
        }
        // on remplace l'email dans le fichier
        $this->open("r+");
        $tempFile = tempnam(sys_get_temp_dir(), 'temp');
        $temp = fopen($tempFile, "w");
        
        $replaced = false;
        while (($line = fgets($this->file)) !== false) {
            $regex = "/^{$oldStudent->email}/i";
            if (!$replaced && $this->compare("email", $line, $regex)) {
                fwrite($temp, $this->toString($newStudent) . PHP_EOL);
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

    /* Suppression d'un étudiant dans le fichier */
    protected function remove($student) {
        // si l'email existe on le supprime
        if (!count($this->read("email", $student->email))) {
            return false;
        }
        // on supprime l'email du fichier
        $this->open("r+");
        $tempFile = tempnam(sys_get_temp_dir(), 'temp');
        $temp = fopen($tempFile, "w");
        
        $deleted = false;
        while (($line = fgets($this->file)) !== false) {
            $regex = "/^{$student->email}/i";
            if (!$deleted && $this->compare("email", $line, $regex)) {
                // jump to next line
                $deleted = true;
                continue;
            } else {
                fwrite($temp, $line);
            }
        }
        fclose($temp);
        $this->close();
        unlink($this->filePath);
        rename($tempFile, $this->filePath);
        return $deleted;
    }
}
?>

