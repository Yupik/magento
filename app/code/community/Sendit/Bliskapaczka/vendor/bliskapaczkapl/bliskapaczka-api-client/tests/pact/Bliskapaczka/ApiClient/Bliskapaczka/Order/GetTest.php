<?php

namespace Bliskapaczka\ApiClient\Bliskapaczka\Order;

use PHPUnit\Framework\TestCase;

class GetTest extends TestCase
{
    protected function setUp()
    {
        if (getenv('PACT_MOCK_SERVICE_URL')) {
            $this->host = 'madkom__pact-mock-service:1234';
        } else {
            $this->host = 'localhost:1234';
        }

        $this->orderData = [
            "senderFirstName" => "string",
            "senderLastName" => "string",
            "senderPhoneNumber" => "606555433",
            "senderEmail" => "bob@example.com",
            "senderStreet" => "string",
            "senderBuildingNumber" => "string",
            "senderFlatNumber" => "string",
            "senderPostCode" => "54-130",
            "senderCity" => "string",
            "receiverFirstName" => "string",
            "receiverLastName" => "string",
            "receiverPhoneNumber" => "600555432",
            "receiverEmail" => "eva@example.com",
            "operatorName" => "INPOST",
            "destinationCode" => "KRA010",
            "postingCode" => "KRA011",
            "codValue" => 111.1,
            "insuranceValue" => 0,
            "additionalInformation" => "string",
            "parcel" => [
                "dimensions" => [
                    "height" => 20,
                    "length" => 20,
                    "width" => 20,
                    "weight" => 20
                ]
            ]
        ];

        $this->orderId = '000000001P-000000002';

        $this->deleteInteractions();
        $this->setInteraction();
    }

    public function testCreateOrder()
    {
        $apiClient = new \Bliskapaczka\ApiClient\Bliskapaczka\Order('test-test-test-test');
        $apiClient->setApiUrl($this->host);
        $apiClient->setOrderId($this->orderId);

        $response = json_decode($apiClient->get());

        $this->assertEquals($this->orderData['senderPhoneNumber'], $response->senderPhoneNumber);
        $this->assertEquals($this->orderData['senderEmail'], $response->senderEmail);
        $this->assertEquals($this->orderData['senderPostCode'], $response->senderPostCode);
        $this->assertEquals($this->orderData['receiverPhoneNumber'], $response->receiverPhoneNumber);
        $this->assertEquals($this->orderData['receiverEmail'], $response->receiverEmail);

        $this->assertEquals($this->orderData['codValue'], $response->codValue);

        $this->assertEquals("PROCESSING", $response->status);

        $this->assertTrue(isset($response->parcel));
        $this->assertTrue(isset($response->parcel->dimensions));
        $this->assertEquals('20', $response->parcel->dimensions->height);
        $this->assertEquals('20', $response->parcel->dimensions->length);
        $this->assertEquals('20', $response->parcel->dimensions->width);
        $this->assertEquals('20', $response->parcel->dimensions->weight);

        $this->expectOutputString('Deleted interactionsSet interactionsInteractions matched', $this->verification());
    }

    /**
     * Delete interactions
     */
    protected function deleteInteractions()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }

    protected function setInteraction()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        $headers[] = 'Content-Type: application/json';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        $options[CURLOPT_POST] = true;
        $options[CURLOPT_POSTFIELDS] = '{
  "description": "Get order data",
  "provider_state": "Order recived correctly",
  "request": {
    "method": "get",
    "path": "/v1/order/' . $this->orderId . '"
  },
  "response": {
    "status": 200,
    "headers": {
      "Content-Type": "application/json"
    },
    "body": {
      "number": "string",
      "senderFirstName": "string",
      "senderLastName": "string",
      "senderPhoneNumber": "' . $this->orderData['senderPhoneNumber'] . '",
      "senderEmail": "' . $this->orderData['senderEmail'] . '",
      "senderStreet": "string",
      "senderBuildingNumber": "string",
      "senderFlatNumber": "string",
      "senderPostCode": "' . $this->orderData['senderPostCode'] . '",
      "senderCity": "string",
      "receiverFirstName": "string",
      "receiverLastName": "string",
      "receiverPhoneNumber": "' . $this->orderData['receiverPhoneNumber'] . '",
      "receiverEmail": "' . $this->orderData['receiverEmail'] . '",
      "operatorName": "INPOST",
      "destinationCode": "KRA010",
      "postingCode": "KRA011",
      "codValue": "' . $this->orderData['codValue'] . '",
      "insuranceValue": 0,
      "additionalInformation": "string",
      "status": "PROCESSING",
      "parcel":{
        "dimensions": {
          "height": 20,
          "length": 20,
          "width": 20,
          "weight": 20
        }
      },
      "orderItems": [
        {
          "pricelistItemType": "SHIPMENT",
          "price": {
            "net": 0,
            "vat": 0,
            "gross": 0
          }
        }
      ],
      "price": {
        "net": 0,
        "vat": 0,
        "gross": 0
      }
    }
  }
}';

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }

    /**
     * Delete interactions
     */
    protected function verification()
    {
        $curl = curl_init();

        // build Authorization header
        $headers[] = 'X-Pact-Mock-Service: true';
        
        // set options
        $options[CURLOPT_URL] = $this->host . '/interactions/verification';
        $options[CURLOPT_TIMEOUT] = 60;
        $options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
        $options[CURLOPT_HTTPHEADER] = $headers;

        curl_setopt_array($curl, $options);
        curl_exec($curl);
    }
}
