<!DOCTYPE html>
<html>
<head>
  <title>Administrator View</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>Administrator View</h2>
  
  <!-- Search Bar -->
  <form method="GET" action="">
    <input type="text" name="search" placeholder="Search...">
    <button type="submit">Search</button>
  </form>

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

  // READ operation
  $search = '';
  if (isset($_GET['search'])) {
      $search = $_GET['search'];
  }

  $sql = "SELECT * FROM clients";
  if (!empty($search)) {
      $sql .= " WHERE client LIKE '%$search%'";
  }

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

      // Export to Excel
      echo '<form method="post" action="export.php">
              <button type="submit" name="export_excel">Export to Excel</button>
            </form>';
  } else {
      echo "0 results";
  }

  $conn->close();
  ?>
</body>
</html>
