<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\InertiaTestCase;

class IndexAffiliateTest extends InertiaTestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->hasAffiliate()->create();
    }

    public function test_affiliates_list_can_be_rendered(): void
    {
        $response = $this->actingAs($this->user)
            ->get('/affiliates')
            ->assertInertia(fn(Assert $page) => $page
                ->component('Affiliates/Index')
                ->has(
                    'affiliates',
                    fn($af) => $this->assertHasData($af)
                ));

        $response->assertStatus(200);
    }
}
