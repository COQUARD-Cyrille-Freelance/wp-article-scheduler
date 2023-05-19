Feature: Process scheduled posts
  Scenario: Scheduled post in the future
    Given I got a post 'My little poney' scheduled to publish for tomorrow
    And I got a post 'Fairytails' scheduled to publish for tomorrow
    When I run the queue
    Then I should have a post 'My little poney' scheduled to publish for tomorrow
    And I should have a post 'Fairytails' scheduled to unpublish for tomorrow

  Scenario: Scheduled post in the past
    Given I got a post 'My little poney' scheduled to publish for yesterday
    And I got a post scheduled to publish for yesterday
    When I run the queue
    Then I should have a post 'My little poney' published
    And I should have a post 'Fairytails' unpublished
    And I should not have a post 'My little poney' scheduled to publish
    And I should not have a post 'Fairytails' scheduled to unpublish