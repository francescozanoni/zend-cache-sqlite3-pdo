# SQLite 3 cache engine for Zend Framework 1 (PDO driver)


## Purposes

1. add SQLite 3-based cache engine to Zend Framework 1, besides the default SQLite 2 engine
1. provide it as Composer package, with specific requirements and fully automated installation
1. integrate with official Zend Framework 1 package


## How to use

1. add this package to your project dependencies:
   ```bash
   composer require francescozanoni/zend-cache-sqlite3-pdo
   ```
       
1. customize **application.ini** file:
   ```ini
   resources.cachemanager.useragents.backend.name = Sqlite3
   resources.cachemanager.useragents.backend.options.cache_db_complete_path = "/path/to/cache.sqlite"
   ```

1. create cache database file and make it writable by web user:
    ```bash
    touch /path/to/cache.sqlite
    chmod 777 /path/to/cache.sqlite
    ```

## History

1. [gencer/zend-cache-sqlite3](https://github.com/gencer/zend-cache-sqlite3) started the project, with instructions on how to manually copy and paste the code to the suitable Zend Framework's subfolder. PDO and native driver versions are provided together.

1. [tttptd/zend-cache-sqlite3](https://github.com/tttptd/zend-cache-sqlite3) added a basic Composer-compliant structure, but left the manual installation and the two versions together.

1. I've added the official Zend Framework 1 package as requirement and split the original package into two different packages: this one and [francescozanoni/zend-cache-sqlite3-native](https://github.com/francescozanoni/zend-cache-sqlite3-native), in order to let the final user choose and handle requirements accordingly. The engine code (src/Zend/Cache/Backend/Sqlite3.php) was taken as-is from the mentioned repositories, I've only wrapped it into a Composer-compliant file/folder structure.


## References

  * https://framework.zend.com/manual/1.12/en/zend.cache.html
  * https://github.com/gencer/zend-cache-sqlite3
  * https://github.com/tttptd/zend-cache-sqlite3
  * https://github.com/francescozanoni/zend-cache-sqlite3-native
