<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @namespace
 */
namespace ZendTest\Navigation;
use Zend\Navigation\Page;

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Zend_NavigationTest::main');
}


/**
 * Zend_Navigation
 */

/**
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Navigation
 */
class NavigationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var     Zend_Navigation
     */
    private $_navigation;
    
    protected function setUp()
    {
        parent::setUp();
        $this->_navigation = new \Zend\Navigation\Navigation();
    }
    
    protected function tearDown()
    {
        $this->_navigation = null;
        parent::tearDown();
    }
    /**
     * Runs the test methods of this class.
     *
     * @return void
     */
    public static function main()
    {
        $suite  = new \PHPUnit_Framework_TestSuite("Zend_NavigationTest");
        $result = \PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Testing that navigation order is done correctly
     * 
     * @group   ZF-8337
     * @group   ZF-8313
     */
    public function testNavigationArraySortsCorrectly()
    {
        $page1 = new Page\Uri(array('uri' => 'page1'));
        $page2 = new Page\Uri(array('uri' => 'page2'));
        $page3 = new Page\Uri(array('uri' => 'page3'));

        $this->_navigation->setPages(array($page1, $page2, $page3));

        $page1->setOrder(1);
        $page3->setOrder(0);
        $page2->setOrder(2);
        
        $pages = $this->_navigation->toArray();
        $this->assertSame(3, count($pages));
        $this->assertEquals('page3', $pages[0]['uri']);
        $this->assertEquals('page1', $pages[1]['uri']);
        $this->assertEquals('page2', $pages[2]['uri']);
    }
    
}