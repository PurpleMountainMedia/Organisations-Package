# Laravel-Package-Template
A template for creating laravel packages

## Installation

```
git clone git@github.com:ChrisBraybrooke/Laravel-Package-Template.git package-name
cd package-name
git remote set-url origin new-url.git
git push -u origin master
```

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
