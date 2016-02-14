<?php

namespace swf\testing;

use Symfony\Component\Console\Input\ArrayInput;
use Behat\Behat\ApplicationFactory;
use swf\errors\Preconditions;

/**
 * I want to be able to run Behaviour driven tests within PHPUnit.
 * Behat was choosen as BDD tool. This class
 * helps us to run Behat scenarios within a PHPUnit test.
 *
 * @author ironhawk
 *        
 */
class BehatPHPUnitBridge {

	const RELATIVE_PATH_TO_TESTS_FOLDER = '../../tests';

	/**
	 * Creates and runs a Behat test within a PHPUnit test case
	 *
	 * @param String $specificFile
	 *        	Relative path of specific .feature file - if want to run just one
	 * @return returns Behat exit code which is 0 if all tests passed - non-zero otherwise
	 */
	public static function runBehat($specificFile = null) {
		Preconditions::checkArgument(empty($specificFile) || is_string($specificFile), "Given param '{}' should be a String as it should describe ONE file!", $specificFile);
		$factory = new ApplicationFactory();
		$behatApp = $factory->createApplication();
		$behatApp->setCatchExceptions(false);
		$behatApp->setAutoExit(false);
		
		$testsRootFolder = dirname(__FILE__) . '/' . self::RELATIVE_PATH_TO_TESTS_FOLDER;
		
		$input = [
			'--strict' => true,
			// '--stop-on-failure' => true,
			'--config' => $testsRootFolder . '/behat-config.yml'
		];
		

		if (! empty($specificFile)) {
			$input['paths'] = $testsRootFolder . '/' . $specificFile;
		}
		return $behatApp->run(new ArrayInput($input));
	}

	/**
	 * It runs the runBehat() method and also does the assertion on the return value to check if everything went fine
	 *
	 * @param String $specificFile
	 *        	see description at runBehat() method
	 */
	public static function testWithBehat($specificFile = null) {
		$behatResult = self::runBehat($specificFile);
		if (! empty($specificFile)) {
			$errMsg = "return value of Behat script running '$specificFile' indicates failure";
		} else {
			$errMsg = "return value of Behat script indicates failure";
		}
		\PHPUnit_Framework_TestCase::assertEquals(0, $behatResult, $errMsg);
	}

}