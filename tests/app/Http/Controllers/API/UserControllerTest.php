<?php

namespace Tests\App\Http\Controllers\API;

use App\Http\Controllers\API\UserController;
use App\Http\Requests\UserFormRequest;
use Domain\User\Actions\CreateUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_store_method_returns_created_response_on_successful_user_creation()
    {
        // Create a mock UserFormRequest object
        $userFormRequest = new UserFormRequest([
            'name' => 'Test Name',
            'email' => 'test@imperiallearning.co.uk',
            'password' => 'password',
        ]);

        // Create a mock CreateUserAction object
        $createUserAction = new CreateUserAction();

        // Call the store method of UserController with mock objects
        $response = (new UserController)->store($userFormRequest, $createUserAction);

        // Assert that the response is a JSON response and has HTTP_CREATED status code
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}
