<?php
$servername = "localhost";
$username = "root@localhost"; // Your database username
$password = " "; // Your database password
$dbname = "car"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data
$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
// Continue for other fields...

$sql = "INSERT INTO bookings (name, email) VALUES ('$name', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>.
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    // Additional processing...

    // Prepare email content
    $to = 'your-email@example.com'; // Change this to your email address
    $subject = 'New Booking Request';
    $message = "You have received a new booking request from:\n\nName: $name\nEmail: $email";
    $headers = 'From: webmaster@example.com' . "\r\n" . // Change this to your from address
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    // Send the email
    if(mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully";
    } else {
        echo "Email sending failed";
    }
}
?>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $pickupDate = htmlspecialchars($_POST['pickup-date']);
    $returnDate = htmlspecialchars($_POST['return-date']);

    // Process the data (e.g., save to database, send email)
    // For demonstration, we'll just echo the data
    echo "Name: $name<br>Email: $email<br>Phone: $phone<br>Pickup Date: $pickupDate<br>Return Date: $returnDate";

    // After processing, you can redirect or display a message
    // header('Location: thank-you.html'); // Redirect to a thank-you page
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // Continue for each form field...

    // Validate input data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    // Continue validation as needed...

    if (count($errors) === 0) {
        // Process the booking (e.g., save to database)

        // Optionally, send a confirmation email
        // mail($email, "Booking Confirmation", "Your booking details...");

        // Redirect to a thank-you page or display a success message
        header("Location: thank-you.html");
        exit;
    } else {
        // Handle errors, perhaps pass them back to the form
    }
}
?>
<?php
// Database configuration
$host = 'localhost';
$dbname = 'car';
$username = 'root@localhost';
$password = ' ';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO bookings (name, email) VALUES (:name, :email)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    // Bind more parameters as needed...
    $stmt->execute();

    // Success
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>