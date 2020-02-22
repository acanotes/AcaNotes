<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);
require_once('../../vendor/autoload.php');
if (isset($_POST['stripeToken']) && isset($_POST['amount'])){
  try {
    // KEYS REDACTED: DON'T PUT PRIVATE KEYS ON PUBLIC FILES. KEYS WILL BE ROLLED ASAP.
    $liveKey = '';
    $testKey = '';
    
    \Stripe\Stripe::setApiKey($testKey);
    // Token is created using Checkout or Elements!
    // Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];
    $amount = $_POST['amount']; // in CENTS
    $charge = \Stripe\Charge::create([
        'amount' => $amount,
        'currency' => 'usd',
        'description' => 'Example charge',
        'source' => $token,
    ]);
    //success?!

    http_response_code(200);
    }
    catch(\Stripe\Error\Card $e) {
    // Since it's a decline, \Stripe\Error\Card will be caught
    $body = $e->getJsonBody();
    $err  = $body['error'];

    print('Status is:' . $e->getHttpStatus() . "\n");
    print('Type is:' . $err['type'] . "\n");
    print('Code is:' . $err['code'] . "\n");
    // param is '' in this case
    print('Param is:' . $err['param'] . "\n");
    print('Message is:' . $err['message'] . "\n");
      http_response_code(400);
  } catch (\Stripe\Error\RateLimit $e) {
    // Too many requests made to the API too quickly
      http_response_code(429);
  } catch (\Stripe\Error\InvalidRequest $e) {
    // Invalid parameters were supplied to Stripe's API
      http_response_code(400);
  } catch (\Stripe\Error\Authentication $e) {
    // Authentication with Stripe's API failed
    // (maybe you changed API keys recently)
      http_response_code(402);
  } catch (\Stripe\Error\ApiConnection $e) {
    // Network communication with Stripe failed
      http_response_code(402);
  } catch (\Stripe\Error\Base $e) {
    // Display a very generic error to the user, and maybe send
    // yourself an email
      http_response_code(400);
  } catch (Exception $e) {
    // Something else happened, completely unrelated to Stripe
      http_response_code(400);
  }
}
else {
  http_response_code(400);
}
?>
