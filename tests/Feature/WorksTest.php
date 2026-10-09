<?php

use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

beforeEach(function () {
    config(['admin.email' => 'admin@example.com']);
});

function makeWork(array $attributes = []): Work
{
    $work = new Work(array_merge([
        'title' => 'Portfolio Project',
        'slug' => 'portfolio-project',
        'short_description' => 'A concise project summary.',
        'full_description' => 'A longer project description.',
        'category' => 'Web Development',
        'project_url' => null,
        'status' => 'published',
        'sort_order' => 0,
    ], $attributes));
    $work->image_blob = "binary-image\0data";
    $work->image_mime_type = 'image/png';
    $work->save();

    return $work;
}

function signInAsConfiguredAdmin(): User
{
    $admin = User::factory()->create(['email' => 'admin@example.com', 'is_admin' => true]);
    test()->actingAs($admin);

    return $admin;
}

function fakePngUpload(int $size = 0): UploadedFile
{
    $content = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/y14AAAAASUVORK5CYII=', true);

    if ($size > strlen($content)) {
        $content = str_pad($content, $size, ' ');
    }

    return UploadedFile::fake()->createWithContent('project.png', $content);
}

test('admin can create, update, and delete a work with an uploaded image', function () {
    signInAsConfiguredAdmin();
    $image = fakePngUpload();

    $this->post(route('admin.works.store'), [
        'title' => 'New Portfolio Project',
        'short_description' => 'The short summary.',
        'category' => 'Product Design',
        'tools' => 'Laravel, MySQL, Laravel',
        'project_url' => 'https://example.com/project',
        'sort_order' => 4,
        'image' => $image,
    ])->assertRedirect(route('admin.works.index'))
        ->assertSessionHas('status', 'Work created.');

    $work = Work::where('slug', 'new-portfolio-project')->firstOrFail();
    expect($work->image_mime_type)->toBe('image/png')
        ->and($work->image_blob)->not->toBeEmpty()
        ->and($work->status)->toBe('published')
        ->and($work->full_description)->toBe('The short summary.')
        ->and($work->tools)->toBe(['Laravel', 'MySQL']);

    $this->put(route('admin.works.update', $work), [
        'title' => 'Updated Portfolio Project',
        'short_description' => 'Updated summary.',
        'tools' => 'PHP, Vue',
        'category' => null,
        'project_url' => null,
        'sort_order' => 8,
    ])->assertRedirect(route('admin.works.index'))
        ->assertSessionHas('status', 'Work updated.');

    $work->refresh();
    expect($work->title)->toBe('Updated Portfolio Project')
        ->and($work->slug)->toBe('updated-portfolio-project')
        ->and($work->full_description)->toBe('Updated summary.')
        ->and($work->tools)->toBe(['PHP', 'Vue'])
        ->and($work->status)->toBe('published')
        ->and($work->image_mime_type)->toBe('image/png');

    $this->delete(route('admin.works.destroy', $work))
        ->assertRedirect(route('admin.works.index'));

    $this->assertDatabaseMissing('works', ['id' => $work->id]);
});

test('work create and update require an allowed image no larger than 2 MB', function () {
    signInAsConfiguredAdmin();

    $this->from(route('admin.works.create'))
        ->post(route('admin.works.store'), [
            'title' => 'Invalid Image',
            'short_description' => 'Summary.',
            'sort_order' => 0,
            'image' => fakePngUpload(2_097_153),
        ])
        ->assertSessionHasErrors('image');

    $this->from(route('admin.works.create'))
        ->post(route('admin.works.store'), [
            'title' => 'Invalid Image Content',
            'short_description' => 'Summary.',
            'sort_order' => 0,
            'image' => UploadedFile::fake()->createWithContent('not-an-image.gif', 'not an image'),
        ])
        ->assertSessionHasErrors('image');

    $this->assertDatabaseCount('works', 0);
});

test('works lists are protected and select only columns needed for listing', function () {
    $this->get(route('admin.works.index'))->assertRedirect(route('login'));

    signInAsConfiguredAdmin();
    makeWork();
    DB::enableQueryLog();

    $queries = [];
    foreach ([route('admin.works.index'), route('home'), route('works')] as $url) {
        DB::flushQueryLog();
        $this->get($url)->assertOk();
        $queries[] = collect(DB::getQueryLog())
            ->first(fn (array $query) => str_starts_with(ltrim($query['query']), 'select')
                && str_contains($query['query'], 'from "works"')
                && ! str_contains($query['query'], 'count('));
    }

    foreach ($queries as $workQuery) {
        expect($workQuery)->not->toBeNull()
            ->and($workQuery['query'])->not->toContain('image_blob')
            ->and($workQuery['query'])->not->toContain('full_description');
    }
});

