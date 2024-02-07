<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    //sama kayak contruct di controller
    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function testChangePassword() {
        $email =  'admin@gmail';
        $oldPassword =  'admin123';
        $newPassword =  'admin1234';
        $respone = $this->userService->change_password($email, $oldPassword,$newPassword);
        $this->assertTrue($respone);
    }
}
