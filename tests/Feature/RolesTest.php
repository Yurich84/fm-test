<?php

namespace Tests\Feature;

use Tests\TestCase;

class RolesTest extends TestCase
{
    public function test_get_roles()
    {
        $this->getJson(route('getRoles'))
            ->assertSuccessful()
            ->assertJsonStructure(['*' => ['value', 'text']]);
    }

}
