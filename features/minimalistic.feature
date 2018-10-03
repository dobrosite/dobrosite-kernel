Feature: Zero configuration

  Scenario: Using Kernel out of the box in clean environment.
    When I run command "php example/zero-config/index.php"
    Then I should see at stdout:
    """
    Environment: prod
    Debug mode: false
    Name: zeroconfig
    Root directory: {CWD}/example/zero-config
    Cache directory: {TMP}/{SHA1({CWD}/example/zero-config)}/cache/prod
    Logs directory: {TMP}/{SHA1({CWD}/example/zero-config)}/logs

    Service output: Warning
    """
