<?php
require '../config/function.php';
require_once('../config/Paymongo/vendor/autoload.php');

if (isset($_GET['id'])) {
    $id = validate($_GET['id']); // Sanitize input

    if (ctype_alnum($id)) { // Validate as alphanumeric
        $client = new \GuzzleHttp\Client();

        try {
            // Make the API request
            $response = $client->request('GET', "https://api.paymongo.com/v1/links?reference_number={$id}", [
                'headers' => [
                    'accept' => 'application/json',
                    'authorization' => 'Basic c2tfdGVzdF8yR01aZG9LYjg2dDVoV2lQOW01czNlN246',
                ],
            ]);

            // Decode the JSON response
            $responseData = json_decode($response->getBody(), true);

            // Check if the data array contains the reference_number
            if (!empty($responseData['data'])) {
                foreach ($responseData['data'] as $link) {
                    if ($link['attributes']['reference_number'] === $id) {
                        $checkoutUrl = $link['attributes']['checkout_url'];
                        $status = $link['attributes']['status'];

                        if ($status === "paid") {
                            // Update query
                            $stmt = $conn->prepare("UPDATE orders SET OrderStatus = ? WHERE TrackingNo = ?");
                            $newStatus = "Completed";
                            $stmt->bind_param('ss', $newStatus, $id);

                            if ($stmt->execute()) {
                                error_log("Order status updated to 'Complete'.");
                            } else {
                                echo "Failed to update order status: " . $stmt->error;
                            }

                            $stmt->close();
                            $conn->close();
?>
                            <h4>Payment is already complete. <br><br> Page closing in 5 seconds.</h4>
<?php
                            echo '<script> setTimeout(function() { window.close(); }, 5000); </script>';

                            exit;
                        } else {
                            // Redirect to the checkout URL
                            header("Location: $checkoutUrl");
                        }
                    }
                }
            }

            // If the reference number is not found
            echo "Reference number not found.";
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                echo "API Error: " . $e->getResponse()->getBody();
            } else {
                echo "Request Error: " . $e->getMessage();
            }
        } catch (Exception $e) {
            echo "General Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid ID format. Only alphanumeric values are allowed.";
    }
} else {
    echo "No ID parameter provided.";
}
