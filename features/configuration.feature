Feature: Kernel with configuration

  Scenario: Using Kernel with custom configuration.
    When I run command "php example/configuration/index.php"
    Then I should not see errors
    And I should see at stdout:
    """
    Environment: test
    Debug mode: true
    Name: dobrositekernel
    Root directory: {CWD}/example/configuration
    Cache directory: {CWD}/example/configuration/cache/test
    Logs directory: {CWD}/example/configuration/logs

    Service output: Warning
    """
