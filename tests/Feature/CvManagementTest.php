<?php

use App\Models\User;
use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(function () {
    config(['admin.email' => 'admin@example.com']);
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

    $this->assertDatabaseHas('cvs', [
        'id' => 1,
        'file_name' => 'resume.pdf',
        'mime_type' => 'application/pdf',
    ]);
    $this->assertSame('%PDF-1.4 CV content', Cv::query()->firstOrFail()->file_blob);
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

    $this->assertDatabaseCount('cvs', 0);
});

test('cv download returns not found until a cv has been uploaded', function () {
    $this->get(route('cv.download'))->assertNotFound();
    $this->get(route('cv.view'))->assertNotFound();
});