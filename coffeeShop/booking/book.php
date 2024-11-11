<?php require '../includes/header.php';
require '../includes/connect.php';

if (isset($_POST['submit'])) {
    if (empty($_POST['fname']) || empty($_POST['time']) || empty($_POST['lname']) || empty($_POST['date']) || empty($_POST['message'])) {
        header('Location:register.php?error=emptyfields');
        exit();
    } else {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $date = $_POST['date'];  
        $time = $_POST['time'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $user_id = $_SESSION['user_id'];

        // Converting date to Y-m-d for comparison
        $formattedDate = DateTime::createFromFormat('d/m/Y', $date);
        
        if ($formattedDate && $formattedDate->format('Y-m-d') >= date('Y-m-d')) {
            $stmt = $conn->prepare("INSERT INTO bookings (fname, lname, date, time, phone, message, user_id) VALUES (:fname, :lname, :date, :time, :phone, :message, :user_id)");
            $stmt->execute([
                ':fname' => $fname,
                ':lname' => $lname,
                ':date' => $formattedDate->format('Y-m-d'),  // Converting to standard format
                ':time' => $time,
                ':phone' => $phone,
                ':message' => $message,
                ':user_id' => $user_id
            ]);
            echo "<script>alert('Booked successfully')</script>";
        } else {
            echo "<script>alert('Invalid date: date must not be in the past')</script>";
        }
    }
}
?>
<?php require '../includes/footer.php'; ?>
