<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $path = 'uploads/' . $file;
    if (file_exists($path)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename=' . $file);
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit();
    }
}
echo 'File not found';
?>
