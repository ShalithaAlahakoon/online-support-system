<?php

namespace Tests\Domain\User\Actions;

use Domain\User\Actions\CreateUserAction;
use Domain\User\DataTransferObjects\UserFormData;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test
     *
     * @throws UnknownProperties
     */
    public function it_can_user_content_successfully()
    {
        $userData = new UserFormData(
            name: 'Test Name',
            email: 'test@imperiallearning.co.uk',
            password: bcrypt('password'),
        );

        app(CreateUserAction::class)($userData);

        $this->assertDatabaseHas('users', [
            'email' => 'test@imperiallearning.co.uk',
        ]);
    }
}
