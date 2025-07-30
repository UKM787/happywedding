<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait ImageUpload {

  // public function storeImage($data, $folder, $image) {

  //  // dd($data, $folder, $image);
  //   if (request()->has($image)) {
  // // dd(storage_path('app\public/'));
  //     $data->update([ $image => request()->$image->storeAs($folder, $data->slug.'.png','public')]);
  //     $newimage = Image::make(storage_path('app\public/'.$data->$image))->fit(400,300);
  //     $newimage->save();
  //       //$newimage->save('passonnewnameofimage);

  //   }
  // }

  public function storeImage($data, $folder, $image, $current) {
    //dd(request()->file($image));
    //dd($data, $folder, $image, $current);
    if (request()->has($image)) {
      clearstatcache();

      $prev = substr($current, 1);
    //dd(strlen($prev), $current, file_exists(storage_path('app/public/'.$prev)), request()->$image, $data);
    if(strlen($prev) > 0){
      if (file_exists(storage_path('app/public/'.$prev))) {
        if($current != $data->$image){
          unlink(storage_path('app/public/'.$prev));
        }
      }
    }
      
      //unlink("invitations/{$data->$image}");
      $timestamp = time().rand(1,100);

  // dd(storage_path('app\public/'));
      $data->update([ $image => request()->$image->storeAs($folder, $data->slug.'-'.$timestamp.'.png','public')]);
      $fold = substr($folder, 1);
      $path = "{$fold}/{$data->slug}-{$timestamp}.png";
                //dd($data, $folder, $image, $path);
      request()->file($image)->move(storage_path('app/public/'.$folder.'/'), $data->slug.'-'.$timestamp.'.png');
          
      // $newimage = Image::make(storage_path('app\public/'.$data->$image))->fit(400,300);
      //dd(request()->file($image), request()->file($image)->getRealPath());
      //$newimage = Image::make(request()->file($image)->getRealPath())->fit(400,300);
      //dd($newimage, $newimage->save(storage_path('app/public/'.$path)));

      //$newimage->save(storage_path('app/public/'.$path));
      //dd('saved');
        //$newimage->save('passonnewnameofimage);

    }
  }

  public function updateImage($data, $folder, $image) {
    if (request()->has($image)) {
      // $data->update(['cover_image' => request()->cover_image->store($folder,'public')]);
      // $cover_image = Image::make(storage_path('app\public/'.$data->cover_image))->fit(300,300);
      // $cover_image->save();
      $data->update([$image => request()->$image->storeAs($folder, $data->slug.'.png','public')]);
      $newimage = Image::make(storage_path('app\public/'.$data->cover_image))->resize(400,300);
      $newimage->save();

    }
  }

}
