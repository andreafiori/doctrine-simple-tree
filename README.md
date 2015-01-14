Doctrine simple tree
=========================

Doctrine simple tree structure using parent \ child table fields.


Installation
-------------------------

	composer install
	
The MySQL database with some sample data is on the sql directory

Create table:
	vendor/bin/doctrine orm:schema-tool:create

Command line options
-------------------------

vendor/bin/doctrine orm:schema-tool:create

On Windows it will become:

vendor\bin\doctrine.bat orm:schema-tool:create

Complete cli option list: http://doctrine-orm.readthedocs.org/en/latest/reference/tools.html

Resources
-------------------------

- https://wildlyinaccurate.com/simple-nested-sets-in-doctrine-2
- https://doctrine-orm.readthedocs.org/en/latest/tutorials/getting-started.html
- http://php.net/manual/it/class.recursiveiteratoriterator.php
