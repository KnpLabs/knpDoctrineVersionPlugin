# knpDoctrineVersionPlugin

Trivial symfony 1.4 plugin to force or get a Doctrine migration version.

## Usage

The *doctrine:version* task can get the current Doctrine migration version:

    ./symfony doctrine:version

Provide a version argument to change the current version (without migrating):

    ./symfony doctrine:version 10

To change the current version to the latest known version:

    ./symfony doctrine:version latest

## Installation

To use this plugin as a git submodule:

    git submodule add git://github.com/knplabs/knpDoctrineVersionPlugin.git plugins/knpDoctrineVersionPlugin

Then enable it in your config/ProjectConfiguration.class.php. You're done!