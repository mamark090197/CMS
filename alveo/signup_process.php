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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $new_username = $new_password = $role = "";

    // Processing form data when form is submitted
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];
    $role = $_POST['role'];

    // Prepare an INSERT statement
    $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("sss", $param_username, $param_password, $param_role);

        // Set parameters
        $param_username = $new_username;
        $param_password = password_hash($new_password, PASSWORD_DEFAULT); // Hash password for security
        $param_role = $role;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Set success response
            $response['success'] = true;
            $response['message'] = "Account successfully created.";
            
            // Redirect to login page after successful signup
            header("Location: login.php");
            exit(); // Make sure to exit after redirection
        } else {
            // Set error response
            $response['success'] = false;
            $response['message'] = "Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    } else {
        // Set error response
        $response['success'] = false;
        $response['message'] = "Database error: " . $conn->error;
    }
} else {
    // Set error response
    $response['success'] = false;
    $response['message'] = "Form not submitted.";
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

<!-- JavaScript code to handle form submission -->
<script>
  document.getElementById("create-account-btn").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    var formData = new FormData(document.getElementById("signup-form-data"));

    // Make AJAX request to save data to database
    fetch('signup_process.php', {
      method: 'POST',
      body: formData
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text(); // Parse response as text
    })
    .then(data => {
      try {
        var responseData = JSON.parse(data); // Attempt to parse response as JSON
        if (responseData.success) {
          alert(responseData.message); // Show success message
          document.getElementById("signup-form").style.display = "none"; // Hide signup form
        } else {
          alert(responseData.message); // Show error message
        }
      } catch (error) {
        console.error('Error parsing JSON:', error);
        alert('Error: Unexpected response from server'); // Show error message for unexpected response
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Error: ' + error.message); // Show error message for network or other errors
    });
  });
</script>
