Feature: As a developer I want to ensure the site is configured in a certain way

  Scenario: No development modules are enabled
    Then the following modules are disabled:
      | module |
      | devel  |
