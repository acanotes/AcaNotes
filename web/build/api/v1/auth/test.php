<?php
require($_SERVER["DOCUMENT_ROOT"] . '/../vendor/autoload.php');
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'] . '/../');
$dotenv->load();

$email = new \SendGrid\Mail\Mail();
$email->setFrom("service@acanotes.com", "Aca the Alpaca");
$email->setSubject("AcaNotes Registration Verification");
$email->addTo("acanotes.alpaca@gmail.com", "You!");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
 ?>
