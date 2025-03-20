<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
  

    $to = "changeMail@email.com"; // Replace with your email
    $subject = "Žiadosť o spoluprácu na NGXP";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Dobrý deň, \n\n mal by som záujem o väčšiu spoluprácu na vašej nasledujúcej akcii NGXP.\n";
    $body .= "Prosím kontaktujte ma na Email: $email\n\n";
    $body .= "Správa bola vygenerová automaticky.\n";

    // Order payment
    $subjectRequestEn = "NGXP request notification";
    $bodyRequestEn = "Hello,\n";  
    $bodyRequestEn .= "Thank you for your request for collaboration. Our team will contact you as soon as possible.\n\n\n Best regards,\n NextGen Team.";  
    $bodyRequestEn .= "This message was generated automatically, please do not reply to it.\n";  

    // SK
    $subjectRequestSk = "Notifikácia k NGXP žiadosti";
    $bodyRequestSk = "Dobrý deň, \n";
    $bodyRequestSk .= "Ďakujeme za Vašu žiadosť o spoluprácu. Náš tím Vás bude kontaktovať v čo najbližšej dobe.\n\n\n S pozdravom,\n NextGen Team.";
    $bodyRequestSk .= "Táto správa bola vygenerovaná automaticky, nedpovedajte na ňu.\n";
   
    $headersRequest = "From: nextGen@sector.sk\r\n";
    $headersRequest .= "Reply-To: $email\r\n";
    $headersRequest .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        if (strpos($currentUrl, 'indexEng.html') !== false) {
            mail($email, $subjectRequestEn, $bodyRequestEn, $headersRequest);
            echo "<script>alert('Request sent successfully!'); window.location.href='indexEng.html';</script>";
        } else {
            mail($email, $subjectPaymentSk, $bodyRequestSk, $headersRequest);
            echo "<script>alert('Žiadosť úspešne odoslaná!'); window.location.href='index.html';</script>";
        }
        
        // echo "<script>alert('Order sent successfully!'); window.location.href='index.html';</script>";
    } else {
        if (strpos($currentUrl, 'indexEng.html') !== false) {
            echo "<script>alert('Failed to send request. Please try again.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Chyba pri odosielaní žiadosti. Vyskúšajte znova.'); window.history.back();</script>";
        }  
    }

    
}
?>
