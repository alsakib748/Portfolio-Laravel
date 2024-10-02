<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{

    public function AllBlog(){

        $blogs = Blog::latest()->get();

        return view('admin.blogs.blogs_all',compact('blogs'));

    } // End Method

    public function AddBlog(){
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('admin.blogs.blogs_add',compact('categories'));
    }

    public function StoreBlog(Request $request){

        $request->validate([
            'blog_category_id' =>'required',
            'blog_title' =>'required',
            'blog_tags' => 'required',
            'blog_description' =>'required',
            'blog_image' =>'required',
        ],[
            'blog_category_id.required' => 'Blog Category is required',
            'blog_title.required' => 'Blog Title is required',
            'blog_tags.required' => 'Blog Tags is required',
            'blog_description.required' => 'Blog Description is required',
            'blog_image.required' => 'Blog Image is required',
        ]);

        $image = $request->file('blog_image');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            // Image::make($image)->resize(636,852)->save('upload/home_slide/'.$name_gen);

            $path = public_path('upload/blog/'.$name_gen);

            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(430,327);

            $imageInt->save($path);

            $save_url = 'upload/blog/'.$name_gen;

            Blog::insert([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog Inserted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

    }

    public function EditBlog($id){

        $blog = Blog::findOrFail($id);

        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('admin.blogs.blog_edit',compact(['blog','categories']));

    } // End Method

    public function UpdateBlog(Request $request){

        $blog_id = $request->id;

        $blog = Blog::findOrFail($blog_id);

        if($request->file('blog_image')){

            $image = $request->file('blog_image');

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            unlink($blog->blog_image);

            $path = public_path('upload/blog/'.$name_gen);

            $manager = new ImageManager(new Driver());

            $imageInt = $manager->read($image);

            $imageInt->resize(430,327);

            $imageInt->save($path);

            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'blog_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        } else{
            Blog::findOrFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_tags' => $request->blog_tags,
                'blog_description' => $request->blog_description,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Blog Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);
        } // *** End else

    }

    public function DeleteBlog($id){

        $portfolio = Blog::findOrFail($id);

        $img = $portfolio->blog_image;

        unlink($img);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function BlogDetails($id){

        $blogs = Blog::findOrFail($id);

        $allBlogs = Blog::latest()->limit(5)->get();

        $categories = BlogCategory::latest()->limit(8)->get();

        return view('frontend.blog_details',compact(['blogs','allBlogs','categories']));

    } // End Method

    public function CategoryBlog($id){

        $blogPost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->get();

        $allBlogs = Blog::latest()->limit(5)->get();

        $categories = BlogCategory::latest()->limit(8)->get();

        $categoryName = BlogCategory::findOrFail($id);

        return view('frontend.cat_blog_details',compact(['blogPost','allBlogs','categories','categoryName']));

    }

    public function HomeBlog(){

        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        $allBlogs = Blog::latest()->paginate(2);

        return view('frontend.blog',compact(['allBlogs','categories']));

    }

}
