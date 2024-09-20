<?php  

    interface OperationEtudiant {
        public function getStudents($filter, $info);
        public function setStudents($student);
        public function putStudents($oldStudent, $newStudent);
        public function deleteStudents($student);
    }
?>



