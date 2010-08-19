<?php

/**
 * With this symfony plugin you can directly change or get the current Doctrine migration version.
 *
 * @package    knp
 * @subpackage doctrine
 * @author     Matthieu Bontemps <matthieu.bontemps@knplabs.com>
 */
 class knpDoctrineVersionTask extends sfBaseTask
{
  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('version', sfCommandArgument::OPTIONAL, 'Force this version number. Leaver empty to simply print the current version.'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', true),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
    ));

    $this->namespace = 'doctrine';
    $this->name = 'version';
    $this->briefDescription = 'Get or set the current Doctrine migration version (WITHOUT migrating)';
    $this->detailedDescription =  <<<EOF
The [doctrine:version|INFO] task can get the current Doctrine migration version:

  [./symfony doctrine:version|INFO]

Provide a version argument to change the current version (skipping migrations):

  [./symfony doctrine:version 10|INFO]

EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    
    $migration = new Doctrine_Migration();
    
    $currentVersion = $migration->getCurrentVersion();
    
    if(!isset($arguments['version']))
    {
      $this->logSection('doctrine', 'Current migration version is '.$currentVersion);
    }
    else
    {
      $version = $arguments['version'];
      
      if(!is_numeric($version))
      {
        $this->logSection('doctrine', 'Unknown version '.$version, null, 'ERROR');
        return;
      }
      $migration->setCurrentVersion($version);
      $this->logSection('doctrine', 'Current migration version was forced to '.$version);
    }
  }
}