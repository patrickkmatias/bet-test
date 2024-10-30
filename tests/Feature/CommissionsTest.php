<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Commission;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\InertiaTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommissionsTest extends InertiaTestCase
{
    use RefreshDatabase;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->hasAffiliate()->create();
    }

    public function test_commission_can_be_indexed(): void
    {
        $path = route('commissions.index');

        Commission::factory(10)->create(['affiliate_id' => $this->user->affiliate->id]);

        $response = $this->actingAs($this->user)->get($path);

        $response->assertInertia(
            fn(Assert $page) => $page
            ->component('Commissions/Index')
            ->has('commissions', 10)
        );
    }

    public function test_commission_can_be_created(): void
    {
        $data = [
            'affiliate_id' => $this->user->affiliate->id,
            'value' => mt_rand(-2_147_483_648, 2_147_483_647)
        ];

        $path = route('commissions.store');

        $response = $this->actingAs($this->user)->post($path, $data);

        $response->assertRedirect(route('commissions.index'));

        $this->assertDatabaseHas('commissions', $data);
    }

    public function test_commission_can_be_deleted()
    {
        $commission = Commission::factory()->create(['affiliate_id' => $this->user->affiliate->id]);

        $path = route('commissions.destroy', $commission->id);

        $response = $this->actingAs($this->user)->delete($path);

        $this->assertDatabaseMissing('commissions', $commission->toArray());
    }
}
