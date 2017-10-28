<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{

    use DatabaseMigrations;
    use DatabaseTransactions;

    public function testCrudTag()
    {
        $this->json('POST', '/api/tags', ['name' => 'momo 0tomo'])
             ->assertStatus(200)
             ->assertJson([
                'id'   => 6,
                'name' => 'momo 0tomo',
                'is_done' => false,
            ]);

        $this->assertDatabaseHas('tags', [
                'id'   => 6,
                'name' => 'momo 0tomo',
                'is_done' => false,
            ]);

        $this->json('GET', '/api/tags')
             ->assertStatus(200)
             ->assertJson([
                1 => [
                    'id'   => 6,
                    'name' => 'momo 0tomo',
                    'is_done' => false,
                ]
            ]);

        $this->json('PUT', '/api/tags/6', ['is_done' => true])
             ->assertStatus(200)
             ->assertJson([
                'id'   => 6,
                'name' => 'momo 0tomo',
                'is_done' => true,
            ]);

        $this->assertDatabaseHas('tags', [
                'id'   => 6,
                'name' => 'momo 0tomo',
                'is_done' => true,
            ]);

        $this->json('DELETE', '/api/tags/6')
             ->assertStatus(200);

        $this->assertDatabaseMissing('tags', [
                'id'   => 6,
            ]);
    }
}