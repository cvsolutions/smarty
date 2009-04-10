<?php
/**
* Smarty PHPunit tests assign_global methode  and {assign_global} tag
* 
* @package PHPunit
* @author Uwe Tews 
*/

require_once SMARTY_DIR . 'Smarty.class.php';

/**
* class for assign_global methode  and {assign_global} tag tests
*/
class AssignGlobalTests extends PHPUnit_Framework_TestCase {

    public function setUp()
    {
        $this->smarty = new Smarty();
        $this->smarty->error_reporting = E_ALL;
        $this->old_error_level = error_reporting();
    } 

    public function tearDown()
    {
        error_reporting($this->old_error_level);
        unset($this->smarty);
        Smarty::$template_objects = null;
    } 

    /**
    * test  assign_global and get_global
    */
    public function testAssignGlobalGetGlobal()
    {
            $this->smarty->assign_global('foo','bar');
		$this->assertEquals('bar', $this->smarty->get_global('foo'));
    } 
    /**
    * test  assign_global and get_global on arrays
    */
    public function testAssignGlobalGetGlobalArray()
    {
            $this->smarty->assign_global('foo',array('foo'=>'bar','foo2'=>'bar2'));
            $a1 = array('foo'=>array('foo'=>'bar','foo2'=>'bar2'));
            $a2 = $this->smarty->get_global();
            $diff = array_diff($a1,$a2);
            $cmp = empty($diff);
		$this->assertTrue($cmp);
    } 
    /**
    * test assign_global tag
    */
    public function testAssignGlobalTag()
    {
            $this->smarty->assign_global('foo','bar');
		$this->assertEquals('bar', $this->smarty->fetch('string:{$foo}'));
		$this->assertEquals('buh', $this->smarty->fetch('string:{assign var=foo value=buh scope=global}{$foo}'));
		$this->assertEquals('buh', $this->smarty->fetch('string:{$foo}'));
		$this->assertEquals('buh', $this->smarty->get_global('foo'));
    } 
    /**
    * test global var array element tag
    */
    public function testGlobalVarArrayTag()
    {
            $this->smarty->assign_global('foo',array('foo'=>'bar','foo2'=>'bar2'));
		$this->assertEquals('bar2', $this->smarty->fetch('string:{$foo.foo2}'));
		$this->assertEquals('bar', $this->smarty->fetch('string:{$foo.foo}'));
    } 
} 
  ?>
