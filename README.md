ICS 325 Fall 2016 - Assignment 4
=================

Purpose
-------
* Learn how to use github.com and GitKraken.
* Learn how to generate and process forms using PHP as shown in Chapter 7 of the text.
* Learn how to use the built-in PHP web server with PhpStorm.

Collaboration
-------------
You can talk about the assignment with your peers in the class.  However, you should perform the work yourself and turn in a copy of your own work.

Prerequisites
-------------
You need to [sign up for a github.com account](https://github.com/join) if you don't already have one.  Your github.com account doesn't need to use your @metrostate.edu e-mail address.

You need to install [GitKraken](https://www.gitkraken.com/download), and log into it with your github.com account.

Use git to clone your private assignment 4 repo to your computer.  Then in PhpStorm, use `File->Open Directory` and select your local repo.

You will be using the web server built into PHP.  See the instructions below for how to set that up.

Resources and Examples
----------------------
See the D2L assignment for a link to the notes explaining how the code given to you in this repository works.

Instructions
------------
#### Instructions to set up the code to run
First you need to clone your git repository to your computer.  Open GitKraken and make sure you are logged into your github.com account.  Next go to `File->Clone Repo`.  Select the `GitHub.com` icon.  A list of your repositories in github.com should pop up.  Select the one for assignment 4.  If you want, change `Where to clone to` by clicking browser and selecting a folder for your git repo to be cloned into.  Finally, hit the `Clone the repo!` button.  Your repo should now clone to your computer.

Next you need to set up PhpStorm.  We will be using the built-in PHP CGI server for this assignment.  To do so, first make sure you have the git repo open in PhpStorm by using the Open Directory menu item under File in PhpStorm (`File->Open Directory`).  Next go to `Run->Edit Configurations...` Click the green `+` to create a new configuration.  Select `PHP Built-in Web Server`.  Change the name to `Assignment 4`.  Leave host as `localhost`.  Set the port to `8080`.  Set the `Document root` to your git repo directory by clicking the `...` button next to the field and using the file chooser to select it.  If there is a red ! icon near the bottom right of the window, click the `Fix` button and specify your PHP interpreter.  Once done, click `Ok` to exit the Edit Configurations window.  Next hit the green run button to start the PHP CGI web server.  Then go to your web browser and enter this url [http://localhost:8080/complete.php](http://localhost:8080/complete.php).  You should see the menu selection form from chapter 7.

#### Assignment Instructions
You need to make various changes to the program.  Each change and the associated point value is listed below in the grading section.

#### How to Turn in Assignment 4
You need to clone your private git repo for assignment 4 to your computer and make the required changes.  Once you are done, commit your modifications to your master branch and push them to GitHub.  Then go to D2L and turn in the assignment to let me know I can go look at your repo and grade you.  D2L requires you to upload a file, so place a link to your git repo in a text file and upload it to D2L.  You can also put the link in the assignment comments and upload an empty file to D2L.  Either way is fine, but having the link makes it much easier for me to find your repo and grade it quickly.

Grading
-------
Points|Requirement
------|-----------
1 | Change the default size to: Large
2 | Add a new size option: XLarge
1 | Add a new sweet: Ice Cream
1 | Add a new main dish: Cheese Pizza
1 | Add a reset button to the form.
4 | Add a new menu option: Drink<br/>The options should be: Coke, Diet Coke, Sprite, Milk, Water
3 | Add a text field for an e-mail address.  Validate it using filter_input.
2 | Change the output to read:<br />Thank you for your order, NAME at EMAIL.<br />You requested the large size of SWEET, MAIN_DISH_0, and MAIN_DISH_1.<br />You would like a DRINK to drink.<br />You do want delivery.<br />Your comments: Comment Text
2 | Turn in the assignment via github.
**17**|**Total**
