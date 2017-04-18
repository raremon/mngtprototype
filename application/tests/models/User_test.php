<?php

class User_model_test extends TestCase
{
	public function setUp() {
        $this->resetInstance();
		
        $this->CI->load->model('User');
        $this->obj = $this->CI->User;
    }
	
	public function test_validate() {
		
		$_POST['username'] = 'admin';
		$_POST['password'] = 'admin';
		
		$actual = $this->obj->validate();
        $expected = 'ERR_NONE';
        $this->assertEquals($expected, $actual);
	}
	
}
