<?php

namespace Tests\Feature\Affiliate;

use App\Models\Affiliate;
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
        $this->user = User::factory()->hasAffiliate()->create();
        $this->path = route('affiliate.store');
    }

    public function test_affiliate_can_be_created(): void
    {
        $data = [
            'affiliate' => [
                'user_id' => $this->user->id,
                'birthdate' => fake()->date(),
                'cpf' => fake()->cpf(),
                'phone_number' => fake()->cellphoneNumber()
            ]
        ];

        $response = $this->actingAs($this->user)->post($this->path, $data);

        $response->assertStatus(302);

        $a = Affiliate::where('cpf', $data['affiliate']['cpf'])->first();

        $this->assertNotEmpty($a);
    }
}
