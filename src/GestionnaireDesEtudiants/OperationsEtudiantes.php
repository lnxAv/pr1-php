<?php  

    interface OperationEtudiant {
        public function getStudents($filter, $info);
        public function setStudents($student);
        public function putStudents($student);
        public function deleteStudents($email);
    }
?>



