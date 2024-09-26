<?php

namespace App\Http\Controllers\Home;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutController extends Controller
{

    public function AboutPage(){

        $aboutPage =  About::find(1);

        return view('admin.about_page.about_page_all',compact('aboutPage'));

    }  // *** End

    public function UpdateAbout(Request $request){

        $about_id = $request->id;

        if($request->file('about_image')){
            $image = $request->file('about_image');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);

            $path = public_path('upload/home_about/'.$name_gen);
            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(523,605);
            $imageInt->save($path);

            $save_url = 'upload/home_about/'.$name_gen;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'About Page Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } else{
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
            ]);

            $notification = array(
                'message' => 'About Page Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        } // *** End else

    } // *** End


    // todo: frontend routes
    public function HomeAbout(){

        $aboutPage = About::find(1);

        return view('frontend.about_page',compact('aboutPage'));

    } // *** End

}
