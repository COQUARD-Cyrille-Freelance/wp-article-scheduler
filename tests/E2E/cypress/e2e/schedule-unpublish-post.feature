Feature: Schedule post for unpublish
  Scenario: Save a post without schedule
    Given I am on a published post page
    When I add 'my example' to the post title
    And I save the post
    Then The post title should be saved with 'my example'
    And The post should be publish

  Scenario: Schedule a published post in the future
    Given I am on a published post page
    When I add 'my example' to the post title
    And I schedule the post to tomorrow
    And I save the post
    Then The post title should be saved with 'my example'
    And The post should be publish
    And The post should be scheduled

  Scenario: Schedule a published post in the past
    Given I am on a published post page
    When I add 'my example' to the post title
    And I schedule the post to yesterday
    And I save the post
    Then The post title should be saved with 'my example'
    And The post should be publish
    And The post not should be scheduled

  Scenario Outline: Schedule a non published post
    Given I am on a <type> post page
    Then I should not be able to schedule the post

    Examples:
    | type |
    | draft|
    | trashed|
    |private|
    | protected |