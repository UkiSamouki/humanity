# humanity
Automated selenium testing with php for parts of Staff  and Time clock module

Using OS: Ubuntu 18.04 


In root folder


Prerequests 

Download the latest selenium standalone server

wget https://selenium-release.storage.googleapis.com/3.141/selenium-server-standalone-3.141.59.jar


For the next step, You may require installing some php extensions

sudo apt-get install php7.2-zip php7.2-curl -y


You need composer for this http://blog.programster.org/ubuntu-install-composer .

You may need to install Java if you haven't got it already http://blog.programster.org/ubuntu-16-04-install-java


Get the latest chrome driver from

wget https://chromedriver.storage.googleapis.com/2.34/chromedriver_linux64.zip

unzip chromedriver_linux64.zip

sudo mv -i chromedriver /usr/bin/.


Get the gecko driver for Firefox
wget https://github.com/mozilla/geckodriver/releases/download/v0.19.1/geckodriver-v0.19.1-linux64.tar.gz
tar --extract --gzip --file gecko*
sudo mv -i geckodriver /usr/bin/.


Run command 

composer install 

for necessary dependencies. (one package facebook/webdriver)




Open terminal in root folder

Run the selenium server with command

java -jar selenium-server-standalone-3.141.59.jar



Open terminal in root folder

Run one of two tests with command 

php add_employee_test.php  first test

php clockIn_clockOut_test.php  second test
