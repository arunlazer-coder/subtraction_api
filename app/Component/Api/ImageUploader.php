<?php
namespace App\Component\Api;

use App\Component\Helper;
use File;
use Illuminate\Http\Request;
use Validator;

trait ImageUploader
{
    public function imageUpload(Request $request)
    {
        $returnError = array(
            'success' => false,
            'error' => 'Upload failure reason unknown',
            'preventRetry' => true,
        );

        $returnSuccess = array(
            'success' => true,
        );

        $error = false;

        $file = $request->file('file');

        $rules = array(
            'file' => 'required|mimes:jpeg,jpg,png',
        );

        $validator = Validator::make($request->file(), $rules);
        if (!$validator->passes()) {
            $error = true;
            $returnError['error'] = $validator->messages()->first();
        }

        if (!$error) {
            $imageTempName = $file->getPathname();
            $imageName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $imageFileName = Helper::getUnique() . '.' . $extension;

            $imageTmpPathID = Helper::getTmpPath();
            $imageTmpPath = ROOT_TMP . $imageTmpPathID;

            $uploadSuccess = $file->move($imageTmpPath, $imageFileName);

            if ($uploadSuccess && File::exists($imageTmpPath . $imageFileName) && File::isFile($imageTmpPath . $imageFileName)) {
                @chmod($imageTmpPath . $imageFileName, DEF_FILE_PERM);

                $returnSuccess['file'] = $imageTmpPathID . $imageFileName;
                $returnSuccess['url'] = url(str_replace(URL_PUBLIC, '', URL_TMP.str_replace(DS, '/', $returnSuccess['file'])));
            } else {
                $error = true;
                $returnError['error'] = 'Upload error';
            }
        }

        if ($error) {
            return response()->json($returnError);
        } else {
            return response()->json($returnSuccess);
        }
    }

}
