Feature: Change post status
  Scenario Outline: Change status from a scheduled post
    Given I have <status> post
    And I have a schedule to <action> on the post
    When I pass the post to <new_status>
    Then I should <existence> a post scheduled to <action>

    Examples:
      | status | new_status | action | existence |
      |    draft |   published |    publish | not have  |
      |    private |   published |    publish |    not have     |
      |    protected |   published |    publish |      not have        |
      |    published |   draft |   unpublish | not have  |
      |    draft |   protected |    publish | not have  |
      |    draft |   private |    publish | not have  |
      |    private |   draft |    publish |    noy have     |
      |    private |   protected |    publish |    not have     |
      |    protected |   draft |    publish |       not have        |
      |    protected |   private |    publish |       not have        |
      |    published |   protected |   unpublish  | not have  |
      |    published |   private |   unpublish  | not have  |