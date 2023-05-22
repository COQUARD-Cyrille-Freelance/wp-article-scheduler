Feature: Process scheduled posts
  Scenario Outline: Scheduled post
    Given I got a <type> post scheduled to <action> for <schedule>
    When I run the queue
    Then I should have a post <result_type>
    And I should <existence> a post scheduled to <action>

    Examples:
      | type | result_type | action | schedule |existence |
      |    published |   draft |   unpublish | yesterday  | have  |
      |    published |   draft |   unpublish | tomorrow  | have  |