ZeZfDoctrineExtensions
====================

Zend Framework 2 module to use the ZeDoctrineExtensions in https://github.com/ZeinEddin/ZeDoctrineExtensions


Installation
------------

The recommended way to install `zeineddin/ze-zf-doctrine-extensions` is through
[composer](http://getcomposer.org/):

1. Add this project and [ze-zf-doctrine-extensions](https://github.com/ZeinEddin/ZeZfDoctrineExtensions) in your composer.json:

    ```json
    "require": {
        "zeineddin/ze-zf-doctrine-extensions": "dev-master"
    }
    ```

2. Now tell composer to download ze-doctrine-extensions by running the command:

    ```bash
    $ php composer.phar update
    ```


Configuration
-------------

Default configurations are provided in
[config/ze_zf_doctrine_extensions.global.php.dist](config/ze_zf_doctrine_extensions.global.php.dist).
You can copy it to your application's `config/autoload` directory and remove the `.dist` extension
from the file name.

Then choose the right Doctrine Driver Config Key Name for the database you want.