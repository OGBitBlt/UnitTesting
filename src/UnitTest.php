<?php
/**
 * Copyright (c) Anthony Davis <ogbitblt@pm.me>
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * This is a minimal unit-testing framework for PHP projects.
 * 
 * @author Anthony Davis - <ogbitblt@pm.me>
 * @package ogbitblt-unittesting
 */
namespace OGBitBlt\UnitTesting;

use Exception;
use OGBitBlt\Output\OutputFactory;
use OGBitBlt\Output\Console;
use OGBitBlt\Output\TextFile;

/**
 * Provides test functions, all of which are static functions
 */
class UnitTest
{
    /**
     * Stores the test results, null if we have not been initialized.
     *
     * @var TestResults|null
     */
    private static ?TestResults $results = null;
    private static ?Console $console = null;
    private static ?TextFile $outfile = null;
    /**
     * Initializes a new UnitTest Object
     *
     * @param string $test_suite The name of this test suite 
     * @return void
     */
    public static function InitTestSuite(string $test_suite)
    {
        self::$results = new TestResults($test_suite);
        self::$console = OutputFactory::Create(Console::class);
        $fName = sprintf("test-results_%s-%d.txt",$test_suite,time());
        self::$outfile = OutputFactory::Create(TextFile::class,['file'=>$fName]);
    }
    /**
     * prints the test description to terminal
     * @param string $desc description of the unit test being executed
     * @return void
     */
    private static function reportTestTitle(string $desc)
    {
        if(self::$results == null) 
		    throw new Exception("class has not been initialized");
        self::$results->TestsExecuted(true);
        self::$console->Write("%BLUE([TEST]) ");
        self::$outfile->Write("[TEST] ");
	    $fmt = "%d. %s ";
        $m1 = str_pad(
            sprintf(
                $fmt, 
                self::$results->TestsExecuted(), 
                $desc
            ),
            65,
            " "
	    );
        self::$outfile->Write($m1);
        self::$console->Write($m1);
    }
    /**
     * prints a formatted message to the terminal that a test failed
     * @param mixed $v1 expected result
     * @param mixed $v2 actual result 
     * @return void
     */
    private static function reportTestFail($v1,$v2)
    {
        self::$results->TestsFailed(true);
        self::$console->Write("\t%RED(*** FAIL! ***) ");
        self::$outfile->Write("\t*** FAIL! *** ");
	    $fmt = "expected: %s but got: %s";
        $msg = sprintf($fmt,$v1,$v2);
        self::$console->WriteLn($msg);
        self::$outfile->WriteLn($msg);
        return FALSE;
    }
    /**
     * prints a formatted message to the terminal that a test passed 
     * @return void
     */
    private static function reportTestPass()
    {
        self::$results->TestsPassed(true);
        self::$console->WriteLn("\t%GREEN(*** PASS ***)");
        self::$outfile->WriteLn("\t*** PASS ***");
        return TRUE;
    }
    /**
     * Check that an expected float return value is correct 
     * @param float $v1 expected result
     * @param float $v2 actual result 
     * @param string|null $desc description of the unit test 
     * @return boolean true if passed, false otherwise 
     */
    public static function FloatEqual(
		float $v1, 
		float $v2, 
		string $desc = null
					) : bool 
    {
        $result = false;
        self::reportTestTitle($desc);
        $s1 = sprintf("%0.4f",$v1);
        $s2 = sprintf("%0.4f",$v2);
        if($s1 !== $s2) {
            $result = self::reportTestFail($s1,$s2);
        } else  {
            $result = self::reportTestPass();
        }
        return $result;
    }
    /**
     * Check that an expected int return value is correct 
     * @param int $v1 expected result
     * @param int $v2 actual result 
     * @param string|null $desc description of the unit test 
     * @return boolean true if passed, false otherwise 
     */
    public static function IntEqual(
			int $v1, 
			int $v2, 
			string $desc = null
					) : bool 
    {
        self::reportTestTitle($desc);
        $result = false;
        if($v1 !== $v2) {
            $result = self::reportTestFail($v1,$v2);
        } else  {
            $result = self::reportTestPass();
        }
        return $result;
    }
    /**
     * Check that an expected bool return value is correct 
     *
     * @param bool $v1 expected result
     * @param bool $v2 actual result 
     * @param string|null $desc description of the unit test 
     * @return boolean true if passed, false otherwise 
     */
    public static function BoolEqual(
			bool $v1, 
			bool $v2, 
			string $desc = null
					) : bool 
    {
        self::reportTestTitle($desc);
        $result = false;
        if($v1 !== $v2) {
            $result = self::reportTestFail($v1,$v2);
        } else  {
            $result = self::reportTestPass();
        }
        return $result;
    }
    /**
     * Check that an expected string return value is correct 
     *
     * @param string $v1 expected result
     * @param string $v2 actual result 
     * @param string|null $desc description of the unit test 
     * @return boolean true if passed, false otherwise 
     */
    public static function StringEqual(
			string $v1, 
			string $v2, 
			string $desc = null
					) : bool 
    {
        self::reportTestTitle($desc);
        $result = false;
        if($v1 !== $v2) {
            $result =  self::reportTestFail($v1,$v2);
        } else  {
            $result = self::reportTestPass();
        }
        return $result;
    }
    /**
     * Displays a formatted summary of test results.
     *
     * @return void
     */
    public static function ShowResults() 
    {
        if(self::$results == null) 
		    throw new Exception("unintialized");
        self::$console->DrawLn("*",76);
        $msg = "\tTest Results\n";
        self::$console->WriteLn($msg);
        self::$outfile->WriteLn($msg);
	    $f = "\t\t%s:\t%s\n";
        $msg = sprintf($f,"Suite","\"" . self::$results->TestSuite() . "\"");
        self::$console->WriteLn($msg);
        self::$outfile->WriteLn($msg);
        $msg = sprintf($f,"Tests",self::$results->TestsExecuted());
        self::$console->WriteLn($msg);
        self::$outfile->WriteLn($msg);
	    $f = "\t\tPassed:\t%d";
        $msg = sprintf($f,self::$results->TestsPassed());
        self::$console->WriteLn("%GREEN(".$msg.")");
        self::$outfile->WriteLn($msg);
	    $f = "\t\tFailed:\t%d";
        $msg = sprintf($f, self::$results->TestsFailed());
        self::$console->WriteLn("%RED(".$msg.")");
        self::$outfile->WriteLn($msg);
        self::$console->DrawLn("*",76);
    }
}
?>
