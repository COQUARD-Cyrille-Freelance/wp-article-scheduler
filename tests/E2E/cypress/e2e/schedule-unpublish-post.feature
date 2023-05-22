Feature: Schedule post for unpublish
  Scenario: Save a post without schedule
    Given I am on a published post page
    When I add 'my example' to the post
    And I save the post
    Then The post should be saved
    And The post should be draft

  Scenario: Schedule a published post in the future
    Given I am on a published post page
    When I add 'my example' to the post
    And I schedule the post to tomorrow
    And I save the post
    Then The post should be saved
    And The post should be draft
    And The post should be scheduled

  Scenario: Schedule a published post in the past
    Given I am on a published post page
    When I add 'my example' to the post
    And I schedule the post to yesterday
    And I save the post
    Then The post should be saved
    And The post should be private

  Scenario Outline: Schedule a non published post
    Given I have <type> post
    Then I should not be able to schedule the post

    Examples:
    | type |
    | draft|
    | trashed|
    |private|
    | protected |