<?php

namespace App\Http\Controllers\admin_panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductVerifyRequest;
use App\Http\Requests\ProductEditVerifyRequest;

use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Categori;


class coursesController extends Controller
{

    public function index()
    {
        $result = Course::all();

        return view('admin_panel.courses.index')
            ->with('prdlist', $result);
    }

    public function create()
    {
        $result = Categori::all();
        return view('admin_panel.courses.create')
            ->with('catlist', $result);

    }

    public function store(ProductVerifyRequest $request)
    {
        try {
            $img = explode('|', $request->img);

            for ($i = 0; $i < count($img) - 1; $i++) {

                if (strpos($img[$i], 'data:image/jpeg;base64,') === 0) {
                    $img[$i] = str_replace('data:image/jpeg;base64,', '', $img[$i]);
                    $ext = '.jpg';
                }
                if (strpos($img[$i], 'data:image/png;base64,') === 0) {
                    $img[$i] = str_replace('data:image/png;base64,', '', $img[$i]);
                    $ext = '.png';
                }


                $prd = new Course();
                $prd->image_name = "1".$ext;
                $prd->name = $request->Name;
                $prd->description = $request->Description;
                $prd->categori_id = $request->Category;
                $prd->price = $request->Price;
                $prd->discount = $request->Discounted_Price;
                $prd->colors = $request->Colors;
                $prd->tag = $request->Tags;
                $prd->save();



                $img[$i] = str_replace(' ', '+', $img[$i]);
                $data = base64_decode($img[$i]);

                $temp_string='/uploads/courses/'.$prd->id;
                $temp_string2='uploads/courses/'.$prd->id;

                if (!file_exists(public_path().$temp_string)) {
                    mkdir( public_path().$temp_string, 0777, true);

                    $file = $temp_string2.'/1'.$ext;

                    if (file_put_contents($file, $data)) {
                        echo "<p>Image $i was saved as $file.</p>";
                    } else {
                        echo '<p>Image $i could not be saved.</p>';
                    }
                }
            }

            /* $file = $request->file('myfile');
                //$last_inc_id = DB::getPdo()->lastInsertId();
                $extension=$file->getClientOriginalExtension();

                $file->move(public_path().$temp_string."/","1.".$file->getClientOriginalExtension());

                */

            return redirect()->route('admin.courses');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function edit($id)
    {
        $cat = Categori::all();

        $prd = Course::find($id);

        return view('admin_panel.courses.edit')
            ->with('product', $prd)
            ->with('catlist', $cat)
            ->with('select_attribute', '');
    }

    public function update(ProductEditVerifyRequest $request, $id)
    {
        $prdToUpdate = Course::find($request->id);
        $prdToUpdate->name = $request->Name;
        $prdToUpdate->description = $request->Description;
        $prdToUpdate->price = $request->Price;
        $prdToUpdate->discount= $request->Discounted_Price;
        $prdToUpdate->categori_id = $request->Category;

        $prdToUpdate->colors = $request->Colors;
        $prdToUpdate->tag= $request->Tags;

        //NEW FILE UPLOADED
        if($request->img!="")
        {
            $img = explode('|', $request->img);

            for ($i = 0; $i < count($img) - 1; $i++) {

                if (strpos($img[$i], 'data:image/jpeg;base64,') === 0) {
                    $img[$i] = str_replace('data:image/jpeg;base64,', '', $img[$i]);
                    $ext = '.jpg';
                }
                if (strpos($img[$i], 'data:image/png;base64,') === 0) {
                    $img[$i] = str_replace('data:image/png;base64,', '', $img[$i]);
                    $ext = '.png';
                }


                $prdToUpdate->image_name = "1".$ext;
                $prdToUpdate->save();


                $img[$i] = str_replace(' ', '+', $img[$i]);
                $data = base64_decode($img[$i]);


                $temp_string2='uploads/courses/'.$prdToUpdate->id;
                $file = $temp_string2.'/1'.$ext;

                if (file_put_contents($file, $data)) {
                    echo "<p>Image $i was saved as $file.</p>";
                } else {
                    echo '<p>Image $i could not be saved.</p>';
                }
            }
            return redirect()->route('admin.courses');



            /*$file = $request->file('myfile');
            $extension=$file->getClientOriginalExtension();
            if($extension=="jpg"|| $extension=="jpeg"|| $extension=="png"|| $extension=="JPG"|| $extension=="JPEG"|| $extension=="PNG" )
            {
            //$temp_for_same_file_name = Product::where('image_name',$file->getClientOriginalName())->first();

            //$file_pointer = "uploads/products/".$product_image_ToUpdate->id."/".  $product_image_ToUpdate->image_name;
            //unlink($file_pointer);
            $temp_string='/uploads/products/'.$prdToUpdate->id;
            $prdToUpdate->image_name = "1.".$file->getClientOriginalExtension();
            $file->move(public_path().$temp_string."/","1.".$file->getClientOriginalExtension());

            $prdToUpdate->save();
            }

            return redirect()->route('admin.products');*/
        }
        else
        {
            $prdToUpdate->save();
            return redirect()->route('admin.courses');
        }
    }

    public function delete($id)
    {
        $prd = Course::find($id);

        return view('admin_panel.courses.delete')
            ->with('product', $prd);
    }

    public function destroy(Request $request)
    {
        $prdToDelete = Course::find($request->id);

        //deleting image folder
        try{
            $src='uploads/courses/'.$prdToDelete->id.'/';
            $dir = opendir($src);
            while(false !== ( $file = readdir($dir)) ) {
                if (( $file != '.' ) && ( $file != '..' )) {
                    $full = $src . '/' . $file;
                    if ( is_dir($full) ) {
                        rrmdir($full);
                    }
                    else {
                        unlink($full);
                    }
                }
            }
            closedir($dir);
            rmdir($src);
        }
        catch(\Exception $e){

        }
        //deleting image folder done

        $prdToDelete->delete();

        return redirect()->route('admin.courses');
    }
}
