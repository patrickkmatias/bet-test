<?php

namespace Tests\Feature\Affiliate;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class StoreAffiliateTest extends InertiaTestCase
{
    use RefreshDatabase;

    protected User $user;
    protected string $path;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->path = route('affiliate.store');
    }

    public function test_affiliate_can_be_created(): void
    {
        $this->assertEmpty($this->user->affiliate);

        $data = [
            'affiliate' => [
                'user_id' => $this->user->id,
                'birthdate' => fake()->date(),
                'cpf' => fake()->unique()->cpf(),
                'phone_number' => fake()->cellphoneNumber()
            ],
            'address' => [
                'city' => fake()->city(),
                'state' => fake()->state(),
                'street' => fake()->streetAddress(),
            ]
        ];

        $response = $this->actingAs($this->user)->post($this->path, $data);

        $response->assertRedirect(route('affiliate.index'));
        
        $this->assertDatabaseHas('affiliates', $data['affiliate']);
        $this->assertDatabaseHas('addresses', $data['address']);
    }
}
