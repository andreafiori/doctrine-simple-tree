Doctrine simple tree
=========================

Doctrine simple tree structure using a parent \ child field of a MySQL table.

Installation
-------------------------

	composer install

The MySQL database with some sample data is on the sql directory

You can create the empty table with a doctrine command:
	vendor/bin/doctrine orm:schema-tool:create

Command line options
-------------------------

vendor/bin/doctrine orm:schema-tool:create

On Windows it will become:

vendor\bin\doctrine.bat orm:schema-tool:create

Complete CLI option list: http://doctrine-orm.readthedocs.org/en/latest/reference/tools.html

TODO
-------------------------

I wanted to print the categories in various forms. There's an example on index.php with a code block to turn in a recursive function.

Resources
-------------------------

- https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2
- https://doctrine-orm.readthedocs.org/en/latest/tutorials/getting-started.html
- http://php.net/manual/it/class.recursiveiteratoriterator.php
