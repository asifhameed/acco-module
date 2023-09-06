# Overview

This directory contains an small command-line utility to help the account staff
determine the dates as CSV file on which they need to pay salaries to the sales staff. To use it:

* `php command.php` should export the salaries and bonus payment dates as CSV file save in downloads folder.
* `php -S localhost:8080` from root directory and then http://localhost:8080/command.php should download the CSV in browser.

Further description of the contents is as follows:

* `command.php` is supposed to be a command line script to generate the CSV file and save in downloads folder. 
* `code.php` is business logics to calculate the next 12 month salaries, bonus payments dates and convert into csv file.

# Download Directory

In this directory save all the generated CSV files.

# Assumptions

Following assumptions are made:
* The generate CSV files is through CLI and save in downloads folder.
* Also you can run this script in browser.

