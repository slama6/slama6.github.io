<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $ticket = htmlspecialchars($_POST["ticket"]);
    $message = htmlspecialchars($_POST["message"]);
    $uuid = uniqid('', true);

    $to = "info@ngxp.sk"; // Replace with your email
    $subject = "New Ticket Order from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Ticket: $ticket\n";
    $body .= "Message: $message\n";
    $body .= "Request ID: $uuid\n";

    // Order payment
    $subjectPayment = "NextGen Ticket Order - Payment details";
    $bodyPayment = "Hello $name\n";
    $bodyPayment .= "Thank you for your order. For a successful ticket purchase, please make a bank transfer with the following details: \n";
    $bodyPayment .= "IBAN: SK0000 00000 0000 0000 0000\n";
    $bodyPayment .= "BIC: 000000\n";
    $bodyPayment .= "VS: $name $uuid\n";
    $bodyPayment .= "Price: $ticket \n\n\n";
    $bodyPayment .= "After completing the transfer, you will receive an entry confirmation in your email inbox. \n\n";
    $bodyPayment .= "Thank you.\n Best reards,\n NextGen Team.";
    // SK
    $subjectPaymentSk = "NextGen objednávka vstupeniek - Platobné detaily";
    $bodyPaymentSk = "Dobrý deň $name\n";
    $bodyPaymentSk .= "Ďakujeme za Vašu objednávku. Pre úspešné zakúpenie vstupenky vykonajte platobný prevod s nasledujúcimi údajmi: \n";
    $bodyPaymentSk .= "IBAN: SK0000 00000 0000 0000 0000\n";
    $bodyPaymentSk .= "BIC: 000000\n";
    $bodyPaymentSk .= "VS: $name $uuid\n";
    $bodyPaymentSk .= "Price: $ticket \n\n\n";
    $bodyPaymentSk .= "Po uhradení prevodu obdržíte do e-mailovej schránky potvrdenie vstupu. \n\n";
    $bodyPaymentSk .= "Ďakujeme.\n S pozdravom,\n NextGen Team.";
    
    $headersPayment = "From: nextGen@sector.sk\r\n";
    $headersPayment .= "Reply-To: $email\r\n";
    $headersPayment .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        if (strpos($currentUrl, 'indexEng.html') !== false) {
            mail($email, $subjectPayment, $bodyPayment, $headersPayment);
            echo "<script>alert('Order sent successfully!'); window.location.href='indexEng.html';</script>";
        } else {
            mail($email, $subjectPaymentSk, $bodyPaymentSk, $headersPayment);
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
