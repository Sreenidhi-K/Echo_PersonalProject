# ECHO
## About
It is a FEEDBACK portal, with features like
  * Login/Signup option
  * Templates for creating the feedback form
  * Anonymous submission of feedback
  * Analysis of the received feedback
## Database and Tables
* Create a database "feedback"
* Create a table named "userlist" in it, as below

`CREATE TABLE userlist ( id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(1000), email VARCHAR(1000), username VARCHAR(1000), pass VARCHAR(10000) );  `
* Create a table named "projectdata" as well, as below

`CREATE TABLE projectdata ( iden INT PRIMARY KEY AUTO_INCREMENT, code INT, title VARCHAR(1000), admin VARCHAR(1000), status VARCHAR(100), formdata VARCHAR(10000), infodata VARCHAR(1000) );  `
