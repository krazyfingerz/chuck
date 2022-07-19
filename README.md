# Joke2Email

Good day and thank you for having a look through my code.
1) The react frontend is named <em>joke2email</em>, simply use npm start
2) The PHP code is in <em>chuck_norris</em>, For the frontend admin panel (to add emails), please login with **username: patrick , password: asd**
3) The database is mysql, and there is an exported copy of the mysql database from XAMPP, however I've also provided a copy of the database file itself aptly named "database" and should be renamed to <em>"chuck_norris</em> before copying it into C:\xampp\mysql\data
<br><br><br>
The PHP (chuck_norris) was done with CodeIgniter, let's look at the models, views and controllers folders.
- **models folder** points to the table name to be referred to in the mysql database.
  <br><br>
  **controllers folder...<br>**
- access.php in controllers folder refers to the mysql table to authenticate the user and see if they're the admin
- if not logged in , it shows the login panel that you'd see upon startup of the project
- if wrong credentials, it'll say so based on the error templates available
- if correct credentials, it logs the user into the admin panel where you can add, edit and delete emails in the database.<br>
- dashboard.php controls the admin panel for adding emails upon successful login, actual panel itself is in the views folder.
- user.php separates the email ito domain name and email name for querying and sorting later on
- api.php contains the template for the email to be sent (alog with the joke itself)
  <br><br>
  **views** contains the views generated on the PHP frontend..."access" folder has the frontend for admin to login and "admin" folder has the frontend for an admin who has successfully logged in to view and edit emails.
  
