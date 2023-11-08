<?php

namespace Tests\Domain\Notification\Actions;

use Database\Seeders\ModuleTableSeeder;
use Domain\Notification\Models\Notification;
use Domain\Notification\Models\NotificationType;
use Domain\User\Models\Role;
use Domain\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class DeleteNotificationActionTest extends TestCase
{
    use RefreshDatabase,WithFaker;

    /** @test
     *
     * @throws UnknownProperties
     */
    public function it_can_delete_content_successfully()
    {
        // create unit test for delete created notification
        // call ModuleTableSeeder
        $this->seed(ModuleTableSeeder::class);
        // create a user for authentication
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin', 'description' => 'Administrator', 'guard_name' => 'web']);
        $permission = Permission::create([
            'name' => 'delete notification',
            'description' => 'Delete a notification',
            'guard_name' => 'web',
            'module_id' => 1,
        ]);
        $role->permissions()->attach($permission);
        $user->roles()->attach($role);
        $this->actingAs($user);

        // add data to notification type table
        $notificationType = NotificationType::create([
            'type' => 'test type 2',
            'description' => $this->faker->text,
        ]);

        // add data to notification table
        $notification = Notification::create([
            'title' => $this->faker->title,
            'valid_from' => $this->faker->date(),
            'valid_to' => $this->faker->date(),
            'url' => $this->faker->url,
            'short_description' => $this->faker->text,
            'long_description' => $this->faker->text,
            'course_id' => $this->faker->numberBetween(1, 10),
            'notification_type_id' => $notificationType->id,
            'users' => [$user->id],
        ]);

        // call delete notification action
        $response = $this->delete(route('notification.page.destroy', $notification->id));

        // assert that the response is correct
        $response->assertStatus(200);

    }
}
