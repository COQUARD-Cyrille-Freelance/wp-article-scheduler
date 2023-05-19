Feature: Schedule post for unpublish
  Scenario: Save a post without schedule
    Given I have published post
    When I add 'my example' to the post
    And I save the post
    Then The post should be saved
    And The post should be draft

  Scenario: Schedule a published post in the future
    Given I have published post
    When I add 'my example' to the post
    And I schedule the post to tomorrow
    And I save the post
    Then The post should be saved
    And The post should be draft
    And The post should be scheduled

  Scenario: Schedule a published post in the past
    Given I have published post
    When I add 'my example' to the post
    And I schedule the post to yesterday
    And I save the post
    Then The post should be saved
    And The post should be prviate

  Scenario: Schedule a draft post
    Given I have draft post
    Then I should not be able to schedule the post


  Scenario: Schedule a trashed post
    Given I have trashed post
    Then I should not be able to schedule the post

  Scenario: Schedule a private post
    Given I have private post
    Then I should not be able to schedule the post

  Scenario: Schedule a protected post
    Given I have protected post
    Then I should not be able to schedule the post