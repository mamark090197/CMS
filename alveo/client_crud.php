<!DOCTYPE html>
<html>
<head>

  <title>Camilla Monitoring</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
session_start();

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

// CREATE operation
if (isset($_POST['submit'])) {
    $client = $_POST['client'];
    $date = $_POST['date'];
    $project = $_POST['project'];
    $source = $_POST['source'];
    $cis = $_POST['cis'];
    $cmf = $_POST['cmf'];
    $setAppointment = $_POST['setAppointment'];
    $siteVisit = $_POST['siteVisit'];
    $uploaded = $_POST['uploaded'];
    $status = $_POST['status'];
    $firstFollowupDate = $_POST['firstFollowupDate'];
    $firstFollowupNotes = $_POST['firstFollowupNotes'];
    $secondFollowupDate = $_POST['secondFollowupDate'];
    $secondFollowupNotes = $_POST['secondFollowupNotes'];
    $finalResult = $_POST['finalResult'];

    $sql = "INSERT INTO clients (client, date, project, source, cis, cmf, set_appointment, site_visit, uploaded, status, first_followup_date, first_followup_notes, second_followup_date, second_followup_notes, final_result)
    VALUES ('$client', '$date', '$project', '$source', '$cis', '$cmf', '$setAppointment', '$siteVisit', '$uploaded', '$status', '$firstFollowupDate', '$firstFollowupNotes', '$secondFollowupDate', '$secondFollowupNotes', '$finalResult')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// READ operation
$sql = "SELECT * FROM clients";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Client</th>
                <th>Date</th>
                <th>Project</th>
                <th>Source</th>
                <th>CIS</th>
                <th>CMF</th>
                <th>Set Appointment</th>
                <th>Site Visit</th>
                <th>Uploaded</th>
                <th>Status</th>
                <th>1st Follow-up Date</th>
                <th>1st Follow-up Notes</th>
                <th>2nd Follow-up Date</th>
                <th>2nd Follow-up Notes</th>
                <th>FINAL RESULT</th>
            </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row['client']."</td>
                <td>".$row['date']."</td>
                <td>".$row['project']."</td>
                <td>".$row['source']."</td>
                <td>".$row['cis']."</td>
                <td>".$row['cmf']."</td>
                <td>".$row['set_appointment']."</td>
                <td>".$row['site_visit']."</td>
                <td>".$row['uploaded']."</td>
                <td>".$row['status']."</td>
                <td>".$row['first_followup_date']."</td>
                <td>".$row['first_followup_notes']."</td>
                <td>".$row['second_followup_date']."</td>
                <td>".$row['second_followup_notes']."</td>
                <td>".$row['final_result']."</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<h2>Welcome, <?php echo $_SESSION['username']; ?></h2>



<form method="post" action="">
    <label for="client">Client:</label>
    <input type="text" id="client" name="client"><br><br>

    <label for="date">Date:</label>
    <input type="date" id="date" name="date"><br><br>

    <label for="project">Project:</label>
    <select id="project" name="project">
        <option value="Sentrove (QC)">Sentrove (QC)</option>
        <option value="Orean Place Tower I (QC)">Orean Place Tower I (QC)</option>
        <!-- Add more options here -->
        <option value="Mergent Resinces (Makati)">Mergent Resinces (Makati)</option>
        <option value="Parkford suites (Makati)">Parkford suites (Makati)</option>
        <option value="Astela (Circuit, Makati)">Astela (Circuit, Makati)</option>
        <option value="Portico (Ortigas, Pasig)">Portico (Ortigas, Pasig)</option>
        <option value="The Lattice (C5, Pasig)">The Lattice (C5, Pasig)</option>
        <option value="Park East Place (BGC,Taguig)">Park East Place (BGC,Taguig)</option>
        <option value="Nuveo , Cerca (Las piñas Alabang)">Nuveo , Cerca (Las piñas Alabang)</option>
        <option value="Cerule (Cebu)">Cerule (Cebu)</option>
        <option value="Patio Suites, Abreeza (Davao)">Patio Suites, Abreeza (Davao)</option>
        <option value="South Palm Grove (Lipa, Batangas)">South Palm Grove (Lipa, Batangas)</option>
        <option value="Bayview Hieghts (CDO)">Bayview Hieghts (CDO)</option>
        <option value="Sereneo Nuvali (Nuvali, Laguna)">Sereneo Nuvali (Nuvali, Laguna)</option>
        <option value="Calea Vermosa (Imus Cavite)">Calea Vermosa (Imus Cavite)</option>
        <option value="Verdea Southmont (Silang, Cavite)">Verdea Southmont (Silang, Cavite)</option>
        <option value="Ardia Vermosa (Imus, Cavite)">Ardia Vermosa (Imus, Cavite)</option>
        <option value="Mondia Nuvali (Laguna)">Mondia Nuvali (Laguna)</option>
        <option value="The Residences Evo City (Kawit, Cavite)">The Residences Evo City (Kawit, Cavite)</option>
          </select><br><br>

    <label for="source">Source:</label>
    <select id="source" name="source">
        <option value="Cloverleaf Manning">Cloverleaf Manning</option>
        <option value="Vertis north Manning">Vertis north Manning</option>
        <!-- Add more options here -->
        <option value="Trinoma Manning">Trinoma Manning</option>
        <option value="UPTC Manning">UPTC Manning</option>
        <option value="BGC Manning">BGC Manning</option>
        <option value="OBHS Manning">OBHS Manning</option>
        <option value="S&R BGC Manning">S&R BGC Manning</option>
        <option value="S&R Libis Manning">S&R Libis Manning</option>
        <option value="S&R Congressional Manning">S&R Congressional Manning</option>
        <option value="S&R New Manila Manning">S&R New Manila Manning</option>
        <option value="SM Megamall Manning">SM Megamall Manning</option>
        <option value="Ayala 30th Mall Manning">Ayala 30th Mall Manning</option>
        <option value="Team Activity ">Team Activity </option>
        <option value="Team Events">Team Events</option>
        <option value="Referral">Referral</option>
        <option value="Social Media">Social Media</option>
       


    </select><br><br>

    <label for="cis">CIS:</label>
    <input type="text" id="cis" name="cis"><br><br>

    <label for="cmf">CMF:</label>
    <input type="text" id="cmf" name="cmf"><br><br>

    <!-- Include dropdowns for other fields as needed -->

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="Workable">Workable</option>
        <option value="Closable">Closable</option>
        <!-- Add more options here -->
        <option value="Out of the market">Out of the market</option>
        <option value="Interested, can't afford">Interested, can't afford</option>
        <option value="Can afford, not interested">Can afford, not interested</option>

    </select><br><br>

    <label for="setAppointment">Set Appointment:</label>
    <select id="setAppointment" name="setAppointment">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select><br><br>

    <label for="siteVisit">Site Visit:</label>
    <select id="siteVisit" name="siteVisit">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select><br><br>

    <label for="uploaded">Uploaded:</label>
    <select id="uploaded" name="uploaded">
        <option value="Yes">Yes</option>
        <option value="No">No</option>
    </select><br><br>

    <label for="status">Status:</label>
    <select id="status" name="status">
        <option value="Workable">Workable</option>
        <option value="Closable">Closable</option>
        <!-- Add more options here -->
    </select><br><br>

    <label for="firstFollowupDate">1st Follow-up Date:</label>
    <input type="date" id="firstFollowupDate" name="firstFollowupDate"><br><br>

    <label for="firstFollowupNotes">Notes:</label>
    <textarea id="firstFollowupNotes" name="firstFollowupNotes"></textarea><br><br>

    <label for="secondFollowupDate">2nd Follow-up Date:</label>
    <input type="date" id="secondFollowupDate" name="secondFollowupDate"><br><br>

    <label for="secondFollowupNotes">Notes:</label>
    <textarea id="secondFollowupNotes" name="secondFollowupNotes"></textarea><br><br>

    <label for="finalResult">FINAL RESULT:</label>
    <select id="finalResult" name="finalResult">
        <option value="Closed">Closed</option>
        <option value="Parked">Parked</option>
        <option value="Archive">Archive</option>
        <!-- Add more options here -->
    </select><br><br>

    <input type="submit" name="submit" value="Submit">
</form>

    <!-- Include other fields and submit button -->

  
    
</form>
</body>
</html>
