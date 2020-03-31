# Doctrine simple tree

Doctrine simple tree structure using a parent \ child fields of a MySQL table.

## Installation

	composer install

The MySQL database with some data samples is on the sql directory

You can create the empty table with a doctrine command:

	vendor/bin/doctrine orm:schema-tool:create

## Command line options

On Linux:

	vendor/bin/doctrine orm:schema-tool:create

On Windows:

	vendor\bin\doctrine.bat orm:schema-tool:create

- [Complete CLI option list](http://doctrine-orm.readthedocs.org/en/latest/reference/tools.html)

## Resources

- [Doctrine 2 official](https://doctrine-orm.readthedocs.org/en/latest/tutorials/getting-started.html)
- [Doctrine 2 nested sets](https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2)
- [PHP Recursive Iterator](http://php.net/manual/it/class.recursiveiteratoriterator.php)
