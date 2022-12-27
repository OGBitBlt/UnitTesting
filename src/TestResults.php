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
/**
 * Implements an object to store test results 
 */
class TestResults 
{
    /**
     * Keeps track of the total number of tests executed
     * @var integer
     */
    private int $testsExecuted = 0;
    /**
     * Keeps track of the total number of tests passed
     * @var integer
     */
    private int $testsPassed = 0;
    /**
     * Keeps track of the total number of tests failed 
     * @var integer
     */
    private int $testsFailed = 0;
    /**
     * Keeps track of the total number of tests skipped 
     * @var integer
     */
    private int $testsSkipped = 0;
    /**
     * Stores the name of the result set test suite 
     * @var string
     */
    private string $testSuite = "Unknown";
    /**
     * Creates a new result set object 
     * @param string $testSuite (optional) Name of the test suite
     */
    public function __construct(string $testSuite = "Unknown")
    {
        $this->testSuite = $testSuite;
        $this->testsExecuted = 0;
        $this->testsPassed = 0;
        $this->testsFailed = 0;
        $this->testsSkipped = 0;
    }
    /**
     * Gets (and optionally increments) the total number of tests executed 
     * @param boolean $incr (optional) is true, increments the count
     * @return integer The number of tests executed so far
     */
    public function TestsExecuted(bool $incr = false) : int 
    {
        if($incr == true) $this->testsExecuted++;
        return $this->testsExecuted;
    }
    /**
     * Gets (and optionally increments) the total number of tests passed
     * @param boolean $incr (optional) is true, increments the count
     * @return integer The number of tests passed so far
     */
    public function TestsPassed(bool $incr = false) : int 
    {
        if($incr == true) $this->testsPassed++;
        return $this->testsPassed;
    }
    /**
     * Gets (and optionally increments) the total number of tests failed
     * @param boolean $incr (optional) is true, increments the count
     * @return integer The number of tests failed so far
     */
    public function TestsFailed(bool $incr = false) : int 
    {
        if($incr == true) $this->testsFailed++;
        return $this->testsFailed;
    }
    /**
     * Gets (and optionally increments) the total number of tests skipped
     * @param boolean $incr (optional) is true, increments the count
     * @return integer The number of tests skipped so far
     */
    public function TestsSkipped(bool $incr = false) : int 
    {
        if($incr == true) $this->testsSkipped++;
        return $this->testsSkipped;
    }
    /**
     * Gets the test suite name of the current result set
     * @return string The name of the test suite
     */
    public function TestSuite() : string 
    {
        return $this->testSuite;
    }
}
?>