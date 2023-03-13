<?php
session_start();

// Redirect to login page if user is not logged in
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get user's name from session variable
$username = $_SESSION['username'];

// Get login time from cookie variable
$login_time = $_COOKIE['login_time'];

// Define database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbstudentindividualinventory";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo '<h1>View Student Record Using PHP</h1><p><a href="index.php?logout=true">Logout</a></p>';


// Define SQL query to retrieve data from the "items" table
$sql = "SELECT * FROM tblstudent";
$result = mysqli_query($conn, $sql);

// Output data from the "items" table
if (mysqli_num_rows($result) > 0) {
    echo "<style>
          table {
              border: 2px solid black;
              border-collapse: collapse;
          }
          
          th, td {
              padding: 10px;
              text-align: left;
          }
          
          th {
              background-color: #4CAF50;
              color: white;
          }
          
          tr:nth-child(even) {
              background-color: #f2f2f2;
          }
          
          tr:hover {
              background-color: #ddd;
          }
          </style>";

    echo "<table>
    <tr>
    <th>IDNO</th>
    <th>StudentID</th>
    <th>FirstName</th>
    <th>MiddleName</th>
    <th>LastName</th>
    <th>Sex</th>
    <th>CivilStatus</th>
    <th>DateofBirth</th>
    <th>Age</th>
    <th>PlaceofBirth</th>
    <th>CityAddress</th>
    <th>ProvincialAddress</th>
    <th>EmailAddress</th>
    <th>TelephoneNo</th>
    <th>MobileNo</th>
    <th>CourseID</th>
    <th>StudentLevel</th>
    <th>StudentSection</th>
    <th>StudentHeight</th>
    <th>StudentWeight</th>
    <th>Comlexion</th>
    <th>Religion</th>
    </tr>";
    
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        // Output table row with additional "Edit" and "Delete" buttons
        echo "<tr><td>" 
        .$row["IDNO"] 
        ."</td><td>" 
        .$row["StudentID"]
        ."</td><td>" 
        .$row["FirstName"] 
        ."</td><td>" 
        .$row["MiddleName"] 
        ."</td><td>" 
        .$row["LastName"] 
        ."</td><td>"
        .$row["Sex"] 
        ."</td><td>"
        .$row["CivilStatus"] 
        ."</td><td>"
        .$row["DateofBirth"] 
        ."</td><td>"
        .$row["Age"] 
        ."</td><td>"
        .$row["PlaceofBirth"] 
        ."</td><td>"
        .$row["CityAddress"] 
        ."</td><td>"
        .$row["ProvincialAddress"] 
        ."</td><td>"
        .$row["EmailAddress"] 
        ."</td><td>"
        .$row["TelephoneNo"] 
        ."</td><td>"
        .$row["MobileNo"] 
        ."</td><td>"
        .$row["CourseID"] 
        ."</td><td>"
        .$row["S_Level"] 
        ."</td><td>"
        .$row["S_Section"] 
        ."</td><td>"
        .$row["S_Height"] 
        ."</td><td>"
        .$row["S_Weight"] 
        ."</td><td>"
        .$row["Comlexion"] 
        ."</td><td>"
        .$row["Religion"] 
        ."</td></tr>";

    }
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}
// Close the database connection
mysqli_close($conn);
?>
