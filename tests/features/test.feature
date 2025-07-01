Feature: BDD Test
    In order to learn how to integrate Behat with Laravel Dusk
    @test
    Scenario: visit homepage
        When visit hompage
        Then response code should be 200
