<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_locale(): void
    {
        $response = $this->get('/');
        $response->assertRedirect('/ar');
    }

    public function test_arabic_homepage_loads(): void
    {
        $response = $this->get('/ar');
        $response->assertOk();
        $response->assertSee('إم آي', false);
    }

    public function test_english_homepage_loads(): void
    {
        $response = $this->get('/en');
        $response->assertOk();
    }

    public function test_invalid_locale_returns_404(): void
    {
        $response = $this->get('/fr');
        $response->assertNotFound();
    }
}
