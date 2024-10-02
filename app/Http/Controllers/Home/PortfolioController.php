<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
    public function AllPortfolio(){

        $portfolio = Portfolio::latest()->get();

        return view('admin.portfolio.portfolio_all',compact('portfolio'));

    } // End Method

    public function AddPortfolio(){

        return view('admin.portfolio.portfolio_add');

    }

    public function StorePortfolio(Request $request){

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ],[
            'portfolio_name.required' => 'Portfolio Name is required',
            'portfolio_title.required' => 'Portfolio Title is required',
            'portfolio_image.required' => 'Portfolio Image is required',
        ]);

            $image = $request->file('portfolio_image');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);

            $path = public_path('upload/portfolio/'.$name_gen);

            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(1020,519);

            $imageInt->save($path);

            $save_url = 'upload/portfolio/'.$name_gen;

            Portfolio::insert([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url
            ]);

            $notification = array(
                'message' => 'Portfolio Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);

    } // End Method

    public function EditPortfolio($id){
        $portfolio = Portfolio::findOrFail($id);

        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    } // End

    public function UpdatePortfolio(Request $request){

        $portfolio_id = $request->id;

        if($request->file('portfolio_image')){

            $image = $request->file('portfolio_image');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);

            $path = public_path('upload/portfolio/'.$name_gen);

            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(1020,519);

            $imageInt->save($path);

            $save_url = 'upload/portfolio/'.$name_gen;

            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
                'portfolio_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
        } else{
            Portfolio::findOrFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);

            $notification = array(
                'message' => 'Portfolio Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.portfolio')->with($notification);
        } // *** End else

    }

    public function DeletePortfolio($id){

        $portfolio = Portfolio::findOrFail($id);

        $img = $portfolio->portfolio_image;

        unlink($img);

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function PortfolioDetails($id){

        $portfolio = Portfolio::findOrFail($id);

        return view('frontend.home_all.portfolio_details', compact('portfolio'));

    } // End Method

    public function HomePortfolio(){

        $portfolio = Portfolio::latest()->get();

        return view('frontend.portfolio',compact('portfolio'));

    }

}
