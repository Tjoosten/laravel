<?php

class AuthControllerTest extends TestCase {

	public function testBaseUrl() {
		$response = $this->call('GET', '/');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testBlock() {

	}

	public function testUndoBlock() {

	}

	public function testSetToUser() {
		$response = $this->call('GET', '');
		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testSetToAdministrator() {
		$response = $this->call('GET', '/');
		$this->assertEquals(200, $response->getStatusCode())
	}

}
