<?php

namespace App\Actions\Works;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class WorkImageService
{
    public function attach(Work $work, UploadedFile $image): void
    {
        $work->image_blob = $image->get();
        $work->image_mime_type = $image->getMimeType();
    }

    public function response(Work $work, Request $request, bool $public): Response
    {
        $image = Work::query()
            ->select(['id', 'image_blob', 'image_mime_type', 'updated_at'])
            ->findOrFail($work->getKey());
        $contents = (string) $image->image_blob;
        $etag = '"'.hash('sha256', $contents).'"';

        $response = response($contents)
            ->header('Content-Type', $image->image_mime_type)
            ->header('Content-Length', (string) strlen($contents))
            ->header('Cache-Control', $public ? 'public, max-age=86400, must-revalidate' : 'private, no-cache')
            ->header('ETag', $etag);

        if ($image->updated_at) {
            $response->setLastModified($image->updated_at);
        }

        $response->isNotModified($request);

        return $response;
    }
}
