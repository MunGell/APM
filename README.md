APM
=========

Includes:
---------

[CodeIgniter 2.0.3](http://codeigniter.com/)

[Doctrine 2.1](http://www.doctrine-project.org/)

[Twig 1.3](http://twig.sensiolabs.org/)

[MySQL WorkBench Exporter](https://github.com/johmue/mysql-workbench-schema-exporter)

[CI Console](https://bitbucket.org/anatooly/ciconsole)

MySQL WorkBench Exporter Console

Compiled with:
--------------
[Twig-CodeIgniter integration library](https://github.com/bmatschullat/Twig-Codeigniter) (changed)

[Doctrine-CodeIgniter article](http://wildlyinaccurate.com/integrating-doctrine-2-with-codeigniter-2/) (changed)

[CodeIgniter MailChimp API 1.2](https://github.com/codepotato/codeigniter-mailchimp-api)

DB Installation
============

1. Create a DB in MySQL WorkBench
2. Save it in .mwb format
3. Execute:

	php [annotation|yml] path/to/file.mwb command
	
4. Unzip the archive and copy models to the models folder
5. Execute:

	php doctrine orm:schema-tool:create
	
6. Done, DB installed

Issues
===========

1. |SOLVED| Doctrine do not know tinyint field type. Commonly it is boolean, so change tinyint type to boolean in each file.

Useful
===========
[Doctrine documentation](http://www.doctrine-project.org/docs/orm/2.1)

[Doctrine console documentation](http://www.doctrine-project.org/docs/orm/2.1/en/reference/tools.html)

CI Console Documentation
========================

[] — required, {} — optional, also paths can be used in names (e.g. layouts/header creates directory and view from the template).

Generate files from templates
------------------------------

	php ci.php create application {applicationName}

	php ci.php create controller [controllerName] {actionName1} {actionName2}…

	php ci.php create model [controllerName] {functionName1} {functionName2}…

	php ci.php create view [viewName1] {viewName2} {viewName3}

	php ci.php create helper [helperName]

Remove files
------------

	php ci.php remove controller [controllerName]

	php ci.php remove model [controllerName]

	php ci.php remove view [viewName]

	php ci.php remove helper [helperName]

Install bundles
----------------

	php ci.php install tankauth-1.0.9

	php ci.php install zend-1.11.10

	php ci.php bundle install hmvc

Uninstall bundles
-----------------

	php ci.php uninstall tankauth-1.0.9

	php ci.php uninstall zend-1.11.10

	php ci.php bundle uninstall hmvc

Bundles available
-----------------

	php ci.php list

	php ci.php bundle list

Appendix
--------

	php ci.php help / php ci.php? (read documentation)

	php readme hmvc (read a bundle readme)

	php bundle readme hmvc (read a bundle readme)

Changes in CodeIgniter Core
============================

1. Form_validation, tag <p> removed