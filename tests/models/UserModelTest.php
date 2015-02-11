<?php

/**
 * @group Model
 */

class UserModelTest extends CIUnit_TestCase
{
	protected $tables = array(
        'user' => 'user',
		'course' => 'course',
        'user_course' => 'user_course',
        'exam_template' => 'exam_template'
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
		$this->CI->load->model('exam');
		$this->_pcm = $this->CI->exam;
	}

	public function tearDown()
	{
		parent::tearDown();
	}

	// TESTS ------------------------------------------------------------------

	public function test_Exam_exist()
	{
		// existing user, right password
		$this->assertFalse($this->_pcm->exam_exist(1));
	}

	// ------------------------------------------------------------------------

}
