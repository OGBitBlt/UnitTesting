# UnitTesting
lightweight PHP unit testing framework
## Installation
Use [composer](https://getcomposer.org/)
```
composer require ogbitblt/unit-testing
```
## Usage
```PHP
// initialize a new test suite
UnitTest::InitTestSuite("MyTestSuite");

// check if bool, float, int, or string values are equal
// if they are the test passes, and fails otherwise
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

// show a test results summary
UnitTest::ShowResults();
```
## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)

