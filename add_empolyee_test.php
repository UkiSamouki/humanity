<?php

require_once(__DIR__ . '/geckodriver');
require_once(__DIR__ . '/vendor/autoload.php');


$host = 'http://localhost:4444/wd/hub'; // this is the default
$USE_FIREFOX = false; // if false, will use chrome.

if ($USE_FIREFOX)
{
    $driver = Facebook\WebDriver\Remote\RemoteWebDriver::create(
        $host, 
        Facebook\WebDriver\Remote\DesiredCapabilities::firefox()
    );
}
else
{
    $driver = Facebook\WebDriver\Remote\RemoteWebDriver::create(
        $host, 
        Facebook\WebDriver\Remote\DesiredCapabilities::chrome()
    );
}

$driver->get("https://www.humanity.com/app/");

		// Login to hummanity

		# enter text into the email fielad
		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('email'))->click();
		sleep(1);
		$driver->getKeyboard()->sendKeys('zeravicauros@gmail.com');
		sleep(1);
		# enter text into the password fielad
		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('password'))->click();
		sleep(1);
		$driver->getKeyboard()->sendKeys('liverpul12');
		sleep(1);
		# Click the login button
		$driver->findElement(Facebook\WebDriver\WebDriverBy::name('login'))->click();
		# W8 to load the dashboard
		sleep(3);
		# Go to Shift Planning
		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('sn_schedule'))->click();
		sleep(2);

		# Click on button adding new employee
		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::className('add-employee-btn'))->click();
			sleep(1);

		# Check if pop up window is displayed and required input fields are visible , populated with right data

		 if ($driver->findElement(Facebook\WebDriver\WebDriverBy::className('hum_cnt'))->isDisplayed()){

			if ($driver->findElement(Facebook\WebDriver\WebDriverBy::id('fname_1'))->isDisplayed() && 
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('lname_1'))->isDisplayed() && 
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('fname_2'))->isDisplayed()  &&
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('lname_2'))->isDisplayed()  &&
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('positions_2-selectized'))->isDisplayed() &&
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('fname_1'))->getAttribute('value') != null &&
				$driver->findElement(Facebook\WebDriver\WebDriverBy::id('lname_1'))->getAttribute('value') != null 

			) {
			# None of fields populated

			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('add_employee_btn'))->click();
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('_status'))->isDisplayed();
			sleep(1);
			# Cheking only when fname is only populated
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('fname_2'))->click();
			sleep(1);
			$driver->getKeyboard()->sendKeys('ExampleName2');
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('add_employee_btn'))->click();
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('_status'))->isDisplayed();
			sleep(2);

			# Checking when fname and lname are populated

			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('lname_2'))->click();
			sleep(1);
			$driver->getKeyboard()->sendKeys('ExampleLastName2');
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('add_employee_btn'))->click();
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('_status'))->isDisplayed();
			sleep(2);
		
			# Checking when all required fields are populated 

			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('positions_2-selectized'))->click();
			sleep(1);
			$driver->getKeyboard()->sendKeys('ExampleRole2');
			sleep(1);
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('add_employee_btn'))->click();
			sleep(1);

			# Check if window is closed when employee is succesfully created

			if ($driver->findElement(Facebook\WebDriver\WebDriverBy::className('hum_cnt')) == null){

				sleep(2);

				 $driver->executeScript("alert('Employee is successfully created')");

			}
		}
	}