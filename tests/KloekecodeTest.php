<?php

class KloekecodeTest extends TestCase {

    // URL: [GET] localhost/api/kloekecode
    public function testAll()
    {
        $response = $this->call('GET', '/api/kloekecode');
        $array = json_decode($response->getContent(), true);

        $this->assertNotEmpty($array);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(sizeof($array) > 0);

        $dataArray = $array['data'][0][0];

        $this->assertArrayHasKey('id', $dataArray);
        $this->assertArrayHasKey('Kloekecode', $dataArray);
        $this->assertArrayHasKey('Plaats', $dataArray);
        $this->assertArrayHasKey('Gemeente', $dataArray);
        $this->assertArrayHasKey('Provincie', $dataArray);
    }

    // URL: [GET]  /localhost/api/kloekecode/{kloekecode}
    public function testSpecific()
    {
        $response = $this->call('GET', 'api/kloekecode/1');
        $array = json_decode($response->getContent(), true);

        $this->assertNotEmpty($array);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(sizeof($array) > 0);

        $dataArray = $array['data'][0][0];

        $this->assertArrayHasKey('id', $dataArray);
        $this->assertArrayHasKey('Kloekecode', $dataArray);
        $this->assertArrayHasKey('Plaats', $dataArray);
        $this->assertArrayHasKey('Gemeente', $dataArray);
        $this->assertArrayHasKey('Provincie', $dataArray);
    }

    // URL: [POST]
    public function testApiFormValidation()
    {
        // Values are empty, because else would the test not work.
        $formData = [
            '_token'     => csrf_token(),
            'kloekecode' => '',
            'plaats'     => '',
            'gemeente'   => '',
            'provincie'  => '',
        ];

        $url = $this->call('POST', '/api/kloekecode', $formData);

        $this->assertSessionHasErrors(['kloekecode', 'plaats', 'gemeente', 'provincie']);
        $this->assertTrue($url->isRedirection());
    }

    // URL:
    public function testApiDelete()
    {

    }
}