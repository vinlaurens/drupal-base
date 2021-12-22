<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Testwork\Tester\Result\TestResult;
use Drupal\DrupalExtension\Context\MinkContext;

/**
 * Class FailureContext.
 */
class FailureContext implements Context {

  /**
   * MinkContext.
   *
   * @var \Drupal\DrupalExtension\Context\MinkContext
   */
  private $minkContext;

  /**
   * @BeforeScenario
   *
   * @param \Behat\Behat\Hook\Scope\BeforeScenarioScope $scope
   */
  public function gatherContexts(BeforeScenarioScope $scope): void {
    /** @var \Behat\Behat\Context\Environment\InitializedContextEnvironment $environment */
    $environment = $scope->getEnvironment();

    $this->minkContext = $environment->getContext(MinkContext::class);
  }

  /**
   * @afterScenario
   *
   * @param \Behat\Behat\Hook\Scope\AfterScenarioScope $scope
   *
   * @throws \RuntimeException
   */
  public function printCurrentUrl(AfterScenarioScope $scope): void {
    if ($scope->getTestResult()->getResultCode() === TestResult::FAILED) {
      throw new \RuntimeException('Current url:' . $this->minkContext->getSession()->getCurrentUrl());
    }
  }

}
