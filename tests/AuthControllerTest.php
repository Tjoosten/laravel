<?php

class AuthControllerTest extends TestCase {

	public function testBasicExample() {
		$response = $this->call('GET', '/');
		$this->assertEquals(200, $response->getStatusCode());
	}

}
