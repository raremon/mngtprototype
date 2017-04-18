<?php

class User_model_test extends TestCase
{
	public function setUp() {
        $this->resetInstance();
		
        $this->CI->load->model('User');
        $this->obj = $this->CI->User;
    }
	
	public function testValidateSuccessLogin() {
		
		$_POST['username'] = 'admin';
		$_POST['password'] = 'admin';
		
		$actual = $this->obj->validate();
        $expected = 'ERR_NONE';
        $this->assertEquals($expected, $actual);
	}
	
	public function testValidateNoEntry() {
		
		$_POST['username'] = '';
		$_POST['password'] = '';
		
		$actual = $this->obj->validate();
        $expected = 'ERR_INVALID_USERNAME';
        $this->assertEquals($expected, $actual);
	}
	
	public function testValidateIncorrectUsername() {
		
		$_POST['username'] = 'asdf';
		$_POST['password'] = 'admin';
		
		$actual = $this->obj->validate();
        $expected = 'ERR_INVALID_USERNAME';
        $this->assertEquals($expected, $actual);
	}
	
	public function testValidateIncorrectPassword() {
		$_POST['username'] = 'admin';
		$_POST['password'] = 'qasdf';
		
		$actual = $this->obj->validate();
        $expected = 'ERR_INVALID_PASSWORD';
        $this->assertEquals($expected, $actual);
	}
}
