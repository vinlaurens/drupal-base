<?php

/**
 * @file
 * Contains \DrupalProject\composer\ScriptHandler.
 */

namespace DrupalProject\composer;

use Composer\Script\Event;
use Composer\Semver\Comparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

class ScriptHandler {

  /**
   * @param \Composer\Script\Event $event
   *
   * @throws \Exception
   */
  public static function createRequiredFiles(Event $event) {
    $fs = new Filesystem();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());
    self::createRequiredDirectories($fs, $drupalFinder);
    self::createFilesDirectory($event, $fs, $drupalFinder);
  }

  /**
   * Checks if the installed version of Composer is compatible.
   *
   * Composer 1.0.0 and higher consider a `composer install` without having a
   * lock file present as equal to `composer update`. We do not ship with a lock
   * file to avoid merge conflicts downstream, meaning that if a project is
   * installed with an older version of Composer the scaffolding of Drupal will
   * not be triggered. We check this here instead of in drupal-scaffold to be
   * able to give immediate feedback to the end user, rather than failing the
   * installation after going through the lengthy process of compiling and
   * downloading the Composer dependencies.
   *
   * @see https://github.com/composer/composer/pull/5035
   */
  public static function checkComposerVersion(Event $event) {
    $composer = $event->getComposer();
    $io = $event->getIO();

    $version = $composer::VERSION;

    // The dev-channel of composer uses the git revision as version number,
    // try to the branch alias instead.
    if (preg_match('/^[0-9a-f]{40}$/i', $version)) {
      $version = $composer::BRANCH_ALIAS_VERSION;
    }

    // If Composer is installed through git we have no easy way to determine if
    // it is new enough, just display a warning.
    if ($version === '@package_version@' || $version === '@package_branch_alias_version@') {
      $io->writeError('<warning>You are running a development version of Composer. If you experience problems, please update Composer to the latest stable version.</warning>');
    }
    elseif (Comparator::lessThan($version, '1.0.0')) {
      $io->writeError('<error>Drupal-project requires Composer version 1.0.0 or higher. Please update your Composer before continuing</error>.');
      exit(1);
    }
  }

  /**
   * @param \Symfony\Component\Filesystem\Filesystem $fs
   *   The filesystem.
   * @param \DrupalFinder\DrupalFinder $drupalFinder
   *   The drupal finder.
   */
  private static function createRequiredDirectories(Filesystem $fs, DrupalFinder $drupalFinder) {
    $dirs = [
      'modules',
      'themes',
    ];

    foreach ($dirs as $dir) {
      $drupalRoot = $drupalFinder->getDrupalRoot();
      if (!$fs->exists($drupalRoot . '/' . $dir)) {
        $fs->mkdir($drupalRoot . '/' . $dir);
        $fs->touch($drupalRoot . '/' . $dir . '/.gitkeep');
      }
      if (!$fs->exists($drupalRoot . '/' . $dir . '/custom')) {
        $fs->symlink('../../src/' . $dir . '/', $drupalRoot . '/' . $dir . '/custom');
      }
    }
  }

  /**
   * @param \Composer\Script\Event $event
   *   The composer event.
   * @param \Symfony\Component\Filesystem\Filesystem $fs
   *   The filesystem.
   * @param \DrupalFinder\DrupalFinder $drupalFinder
   *   The drupal finder.
   */
  private static function createFilesDirectory(Event $event, Filesystem $fs, DrupalFinder $drupalFinder) {
    // Create the files directory with chmod 0777
    if (!$fs->exists($drupalFinder->getDrupalRoot() . '/sites/default/files')) {
      $oldmask = umask(0);
      $fs->mkdir($drupalFinder->getDrupalRoot() . '/sites/default/files', 0777);
      umask($oldmask);
      $event->getIO()
        ->write("Create a sites/default/files directory with chmod 0777");
    }
  }

}
