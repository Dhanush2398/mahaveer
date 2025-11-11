<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "kakrishnani208@gmail.com";
    $subject = "New Mahila Pragathi Loan Application";

    $message = "
    <h2>New Loan Application Details</h2>
    <p><b>Full Name:</b> {$_POST['full_name']}</p>
    <p><b>Date of Birth:</b> {$_POST['dob']}</p>
    <p><b>Gender:</b> {$_POST['gender']}</p>
    <p><b>Caste:</b> {$_POST['caste']}</p>
    <p><b>Marital Status:</b> {$_POST['marital_status']}</p>
    <p><b>Address:</b> {$_POST['address']}</p>
    <p><b>Village:</b> {$_POST['village']}</p>
    <p><b>Taluk:</b> {$_POST['taluk']}</p>
    <p><b>Hobli:</b> {$_POST['hobli']}</p>
    <p><b>District:</b> {$_POST['district']}</p>
    <p><b>Contact:</b> {$_POST['contact']}</p>
    <p><b>Bank Details:</b> {$_POST['bank_details']}</p>
    <p><b>Yearly Income:</b> {$_POST['income']}</p>
    <p><b>Manufacturing Activity:</b> {$_POST['activity']}</p>
    <p><b>Factory Place:</b> {$_POST['factory']}</p>
    ";

    $headers = "From: noreply@yourdomain.com\r\n";
    $headers .= "Content-type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Application sent successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to send. Please try again.'); window.history.back();</script>";
    }
}
?>
