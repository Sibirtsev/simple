Feature:
  Check data from fixtures

  Scenario: Open ail page for simple controller and check the data
    When I am on "/simple"
    Then I should see "hello"
    And I should see "2013-12-31"
    And I should see "world"
    And I should see "2014-01-01"