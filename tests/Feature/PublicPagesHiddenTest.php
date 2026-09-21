<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesHiddenTest extends TestCase
{
    public function test_public_services_page_is_hidden(): void
    {
        $this->get('/services')->assertNotFound();
    }

    public function test_public_contact_page_is_hidden(): void
    {
        $this->get('/contact')->assertNotFound();
    }
}
