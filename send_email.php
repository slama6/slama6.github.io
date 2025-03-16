<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $ticket = htmlspecialchars($_POST["ticket"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "changeMail@email.com"; // Replace with your email
    $subject = "New Ticket Order from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Ticket: $ticket\n";
    $body .= "Message: $message\n";

    if (mail($to, $subject, $body, $headers)) {
        if (strpos($currentUrl, 'indexEng.html') !== false) {
            echo "<script>alert('Order sent successfully!'); window.location.href='indexEng.html';</script>";
        } else {
            echo "<script>alert('Objednávka úspešne odoslaná!'); window.location.href='index.html';</script>";
        }
        // echo "<script>alert('Order sent successfully!'); window.location.href='index.html';</script>";
    } else {
        if (strpos($currentUrl, 'indexEng.html') !== false) {
            echo "<script>alert('Failed to send order. Please try again.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Chyba pri odosielaní objednávky. Vyskúšajte znova.'); window.history.back();</script>";
        }  
    }
}
?>
