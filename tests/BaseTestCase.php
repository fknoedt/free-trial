<?php

namespace Tests;

use App\Services\CategoryService;
use App\Services\EmailService;
use App\Services\PostService;

/**
 * Class BaseTestCase
 * Central / reusable Testing Class
 * @package Tests
 */
class BaseTestCase extends TestCase
{
    /**
     * setup in-memory or physical database
     */
    use DatabaseSetup;

    /**
     * Headers to be sent on the API requests
     * @var array
     */
    protected $defaultHeader = [
        // 'Authorization' => 'Bearer 1xIwy5hU6GdMYyzp9HZdgu1cIKHuPIXG2S2pTZppJYjN5EXcCu0qpi6Rx3sa',
        'Accept'        => 'application/json',
        'Cache-Control' => 'no-cache'
    ];

    /**
     * @var App\Services\EmailService
     */
    protected $emailService;

    /**
     * BaseTestCase constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        // we don't need DI for these services
        $this->emailService = new EmailService();

        parent::__construct($name, $data, $dataName);
    }

    /**
     * Called before each test
     */
    protected function setUp(): void
    {
        parent::setUp();

        // let's make sure migration is up to date (once) and a transaction was started (before each test)
        $this->setupDatabase();
    }

    /**
     * Called after each test
     */
    protected function tearDown(): void
    {
        // ensure transaction is rolled back
        $this->tearDownDatabase();

        parent::tearDown();
    }
}
