<?php

use OGBitBlt\UnitTesting\UnitTest;

require dirname(__DIR__) . "/vendor/autoload.php";

UnitTest::InitTestSuite("unit testing the unit tests!");
UnitTest::BoolEqual(true,true,"does true equal true");
UnitTest::BoolEqual(true,false,"does true equal false");
UnitTest::FloatEqual(0,0,"does 0 float equal 0 float");
UnitTest::FloatEqual(0,1,"does 0 float equal 1 float");
UnitTest::FloatEqual(1.234567890,1.234567890,"how deep does your precision test");
UnitTest::FloatEqual(2.345678901,2.345678900,"how deep does your precision grow");
UnitTest::IntEqual(0,0,"does 0 int equal 0 int");
UnitTest::IntEqual(0,1,"does 0 int equal 1 int");
UnitTest::StringEqual("hello","hello","does hello equal hello");
UnitTest::StringEqual("hello","bye","does hello equal bye");
UnitTest::ShowResults();
?>