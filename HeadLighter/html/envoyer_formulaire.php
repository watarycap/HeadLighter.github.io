<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    // Configure the recipient email address
    $to = 'mateovalente77@gmail.com'; // Replace with your email address

    // Set the email subject and body
    $subject = "Nouveau message de contact de $nom";
    $body = "Nom: $nom\n\nEmail: $email\n\nTéléphone: $telephone\n\nSujet: $sujet\n\nMessage:\n$message";

    // Set the email headers
    $headers = "From: $nom <$email>";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
} else {
    echo "Erreur: Le formulaire n'a pas été soumis.";
}
?>
