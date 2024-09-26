<?php

namespace App\Http\Controllers\Home;

use App\Models\HomeSlide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class HomeSliderController extends Controller
{
    //
    public function HomeSlider(){

        $homeslide =  HomeSlide::find(1);

        return view('admin.home_slide.home_slide_all',compact('homeslide'));

    }  // *** End

    public function UpdateSlider(Request $request){

        $slide_id = $request->id;

        if($request->file('home_slide')){
            $image = $request->file('home_slide');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);

            $path = public_path('upload/home_slide/'.$name_gen);
            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(636,852);
            $imageInt->save($path);

            $save_url = 'upload/home_slide/'.$name_gen;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'home_slide' => $save_url,
            ]);

            $notification = array(
                'message' => 'Home Slide Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else{
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message' => 'Home Slide Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // *** End else

    } // *** End

}
