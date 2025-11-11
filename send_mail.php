<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "kakrishnani208@gmail.com";
    $subject = "New Mahila Pragathi Loan Application";

    // Collect form details
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
    <p><b>Location Link:</b> {$_POST['location']}</p>
    ";

    // Create boundary
    $boundary = md5(time());

    // Email headers
    $headers .= "CC: kakrishnani208@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

    // Message body
    $body = "--{$boundary}\r\n";
    $body .= "Content-Type: text/html; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";

    // File upload fields
    $file_fields = [
        'passport_photo' => 'Passport Photo',
        'aadhaar' => 'Aadhaar Card',
        'pan' => 'PAN Card',
        'caste_certificate' => 'Caste Certificate',
        'bank_passbook' => 'Bank Passbook',
        'work_photo' => 'Work Photo',
        'residence_photo' => 'Residence Photo',
        'gps_photo' => 'Workplace GPS Photo'
    ];

    // Handle single file uploads
    foreach ($file_fields as $field => $label) {
        if (!empty($_FILES[$field]['tmp_name'])) {
            $file_tmp = $_FILES[$field]['tmp_name'];
            $file_name = $_FILES[$field]['name'];
            $file_data = chunk_split(base64_encode(file_get_contents($file_tmp)));

            $body .= "--{$boundary}\r\n";
            $body .= "Content-Type: application/octet-stream; name=\"{$file_name}\"\r\n";
            $body .= "Content-Disposition: attachment; filename=\"{$label} - {$file_name}\"\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= $file_data . "\r\n";
        }
    }

    // Handle multiple 'other_docs[]'
    if (!empty($_FILES['other_docs']['name'][0])) {
        foreach ($_FILES['other_docs']['tmp_name'] as $i => $tmp_name) {
            if (!empty($tmp_name)) {
                $file_name = $_FILES['other_docs']['name'][$i];
                $file_data = chunk_split(base64_encode(file_get_contents($tmp_name)));

                $body .= "--{$boundary}\r\n";
                $body .= "Content-Type: application/octet-stream; name=\"{$file_name}\"\r\n";
                $body .= "Content-Disposition: attachment; filename=\"Other Document - {$file_name}\"\r\n";
                $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
                $body .= $file_data . "\r\n";
            }
        }
    }

    $body .= "--{$boundary}--";

    // Send mail
    if (mail($to, $subject, $body, $headers)) {
        header("Location: thankyou.html");
        exit;
    } else {
        echo "<h3>There was an error sending your application. Please try again later.</h3>";
    }
}
?>
