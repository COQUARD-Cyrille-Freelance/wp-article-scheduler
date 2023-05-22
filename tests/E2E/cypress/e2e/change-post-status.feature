Feature: Change post status
  Scenario Outline: Change status from a scheduled post
    Given I have <status> post
    And I have a schedule to <action> on the post
    When I pass the post to <new_status>
    Then I should <existence> a post scheduled to <action>

    Examples:
      | status | new_status | action | existence |
      |    published |   draft |   unpublish | not have  |
      |    published |   protected |   unpublish  | not have  |
      |    published |   private |   unpublish  | not have  |