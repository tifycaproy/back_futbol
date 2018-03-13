<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveFile($file, $path)
    {
        $fileName = "";
        if ($file) {
            $foto = json_decode($file);
            $extension = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . $extension;
            $picture = $foto->output->image;
            $filepath = $path . $fileName;

            if ($foto->input->type == 'image/gif') {
                $path = $foto->input->name;
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $picture = 'data:image/' . $extension . ';base64,' . base64_encode($data);
                $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . (string)(rand(1, 9)) . $extension;
            }

            $s3 = S3Client::factory(config('app.s3'));

            $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));
        }

        return $fileName;
    }

    public function deleteFile($file, $path)
    {
        $s3 = S3Client::factory(config('app.s3'));

        $result = $s3->deleteObject(array(
            'Bucket' => config('app.s3_bucket'),
            'Key' => $path . $file
        ));
    }

}
