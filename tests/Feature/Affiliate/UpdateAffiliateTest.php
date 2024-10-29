<?php

namespace Tests\Feature;

use App\Models\Affiliate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\InertiaTestCase;

class UpdateAffiliateTest extends InertiaTestCase
{
    use RefreshDatabase;

    protected User $user;
    protected string $path;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->hasAffiliate()->create();
        $this->path = route('affiliate.update', $this->user->affiliate->id);
    }

    public function test_affiliate_can_be_edited(): void
    {
        $data = [
            'affiliate' => [
                'user_id' => $this->user->id,
                'birthdate' => fake()->date(),
                'phone_number' => fake()->cellphoneNumber()
            ]
        ];

        $response = $this->actingAs($this->user)->patch($this->path, $data);

        $response->assertRedirect(route('affiliate.index'));

        $a = Affiliate::where('user_id', $this->user->id)->first();

        $this->assertEquals($data['affiliate']['birthdate'], $a->birthdate);
        $this->assertEquals($data['affiliate']['phone_number'], $a->phone_number);
    }
}
