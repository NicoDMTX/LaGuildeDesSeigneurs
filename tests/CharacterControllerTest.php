<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Response;

class CharacterControllerTest extends WebTestCase
{

    private $client;
    private $content;
    private static $identifier;

    public function assertJsonResponse()
    {
        $response = $this->client->getResponse();
        $this->content = json_decode($response->getContent(), true, 50);
        //...
    }
    /**
     * Asserts that 'identifier' is present in the Response
    */
    public function assertIdentifier()
    {
        $this->assertArrayHasKey('identifier', $this->content);
    }
    /**
    * Defines identifier
    */
    public function defineIdentifier()
    {
        self::$identifier = $this->content['identifier'];
    }

    public function setUp() : void
    {
        $this->client = static::createClient();
    }

    public function testCreate()
    {
        $this->client->request('POST', '/character/create');
        $this->assertJsonResponse();
        $this->defineIdentifier();
        $this->assertIdentifier();
    }

    public function testIndex()
    {
        $this->client->request('GET', '/character');

        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());.
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'), $response->headers);
    }

    public function testRedirectIndex()
    {
        $this->client->request('GET', '/character');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Tests bad identifier
     */
    public function testBadIdentifier()
    {
        $this->client->request('GET', '/character/display/badIdentifier');
        $this->assertError404($this->client->getReponse()->getStatusCode());
    }

    /**
     * Asserts that Response returns 404
     */
    public function assertError404($statusCode)
    {
        $this->assertEquals(404, $statusCode);
    }

    /**
     * Asserts that a Reponse is in json
     */
    public function assertJsonReponse($response)
    {
        $reponse = $this->client-getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'), $response->headers);
    }

    public function testDisplay()
    {
        $this->client->request('GET', '/character/display/' . self::$identifier);

        $this->assertJsonResponse();
        $this->assertIdentifier();
    }

    public function testModify()
    {
        $this->client->request('PUT', '/character/modify/' . self::$identifier);
        $this->assertJsonResponse();
        $this->assertIdentifier();
    }
}
