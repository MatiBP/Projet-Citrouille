<?php
session_start();
if ((empty($_SESSION['teacher'])) && (empty($_SESSION['admin']))){
    header('Location: ../AfficherTeacherStudent/AfficherStudent.php?liste=' . $_GET['liste']);
    exit;
} 
else {
    header('Location: ../AfficherTeacherStudent/AfficherTeacher.php?liste=' . $_GET['liste']);
    exit;
}
