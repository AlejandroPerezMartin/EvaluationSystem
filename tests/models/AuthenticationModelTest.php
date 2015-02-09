<?php

/**
 * @group Model
 */

class AuthenticationModelTest extends CIUnit_TestCase
{
	protected $tables = array(
		'user' => 'user'
	);

	private $_pcm;

	public function __construct($name = NULL, array $data = array(), $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
	}

	public function setUp()
	{
		parent::setUp();
		$this->CI->load->model('authentication');
		$this->_pcm = $this->CI->authentication;
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	// TESTS ------------------------------------------------------------------

	public function test_Process_login()
	{
		// existing user, right password
		$this->assertTrue($this->_pcm->process_login('user@email.com', 'aleta'));
		// existing user, empty password
		$this->assertFalse($this->_pcm->process_login('user@email.com', ''));
		// existing user, wrong password
		$this->assertFalse($this->_pcm->process_login('user@email.com', '000000'));
		// non existing user
		$this->assertFalse($this->_pcm->process_login('dont@exist.com', '123456'));
		// invalid email format
		$this->assertFalse($this->_pcm->process_login('', '123456'));
		$this->assertFalse($this->_pcm->process_login('1223', '123456'));
		$this->assertFalse($this->_pcm->process_login('notanemail', '123456'));
		$this->assertFalse($this->_pcm->process_login('notanemail@', '123456'));
		$this->assertFalse($this->_pcm->process_login('notanemail@mail', '123456'));
		$this->assertFalse($this->_pcm->process_login('notanemail@mail...com', '123456'));
	}

	// ------------------------------------------------------------------------

}
