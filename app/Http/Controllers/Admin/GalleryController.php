<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function store()
    {
        if (request()->hasFile('gallery') && request()->file('gallery')) {
            $pathUpload = 'public/your-images/gallery';
            foreach (request()->file('gallery') as $key => $image) {
                $name = $image->getClientOriginalName();
                info($image->extension());
                if (in_array($image->extension(), ['png', 'jpg', 'jpeg'])) {
                    $image->storeAs($pathUpload, $name);
                    chmod(storage_path('app/public/your-images/gallery/') . $name, 0777);
                }
            }

            $allImagePath = [];

            foreach (\File::allFiles(storage_path('app/public/your-images/gallery/')) as $key => $image) {
                $pathInfo = pathinfo($image);
                $allImagePath[] = [
                    'filename' => $pathInfo['filename'] . '.' . $pathInfo['extension']
                ];
            }

            return $this->jsonResponse([
                'status' => 'success',
                'data' => $allImagePath
            ]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

}
