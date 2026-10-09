<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

beforeEach(function () {
    config(['admin.email' => 'admin@example.com']);
    Storage::fake('public');
});

function signInAsCvAdmin(): User
{
    $admin = User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);
    test()->actingAs($admin);

    return $admin;
}

test('admin can upload a cv which appears with view and download actions on the about page', function () {
    $this->get(route('admin.cv.edit'))->assertRedirect(route('login'));
    signInAsCvAdmin();

    $this->get(route('about'))->assertOk()->assertDontSee('Download CV');
    $this->get(route('admin.cv.edit'))
        ->assertOk()
        ->assertSee('No CV has been uploaded yet.')
        ->assertDontSee('cv-preview');

    $this->put(route('admin.cv.update'), [
        'cv' => UploadedFile::fake()->createWithContent('resume.pdf', '%PDF-1.4 CV content'),
    ])->assertRedirect(route('admin.cv.edit'))
        ->assertSessionHas('status', 'CV uploaded successfully.');

    Storage::disk('public')->assertExists('cv/resume.pdf');
    $this->get(route('admin.cv.edit'))
        ->assertOk()
        ->assertSee('Current CV')
        ->assertSee(route('cv.view'), false)
        ->assertSee('Preview of the uploaded CV');
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('Download CV')
        ->assertSee('View CV')
        ->assertSee(route('cv.download'), false)
        ->assertSee(route('cv.view'), false);
    $this->get(route('cv.view'))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf')
        ->assertHeader('content-disposition', 'inline; filename=Ivan-Kim-Almadin-CV.pdf');
    $this->get(route('cv.download'))
        ->assertOk()
        ->assertHeader('content-type', 'application/pdf')
        ->assertHeader('content-disposition', 'attachment; filename=Ivan-Kim-Almadin-CV.pdf');
});

test('admin cv upload accepts only pdf files up to 10 mb', function () {
    signInAsCvAdmin();

    $this->put(route('admin.cv.update'), [
        'cv' => UploadedFile::fake()->createWithContent('resume.txt', 'not a pdf'),
    ])->assertSessionHasErrors('cv');

    $this->put(route('admin.cv.update'), [
        'cv' => UploadedFile::fake()->create('resume.pdf', 10_241, 'application/pdf'),
    ])->assertSessionHasErrors('cv');

    Storage::disk('public')->assertMissing('cv/resume.pdf');
});

test('cv download returns not found until a cv has been uploaded', function () {
    $this->get(route('cv.download'))->assertNotFound();
    $this->get(route('cv.view'))->assertNotFound();
});