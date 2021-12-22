Feature: Users can visit the homepage

  Scenario: Users can visit the homepage
    Given I am on the homepage
    Then the response status code should be 200
