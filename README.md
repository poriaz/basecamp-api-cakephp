basecamp-api-cakephp
====================

Basecamp api usage in cakephp....
0)Create your app on 37signals

1)Place the basecamp class in Vendor/basecamp-php-api-master/Basecamp.Class.php

2)Add your conumer secret and consumer key 


Note :  The basecamp class in the repository is copied from somewhere else,It uses PHP OAuth for user authentication.
Some servers dont run it by default.
Try printing phpinfo() in your file and search for OAuth ,if it is not there either you need to add it in your php.ini file or contact server providers.
