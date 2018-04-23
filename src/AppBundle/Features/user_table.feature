Feature: Filter users by complex conditions
  As a visitor
  I need to be able to view user which meet some conditions
  In order to find information quickly

  Scenario: Simple condition
    Given I apply filter 'ID="1"'
    Then I should see the following table:
    | ID | Country  | State  |
    |  1 | Zimbabwe | active |

  Scenario: Condition with conjunction #1
    Given I apply filter 'ID="1" OR Country!="China"'
    Then I should see the following table:
      | ID | Country  | State    |
      |  1 | Zimbabwe | active   |
      |  3 | Germany  | inactive |

  Scenario: Complex condition with conjunction #2
    Given I apply filter '((ID="1" OR Country!="China") AND State="inactive")'
    Then I should see the following table:
      | ID | Country  | State    |
      |  3 | Germany  | inactive |

  Scenario: Complex condition with conjunction #3
    Given I apply filter '((ID="1" OR Country!="China") AND State="inactive") OR ID="2"'
    Then I should see the following table:
      | ID | Country  | State    |
      |  2 | China    | active   |
      |  3 | Germany  | inactive |

  Scenario: Empty result
    Given I apply filter 'ID="1" AND ID="2"'
    Then I should see the following table:
      | ID | Country  | State    |
      | No users found |
