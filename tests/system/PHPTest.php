<?php

/**
 * @group System
 */

class PHPTest extends CIUnit_TestCase
{

	public function testPhpVersion()
	{
		$this->assertTrue(phpversion() > 5.2);
	}

}
