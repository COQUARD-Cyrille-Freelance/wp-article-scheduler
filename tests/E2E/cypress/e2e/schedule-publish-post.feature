Feature: Schedule post for publication

  Scenario: Save a post without schedule
    Given I have draft post
    When I add 'my example' to the post
    And I save the post
    Then The post should be saved
    And The post should be draft

  Scenario: Schedule a draft post in the future
    Given I have draft post
    When I add 'my example' to the post
    And I schedule the post to tomorrow
    And I save the post
    Then The post should be saved
    And The post should be draft
    And The post should be scheduled

    Scenario: Schedule a draft post in the past
      Given I have draft post
      When I add 'my example' to the post
      And I schedule the post to yesterday
      And I save the post
      Then The post should be saved
      And The post should be published

  Scenario: Schedule a private post in the future
    Given I have private post
    When I add 'my example' to the post
    And I schedule the post to tomorrow
    And I save the post
    Then The post should be saved
    And The post should be private
    And The post should be scheduled

  Scenario: Schedule a private post in the past
    Given I have private post
    When I add 'my example' to the post
    And I schedule the post to yesterday
    And I save the post
    Then The post should be saved
    And The post should be published

  Scenario: Schedule a protected post in the future
    Given I have protected post
    When I add 'my example' to the post
    And I schedule the post to tomorrow
    And I save the post
    Then The post should be saved
    And The post should be protected
    And The post should be scheduled

  Scenario: Schedule a protected post in the past
    Given I have protected post
    When I add 'my example' to the post
    And I schedule the post to yesterday
    And I save the post
    Then The post should be saved
    And The post should be published

  Scenario: Schedule a published post
    Given I have published post
    Then I should not be able to schedule the post


  Scenario: Schedule a trashed post
    Given I have trashed post
    Then I should not be able to schedule the post

