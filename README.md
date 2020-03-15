# Laravel-Package-Template
A template for creating laravel packages

## Installation

```
git clone git@github.com:ChrisBraybrooke/Laravel-Package-Template.git package-name
cd package-name
git remote set-url origin new-url.git
git push -u origin master
```

## Setup
1. Open up `composer.json` and replace the name for the name of this package. You can also give it a description.

2. Do a find and replace across the whole package (including the pre mentioned `composer.json` file) for `NAMESPACE_HERE` which should be replaced with the package name in PascalCase. i.e AwesomePackage.

3. Open the `ServiceProvider.php` file and replace the string returned by `shortName` method with the name you put in the `composer.json`.

4. If you need a config file, you should also rename the `config/chrisbraybrooke-package.php` filename with the string returned by `shortName`.

## Working on Package
You will need a 'host' project, this could be a blank laravel install or another project.

```
cd host-project
vim composer.json
```

Then paste the following anywhere in the file.

```
"repositories": {
    "chrisbraybrooke/package-name": {
        "type": "path",
        "url": "package-url-on-filesystem",
        "options": {
            "symlink": true
        }
    }
}
```

Finally install the package on the host project

```
composer require chrisbraybrooke/package-name
```
