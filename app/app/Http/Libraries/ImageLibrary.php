<?php
    namespace App\Http\Libraries;

    class ImageLibrary{
        
        public static function image_resize($request){
      
            // echo 1;die;
            // $image = $request->file('image');
            // $input['imagename'] = time().'.'.$image->extension();
            // $destinationPath = public_path('/thumbnail');
            // // $destinationPath = public_path('/thumbnail');
            // $img = Image::make($image->path());
            // $img->resize(100, 100, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save($destinationPath.'/'.$input['imagename']);
       
            // $destinationPath = public_path('/images');
            // $image->move($destinationPath, $input['imagename']);
       
            // return back()
            //     ->with('success','Image Upload successful')
            //     ->with('imageName',$input['imagename']);
        }
    }
?>