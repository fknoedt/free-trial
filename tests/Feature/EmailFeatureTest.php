<?php

namespace Tests\Feature;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\BaseTestCase;

/**
 * Class EmailFeatureTest
 * Test the /api/emails endpoint for success, conflict and error operations
 * @package Tests\Feature
 */
class EmailFeatureTest extends BaseTestCase
{
    /**
     * Used to validate the REST API responses
     */
    const VALID_JSON_STRUCTURE = [
        'id',
        'email',
        'updated_at',
        'created_at'
    ];

    /**
     * dataProvider: consistent Emails
     * @return array
     */
    public function validEmails()
    {
        return [
            [
                'email' => 'email@example.com'
            ],
            [
                'email' => 'very.long.email@very.long.host.com'
            ]
        ];
    }

    /**
     * dataProvider: inconsistent Emails
     * @return array
     */
    public function invalidEmails()
    {
        return [
            [
                'email' => '.'
            ],
            [
                'email' => 'malformed.email'
            ],
            [
                'email' => '!nvalidem@il@gmail.com'
            ],
        ];
    }

    /**
     * @test
     * GET /api/emails - OK
     * @dataProvider validEmails
     * @return void
     */
    public function testGetEmail404(string $email): void
    {
        $response = $this->get("/api/emails/{$email}", $this->defaultHeader);

        $response->assertStatus(404);
    }

    /**
     * @test
     * GET /api/emails - Error
     * @dataProvider invalidEmails
     * @param string $email
     * @return void
     */
    public function testGetEmail422(string $email): void
    {
        $response = $this->get("/api/emails/{$email}");

        $response->assertStatus(422); // Unprocessable Entry
    }

    /**
     * @test
     * POST /api/emails - OK
     * @dataProvider validEmails
     * @param array $data
     * @return void
     */
    public function testPostEmailSuccess($data): void
    {
        $response = $this->post('/api/emails', ['email' => $data], $this->defaultHeader);

        $response->assertStatus(201);

        $response->assertJsonStructure(
            self::VALID_JSON_STRUCTURE
        );
    }

    /**
     * @test
     * POST /api/emails - Error
     * @dataProvider invalidEmails
     * @return void
     */
    public function testPostEmailsError($data)
    {
        $response = $this->post('/api/emails', ['email' => $data], $this->defaultHeader);

        $response->assertStatus(422);
    }
}