test('home and works pages show only published works and home is limited to six', function () {
    foreach (range(1, 8) as $number) {
        makeWork([
            'title' => "Published Project {$number}",
            'slug' => "published-project-{$number}",
            'sort_order' => $number,
        ]);
    }
    makeWork(['title' => 'Unpublished Project', 'slug' => 'unpublished-project', 'status' => 'draft']);

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('Unpublished Project')
        ->assertSee('Published Project 8')
        ->assertDontSee('Published Project 1')
        ->assertViewHas('works', fn ($works) => $works->count() === 6);

    $this->get(route('works'))
        ->assertOk()
        ->assertDontSee('Unpublished Project')
        ->assertDontSee('View details')
        ->assertDontSee('Visit project')
        ->assertViewHas('works', fn ($works) => $works->total() === 8 && $works->count() === 8);
});

test('work cards show category title description and tools in order', function () {
    $work = makeWork([
        'title' => 'Reference Project',
        'slug' => 'reference-project',
        'short_description' => 'Reference project summary.',
        'category' => 'Reference Category',
        'tools' => ['Laravel', 'MySQL'],
    ]);

    $this->get(route('works'))
        ->assertOk()
        ->assertSeeInOrder(['Reference Category', 'Reference Project', 'Reference project summary.', 'Tech:', '<span class="work-tool">Laravel</span>', '<span class="work-tool">MySQL</span>'], false)
        ->assertSee('href="'.route('works.show', $work).'"', false);
});

test('works index paginates and filters published works by category', function () {
    foreach (range(1, 13) as $number) {
        makeWork([
            'title' => "Design Project {$number}",
            'slug' => "design-project-{$number}",
            'category' => 'Design',
        ]);
    }
    makeWork(['title' => 'Development Project', 'slug' => 'development-project', 'category' => 'Development']);

    $this->get(route('works'))
        ->assertOk()
        ->assertSee('>All</a>', false)
        ->assertSee('Web Development')
        ->assertSee('UI/UX Design');

    $this->get(route('works', ['category' => 'Design', 'page' => 2]))
        ->assertOk()
        ->assertViewHas('works', fn ($works) => $works->total() === 13 && $works->currentPage() === 2 && $works->count() === 1);
});

test('published work detail is available by slug and drafts are not public', function () {
    $published = makeWork(['title' => 'Public Detail', 'slug' => 'public-detail']);
    $draft = makeWork(['title' => 'Private Detail', 'slug' => 'private-detail', 'status' => 'draft']);

    $this->get(route('works.show', $published))
        ->assertOk()
        ->assertSee('Public Detail')
        ->assertSee('A longer project description.');

    $this->get(route('works.show', $draft))->assertNotFound();
});

test('image endpoint returns stored bytes with mime and cache headers', function () {
    $work = makeWork();

    $response = $this->get(route('works.image', $work))
        ->assertOk()
        ->assertHeader('Content-Type', 'image/png')
        ->assertHeader('Cache-Control', 'max-age=86400, must-revalidate, public');

    expect($response->getContent())->toBe("binary-image\0data");

    $etag = $response->headers->get('ETag');
    $this->withHeaders(['If-None-Match' => $etag])
        ->get(route('works.image', $work))
        ->assertNotModified();
});

test('draft images are available only to the configured admin with private caching', function () {
    $draft = makeWork(['status' => 'draft']);

    $this->get(route('works.image', $draft))->assertNotFound();

    signInAsConfiguredAdmin();
    $this->get(route('works.image', $draft))
        ->assertOk()
        ->assertHeader('Cache-Control', 'no-cache, private');
});

test('image blob is hidden from model arrays and JSON', function () {
    $work = makeWork();

    expect($work->toArray())->not->toHaveKey('image_blob')
        ->and($work->toJson())->not->toContain('binary-image');
});

test('admin create and edit forms render with an image preview on edit', function () {
    signInAsConfiguredAdmin();
    $work = makeWork();

    $this->get(route('admin.works.create'))
        ->assertOk()
        ->assertSee('Create Work')
        ->assertSee('Close Add Work form')
        ->assertDontSee('Enter the project details and choose whether it is published.')
        ->assertDontSee('Publication status')
        ->assertSee('Tools')
        ->assertDontSee('Full description')
        ->assertDontSee('Slug');

    $this->get(route('admin.works.edit', $work))
        ->assertOk()
        ->assertSee('Close Edit Work form')
        ->assertDontSee('Update project details, image, and publication status.')
        ->assertSee('work-image-preview')
        ->assertSee(route('works.image', $work), false);
});

test('admin-generated slugs stay unique when titles repeat', function () {
    signInAsConfiguredAdmin();

    foreach (range(1, 2) as $number) {
        $this->post(route('admin.works.store'), [
            'title' => 'Repeated Project Title',
            'short_description' => 'Project summary.',
            'status' => 'draft',
            'sort_order' => $number,
            'image' => fakePngUpload(),
        ])->assertRedirect(route('admin.works.index'));
    }

    expect(Work::whereIn('slug', ['repeated-project-title', 'repeated-project-title-2'])->count())->toBe(2);
});
