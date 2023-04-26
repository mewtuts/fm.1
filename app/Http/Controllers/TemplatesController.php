<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Templates;
use App\Models\Category;
use App\Models\Files;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TemplatesController extends Controller
{
    public function addTemplate(Request $request){

        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/'
        ]);

        $user_id = FacadesSession::get('user_id');

        $template = new Templates();
        $template->title = $request->title;
        $template->descriptions = $request->descriptions;
        $template->status = 0;
        $template->user_id = $user_id;
        $template->save();

        //getting the latest row in Contents Table
        $template_id = Templates::select('id')->latest('created_at')->first();

        $category = new Category();
        $category->user_id = $user_id;
        $category->title = $request->title;
        $category->template_id = $template_id->id;
        $category->status = 0;
        $category->save();

        //making folder inside the storage directory.
        //Storage::disk('local')->makeDirectory($request->title);

        //making folder inside the public directory.
        $oldName = public_path($request->title);
        if (File::exists($oldName)) {
            return redirect('/users/home');
        }else{
            File::makeDirectory(public_path($request->title.'_'.$template_id->id));
            return redirect('/users/home');
        }
    }

    //method for deleting template
    public function delete_template(Request $request, $template_id){
        // dd($template_id);
        $category = Category::where('template_id', $template_id)->count();

        if ( $category >= 0 ) {

            session()->flash('message', 'All folders and files will be deleted. Are you sure you want to continue?');
            session()->put('template_id', $template_id);
            return redirect()->back();

        }

    }

    public function continue_delete_template(Request $request, $template_id){

        if ( $request->submit == "Continue" ) {

            $template = Templates::find($template_id);
            $template_title = $template->title;
            $template->delete();

            File::deleteDirectory($template->title.'_'.$template->id);
            return redirect()->back()->with('success', 'Succesfully delete template');

        } else if ( $request->submit == "Cancel" ) {

            return redirect('/users/home');

        }

    }

    //method for editing template title
    public function editTemplate(Request $request){
        // dd($request->tid);
        //template field
        $template = Templates::find($request->tid);

        $oldName = public_path($template->title.'_'.$request->tid);
        $newName = public_path($request->title.'_'.$request->tid);

        if (File::exists($oldName)) {
            File::move($oldName, $newName);

            $template->title = $request->title;
            $template->save();

            //category field
            $category_id = Category::select('id')
            ->where('parent_id', null)
            ->where('template_id', $request->tid)->first();

            $category = Category::find($category_id->id);

            $category->title = $request->title;
            $category->save();

            return redirect()->back()->with('success', 'Folder renamed successfully');

        } else {

            return redirect()->back()->with('error', 'Folder not found');

        }
    }


    //method for editing desriptions of template
    public function editTemplateDescription(Request $request, $template_id){

        $template = Templates::find($template_id);
        $template->descriptions = $request->description;
        $template->save();

        return redirect()->back()->with('success', 'successfully update caption');

    }


    //method for changing the template status
    public function changeStatus(Request $request, $template_id){

        $template = Templates::find($template_id);

        if ( $template->status === '0' ) {

            $template->status = '1';
            $template->save();

            $category = Category::where('template_id', $template_id)
            ->update([
                'status' => '1'
            ]);

        } else {

            $template->status = '0';
            $template->save();

            $category = Category::where('template_id', $template_id)
            ->update([
                'status' => '0'
            ]);

        }

        return redirect()->back()->with('success', 'successfully change status');

    }


    // method for replacing parent-id into the duplicated template
    private function replaceParentID($cid) {

        $category = Category::where('parent_id', $cid)->get();

        // Getting the latest row inside the template table
        $newCategoryId = Category::latest()->first();

        return $newCategoryId->id;

    }

    private function updateParentID($cid, $tid, $index) {

        $categories = Category::where('parent_id', $cid)
        ->where('template_id', $tid)
        ->get();

        $duplicatedCategories = Category::where('template_id', $tid)
        ->skip($index+1-1)
        ->take(1)
        ->first();

        $files = Files::where('template_id', $tid)
        ->where('category_id', $cid)
        ->get();

        foreach ($categories as $category) {
            $category->parent_id = $duplicatedCategories->id;
            $category->save();
        }

        foreach ($files as $file) {
            $file->category_id = $duplicatedCategories->id;
            $file->save();
        }
    }

    // method for duplicating template
    public function duplicateTemplate($template_id) {

        $user_id = FacadesSession::get('user_id');

        // Fetch the original user that you want to duplicate
        $originalTemplate = Templates::find($template_id);

        // Create a new Template model and set its attributes to the original Template's attributes
        $duplicatedTemplate = new Templates();
        $duplicatedTemplate->user_id = $user_id;
        $duplicatedTemplate->title = $originalTemplate->title;
        $duplicatedTemplate->descriptions = $originalTemplate->descriptions;
        $duplicatedTemplate->status = $originalTemplate->status;
        $duplicatedTemplate->save();

        // Getting the last row inside the template table in database
        $latestRow = Templates::latest()->first();

        // Getting all data having a foreign key of the selected template id
        $categories = Category::where('template_id', $template_id)->get();
        // $pid = null;

        foreach ($categories as $originalCategory) {

            $duplicatedModel = new Category();
            $duplicatedModel->user_id = $user_id;
            $duplicatedModel->template_id = $latestRow->id;
            $duplicatedModel->title = $originalCategory->title;

            // $duplicatedModel->parent_id = $pid;
            $duplicatedModel->parent_id = $originalCategory->parent_id;

            $duplicatedModel->status = $originalCategory->status;

            $duplicatedModel->save();

            // Getting the latest row inside the template table
            $newCategoryId = Category::latest()->first();
            // $pid = $this->replaceParentID($originalCategory->id);

            $countFile = Files::where('category_id', $originalCategory->id)->count();
            if ($countFile > 0) {
                // Getting all data having a foreign key of the selected category id
                $originalDataFile = Files::where('category_id', $originalCategory->id)->get();
                foreach ($originalDataFile as $file) {
                    $duplicatedFiles = new Files();
                    $duplicatedFiles->category_id = $originalCategory->id;
                    $duplicatedFiles->template_id = $newCategoryId->template_id;
                    $duplicatedFiles->alternative_name = $file->alternative_name;
                    $duplicatedFiles->file_name = $file->file_name;
                    $duplicatedFiles->file_type = $file->file_type;
                    $duplicatedFiles->file_size = $file->file_size;
                    $duplicatedFiles->file_path = $file->file_path;
                    $duplicatedFiles->url = $file->url;
                    $duplicatedFiles->save();
                }
            }
        }

        $latestCategories = Category::where('template_id', $latestRow->id)->get();

        foreach ($categories as $index => $category) {

            $this->updateParentID($category->id, $latestRow->id, $index);
            // $this->updateCategoryID();

        }

        $sourceDir = public_path($originalTemplate->title.'_'.$originalTemplate->id);
        $destDir = public_path($originalTemplate->title.'_'.$latestRow->id);

        // Create the destination directory if it doesn't exist
        if (!File::exists($destDir)) {
            File::makeDirectory($destDir);
        }

        // Copy the source directory recursively to the destination directory
        File::copyDirectory($sourceDir, $destDir);

        return redirect()->back();
    }
}
