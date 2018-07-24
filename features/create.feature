Feature:
  Create new record

  Scenario: Open page and add record, next, try to get it
    When I am on "/simple/new"
    And I fill in "Name" with "new name"
    And I select "May" from "simple_created_on_date_month"
    And I select "18" from "simple_created_on_date_day"
    And I select "2018" from "simple_created_on_date_year"
    And I press "Save"
    Then I am on "/simple"
    And I should see "new name"
    And I should see "2018-05-18"
