# skills
--Getting started--

you will need to enable PHP on your machine if you have not already.
First, make a backup of the default Apache configuration. This is good practice and serves as a comparison against future versions of Mac OS X.

cd /etc/apache2/
cp httpd.conf httpd.conf.sierra
Now edit the Apache configuration. Feel free to use TextEdit if you are not familiar with vi.

vi httpd.conf
Uncomment the following line (remove #):

LoadModule php5_module libexec/apache2/libphp5.so
Restart Apache:

apachectl restart
You can verify PHP is enabled by creating a phpinfo() page in your DocumentRoot.

The default DocumentRoot for Mac OS X Sierra is /Library/WebServer/Documents. You can verify this from your Apache configuration.

grep DocumentRoot httpd.conf
Now create the phpinfo() page in your DocumentRoot:

echo '<?php phpinfo();' > /Library/WebServer/Documents/phpinfo.php
Verify PHP by accessing http://localhost/phpinfo.php


you will need to create a connect.php file with queries to connect into the server and database.  you can update the connect.php file with your address, username and password.
save this into your directory with the other files.
logintest3.php will take you into test8.php test4.php is not linked to login as of yet - I am not continuing to work with these.

second brach (styledsheets)
welcome2.php needs a connect.php file
welcome2.php uses welcome.css for style and actionpage.php to run login queries.
