<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Additional CSS styles */
    .login-container {
      margin-top: 100px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="login-container">
          <h2>Login</h2>
          <form method="post" action="login_process.php">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
          </form>
          
          <!-- Signup hyperlink -->
          <p class="mt-3">Don't have an account? <a href="#" id="signup-link">Sign up</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Signup Form -->
  <div id="signup-form" style="display: none;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="login-container">
            <h2>Sign Up</h2>
            <form id="signup-form-data" method="post" action="signup_process.php">
              <div class="form-group">
                <label for="new_username">New Username:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" required>
              </div>
              <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
              </div>
              <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" id="role" name="role">
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>
              </div>
              <button type="submit" class="btn btn-primary" id="create-account-btn">Create Account</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript code to handle form submission -->
<script>
  document.getElementById("signup-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default action of the link
    document.getElementById("signup-form").style.display = "block"; // Show signup form
  });

  document.getElementById("signup-form-data").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    // Get form data
    var formData = new FormData(this);

    // Make AJAX request to save data to database
    fetch('signup_process.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.message); // Show success message
        document.getElementById("signup-form").style.display = "none"; // Hide signup form
      } else {
        alert(data.message); // Show error message
      }
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
</script>














</body>
</html>
