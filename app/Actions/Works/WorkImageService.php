<?php

namespace App\Actions\Works;

use App\Models\Work;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Response;

class WorkImageService
{
    public function attach(Work $work, UploadedFile $image): void
    {
        $work->image_blob = $image->get();
        $work->image_mime_type = $image->getMimeType();
    }

    public function attachGallery(Work $work, array $images): void
    {
        $sortOrder = (int) ($work->galleryImages()->max('sort_order') ?? -1) + 1;

        foreach ($images as $image) {
            $work->galleryImages()->create([
                'image_blob' => $image->get(),
                'image_mime_type' => $image->getMimeType(),
                'sort_order' => $sortOrder++,
            ]);
        }
    }

    public function response(Work $work, Request $request, bool $public): Response
    {
        $image = Work::query()
            ->select(['id', 'image_blob', 'image_mime_type', 'updated_at'])
            ->findOrFail($work->getKey());

        return $this->imageResponse((string) $image->image_blob, $image->image_mime_type, $image->updated_at, $request, $public);
    }

    public function galleryResponse(Work $work, WorkImage $galleryImage, Request $request, bool $public): Response
    {
        $image = WorkImage::query()
            ->select(['id', 'work_id', 'image_blob', 'image_mime_type', 'updated_at'])
            ->where('work_id', $work->getKey())
            ->findOrFail($galleryImage->getKey());

        return $this->imageResponse((string) $image->image_blob, $image->image_mime_type, $image->updated_at, $request, $public);
    }

    private function imageResponse(string $contents, string $mimeType, ?DateTimeInterface $updatedAt, Request $request, bool $public): Response
    {
        $response = response($contents)
            ->header('Content-Type', $mimeType)
            ->header('Content-Length', (string) strlen($contents))
            ->header('Cache-Control', $public ? 'public, max-age=86400, must-revalidate' : 'private, no-cache')
            ->header('ETag', '"'.hash('sha256', $contents).'"');

        if ($updatedAt) {
            $response->setLastModified($updatedAt);
        }

        $response->isNotModified($request);

        return $response;
    }
}
