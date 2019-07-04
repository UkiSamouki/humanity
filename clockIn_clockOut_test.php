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
		sleep(4);
		# Go to Shift Planning
		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('sn_timeclock'))->click();
		sleep(2);


		# Check if clock in button is visible

		 if ($driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_ci'))->isDisplayed()){

		# Click on button clock in

		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_ci'))->click();
			sleep(1);

		# Check if clock out button is visible

		 if ($driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_co'))->isDisplayed()){

		 # Check if note can be added

		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_no'))->click();
		 	sleep(1);
			$driver->getKeyboard()->sendKeys('Example note');
		 	sleep(1);
		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_no_a'))->click();
		 	sleep(3);
		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::className('icon-note'))->isDisplayed();
		 	sleep(1);

		 # Check if user can submit button for break

		 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_br_s'))->isDisplayed();
			$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_br_s'))->click();
		 	sleep(3);

		 	# Check if clock out button is NOT visible because user cant clock out first must continue shift

		 	if (!$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_co'))->isDisplayed()){

		 		# Check if button for continue shift is visible
		 		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_br_e'))->isDisplayed();
		 		# Check if icon for break is visible as simple proof we are on break
		 		$driver->findElement(Facebook\WebDriver\WebDriverBy::className('icon-break'))->isDisplayed();
		 		# Click to end break
		 		$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_br_e'))->click();
		 		sleep(3);
		 	}
		 }
		 		
		 		# Check if user can remove this clock time

		 		$driver->findElement(Facebook\WebDriver\WebDriverBy::cssSelector('center a'))->click();

		 		# Accept alert window
		 		$alert_box = $driver->switchTo()->alert();
				$alert_box->accept(); 

		 		sleep(1);

		 		# Again click on button clock in

			 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_ci'))->click();
				sleep(3);
				# Now user clock out to save and exit shift

			 	$driver->findElement(Facebook\WebDriver\WebDriverBy::id('tc_tl_co'))->click();

			 	sleep(2);

				 $driver->executeScript("alert('Timesheet save successfully')");
				 
		 	
		 }
	


		 	

