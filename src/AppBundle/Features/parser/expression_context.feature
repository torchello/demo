Feature: Query language parser
  In order to parse filter queries
  As a DSL owner
  I need to have basic expression parsing ability

  Scenario: Example 1
    Given I parse '((ID = "1000")) AND (Country != "Russia")'
    Then it should be "((data.id = ?)) AND (data.country <> ?)"
    And parameters should be:
    | 1000    |
    | Russia  |

  Scenario: Example 2
    Given I parse '((Country = "Russia") AND (State != "active") AND (ID = "123"))'
    Then it should be "((data.country = ?) AND (data.state <> ?) AND (data.id = ?))"
    And parameters should be:
      | Russia   |
      | active   |
      | 123      |

  Scenario: Example 3
    Given I parse '(((Country != "Russia") OR (State = "active")) AND (Email = "user@domain.com"))'
    Then it should be "(((data.country <> ?) OR (data.state = ?)) AND (data.email = ?))"
    And parameters should be:
      | Russia          |
      | active          |
      | user@domain.com |


  Scenario: Example 3
    Given I parse 'Foo != "bar'
    Then it should be "abc"
    And parameters should be:
      | Russia          |
      | active          |
      | user@domain.com |
