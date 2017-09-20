<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Get list all image for gallery
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->jsonResponse([
            'status' => 'success',
            'data' => $this->getImage()
        ]);
    }

    /**
     * Store new image to storage
     * @return \Illuminate\Http\Response
     */
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

            return $this->jsonResponse([
                'status' => 'success',
                'data' => []
            ]);
        }

        throw new \Symfony\Component\HttpKernel\Exception\HttpException(400, 'Invalid Request Exception', null, array(), 400);
    }

    /**
     * Get all image from storage
     * @return array
     */
    public function getImage()
    {
        $allImagePath = [];

        foreach (\File::allFiles(storage_path('app/public/your-images/gallery/')) as $key => $image) {
            $pathInfo = pathinfo($image);
            $allImagePath[] = [
                'filename' => $pathInfo['filename'] . '.' . $pathInfo['extension']
            ];
        }

        $chunkImagePath = array_chunk($allImagePath, 20);
        $lengthPaginator = count($chunkImagePath);
        $page = request()->get('page');
        $allImagePath = !empty($chunkImagePath[($page - 1)]) ? $chunkImagePath[($page - 1)] : $chunkImagePath[0];

        return [
            'data' => $allImagePath,
            'current_page' => (int)$page,
            'last_page' => $lengthPaginator
        ];
    }

}
