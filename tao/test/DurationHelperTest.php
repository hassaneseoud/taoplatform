<?php
/*  
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * Copyright (c) 2013-2014 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 * 
 */
?>
<?php



require_once dirname(__FILE__) . '/TaoPhpUnitTestRunner.php';

/**
 * PHPUnit test of the {@link tao_helpers_Duration} helper
 * @package tao
 
 */
class DurationHelperTest extends TaoPhpUnitTestRunner {
    
    /**
     * Data provider for the testTimetoDuration method
     * @return array[] the parameters
     */
    public function timetoDurationProvider(){
        return array(
            array('00:00:00', 'PT0H0M0S'),
            array('01:34:28', 'PT1H34M28S'),
            array('', 'PT0S'),
            array(null, 'PT0S')
        );
    }
    
    /**
     * Test {@link tao_helpers_Duration::timetoDuration}
     * @dataProvider timetoDurationProvider
     * @param string $time the parameter of timetoDuration
     * @param string $expected the expected result
     */
    public function testTimetoDuration($time, $expected){
        $result = tao_helpers_Duration::timetoDuration($time);
        $this->assertEquals($expected, $result);
    }
    
    
    /**
     * Data provider for the testIntervalToTime method
     * @return array[] the parameters
     */
    public function intervalToTimeProvider(){
        return array(
            array(new DateInterval('PT0H0M0S'), '00:00:00'),
            array(new DateInterval('PT1H34M28S'), '01:34:28')
        );
    }
    
    /**
     * Test {@link tao_helpers_Duration::intervalToTime}
     * @dataProvider intervalToTimeProvider
     * @param string $time the parameter of intervalToTime
     * @param string $expected the expected result
     */
    public function testIntervalToTime($interval, $expected){
        $result = tao_helpers_Duration::intervalToTime($interval);
        $this->assertEquals($expected, $result);
    }
        
    
    /**
     * Data provider for the testDurationToTime method
     * @return array[] the parameters
     */
    public function durationToTimeProvider(){
        return array(
            array('PT0H0M0S', '00:00:00'),
            array('PT1H34M28S', '01:34:28'),
            array('', null),
            array(null, null)
        );
    }
    
    /**
     * Test {@link tao_helpers_Duration::durationToTime}
     * @dataProvider durationToTimeProvider
     * @param string $duration the parameter of durationToTime
     * @param string $expected the expected result
     */
    public function testDurationToTime($duration, $expected){
        $result = tao_helpers_Duration::durationToTime($duration);
        $this->assertEquals($expected, $result);
    }
}
?>
