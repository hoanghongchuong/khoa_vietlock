<?php
namespace App\Http\Controllers\Admin;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Images;
use App\Products;
use Request,Input;
class UploadController extends Controller
{
    //
    public function postImages(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                // set destination path
                $folderDir = 'upload/hinhanh';
                $destinationPath = base_path() . '/' . $folderDir;
                // this form uploads multiple files
                foreach ($request->file('file') as $fileKey => $fileObject ) {
                    // make sure each file is valid
                    if ($fileObject->isValid()) {
                        // make destination file name
                        $destinationFileName = time() . $fileObject->getClientOriginalName();
                        // move the file from tmp to the destination path
                        $fileObject->move($destinationPath, $destinationFileName);
                        // save the the destination filename
                        $prodcuctImage = new Images;
                        $ProdcuctImage->image_path = $folderDir . $destinationFileName;
                        $prodcuctImage->name = $originalNameWithoutExt;
                        $prodcuctImage->alt = $originalNameWithoutExt;
                        $prodcuctImage->save();
                    }
                }
            }
        }
    }
    public function upfle(){

        $file = Input::file('upl');
        $destinationPath = '/upload/product/';
        $ext      = $file->guessClientExtension();  // Get real extension according to mime type
        $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
        $hashname = date('H.i.s').'-'.md5($fullname).'.'.$ext; // Hash processed file name, including the real extension
        $upload_success = Input::file('upl')->move($destinationPath, $hashname);

    }

    /*Get file extension */
    // public function get_extension($file_name){
    //     $ext = explode('.', $file_name);
    //     $ext = array_pop($ext);
    //     return strtolower($ext);
    // }

    /*rename file to randomname */
    // public function renameRandom($fileName,$upload_dir){
    //     $fileExt=$this->get_extension($fileName);
    //     $dte=date('YmdHis');
    //     $newName=rand(0000,9999).$dte.'.'.$fileExt;
    //     rename($upload_dir.$fileName,$upload_dir.$newName);
    //     return $newName;
    // }


    /*Upload file */
    /*Upload magazine */
    // public function uploadImg(){

    //     $upload_dir = '/upload/product/';
    //     $allowed_ext = array('jpg','jpeg','png','gif');
    //     $allFiles = Input::file();
    //     $pic = $allFiles['upl'];


    //     $upload_folder = '/upload/product';



    //     if(array_key_exists('upl',$allFiles) && $allFiles['upl']['error'] == 0 ){


    //         if(!in_array($this->get_extension($pic['name']),$allowed_ext)){
    //             $this->exit_status('Only '.implode(',',$allowed_ext).' files are allowed!');
    //         }


    //         // File uploads are ignored. We only log them.
    //         $line = implode('       ', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
    //         file_put_contents('log.txt', $line.PHP_EOL, FILE_APPEND);

    //         $this->exit_status('Uploads are ignored in demo mode.');


    //         // Move the uploaded file from the temporary
    //         // directory to the uploads folder:

    //         if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){

    //             /*rename file to date time */
    //             $fileName=$pic['name'];
    //             $newFile=$this->renameRandom($fileName,$upload_dir);
    //             $this->exit_status('File was uploaded successfuly!');
    //         }

    //     }
    // }


    /*Upload Images */
    // public function uploadImg(){

    //     $file = Input::file('upl');

    //     $allowed_ext = array('jpg','jpeg','png','gif');
    //     $ext= $file->guessClientExtension();  // Get real extension according to mime type

    //     $fullname = $file->getClientOriginalName(); // Client file name, including the extension of the client
    //     $hashname =substr_replace(sha1(microtime(true)), '', 12).'.'.$ext;

    //     $destinationPath = 'uploads/product';

    //     if(!in_array($ext,$allowed_ext)){
    //         echo json_encode(array('status'=>'Invalid File Extension'));
    //     }
    //     else{
    //         $upload_success = Input::file('upl')->move($destinationPath, $hashname);
    //     }

    // }
    // public function uploadImg(Request $request)
    // {
    //     $file_name=fns_Rand_digit(0,9,6);
    //     $allowed = array('png', 'jpg', 'gif');

    //     if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

    //         $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

    //         if(!in_array(strtolower($extension), $allowed)){
    //             echo '{"status":"error"}';
    //             exit;
    //         }

    //         if(move_uploaded_file($_FILES['upl']['tmp_name'], 'upload/product/'.$file_name."_".$_FILES['upl']['name'])){
    //             $data->name = $file_name."_".$_FILES['upl']['name'];
    //             $data->product_id = $request->txtIdproduct;
    //             if($product->save()) {
    //                 echo '{"status":"success"}';
    //                 exit;
    //             }else{
    //                 echo '{"status":"error"}';
    //                 exit;
    //             }

    //         }
    //     }
    // }
}