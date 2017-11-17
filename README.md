# SQLite 3 cache engine for Zend Framework 1 (PDO driver)

## Purposes

1. add SQLite 3 cache engine to Zend Framework 1, besides the already available engines: File, SQLite (2), etc.
1. provide it as Composer package, ready to install and use

## How to use

1. add this package to your dependencies:
   ```
   composer require francescozanoni/zend-cache-sqlite3-pdo
   ```
       
1. customize your **application.ini** file with the following lines:
   ```
   resources.cachemanager.useragents.backend.name = Sqlite3
   resources.cachemanager.useragents.backend.options.cache_db_complete_path = "/path/to/cache.sqlite"
   ```

## History

The engine code (src/Zend/Cache/Backend/Sqlite3.php) is taken from repository [gencer/zend-cache-sqlite3](https://github.com/gencer/zend-cache-sqlite3) as-is, I've only wrapped it into a Composer-compliant file/folder structure.
[gencer/zend-cache-sqlite3](https://github.com/gencer/zend-cache-sqlite3) does not handle the code automatically: copying and pasting the code to the suitable Zend Framework's subfolder is up to the user. This repository also provides PDO and native driver versions together.
[tttptd/zend-cache-sqlite3](https://github.com/tttptd/zend-cache-sqlite3) added a basic composer.json file, but left the manual installation procedure described by [gencer/zend-cache-sqlite3](https://github.com/gencer/zend-cache-sqlite3) and the two versions together.
I've split the original package into two different packages: this one and [francescozanoni/zend-cache-sqlite3-native](https://github.com/francescozanoni/zend-cache-sqlite3-native), in order to let the final user choose and handle requirements accordingly.

## References

  * https://framework.zend.com/manual/1.12/en/zend.cache.html
  * https://github.com/gencer/zend-cache-sqlite3
  * https://github.com/tttptd/zend-cache-sqlite3
