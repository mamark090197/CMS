<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "client_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Export to Excel
if(isset($_POST['export_excel'])){
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="clients.xlsx"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen("php://output", "w");

    // Write column headers
    fputcsv($output, array('Client', 'Date', 'Project', 'Source', 'CIS', 'CMF', 'Set Appointment', 'Site Visit', 'Uploaded', 'Status', '1st Follow-up Date', '1st Follow-up Notes', '2nd Follow-up Date', '2nd Follow-up Notes', 'FINAL RESULT'));

    // Retrieve all data from database table
    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()){
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}

$conn->close();
?>
