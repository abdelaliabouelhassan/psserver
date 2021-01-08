<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AppSettings;
use App\Models\Meta;
use Illuminate\Http\Request;
use App\Models\Server;

class AppSettingController extends Controller
{
    //

    public function index()
    {
        $servers = Server::orderBy('vote_amount', 'desc')->where('status', true)->where('admin_active', true)->where('server_owner_active', true)->get();
        $meta = Meta::all();
        return view('admin.pages.app.index', compact('servers', 'meta'));
    }

    public function addBanner(Request $request)
    {

        $banner1_path = null;
        $banner2_path = null;

        $AppSettings =    AppSettings::first();
        if ($image = $request->file('banner1')) {
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/images/', $name);
            $banner1_path = 'uploads/images/' . $name;
        } else {
            if ($AppSettings)
                $banner1_path = $AppSettings->banner1;
            else
                $banner1_path = null;
        }

        if ($image = $request->file('banner2')) {
            $name = time() . $image->getClientOriginalName();
            $image->move('uploads/images/', $name);
            $banner2_path = 'uploads/images/' . $name;
        } else {
            if ($AppSettings)
                $banner2_path = $AppSettings->banner2;
            else
                $banner2_path = null;
        }

        if ($AppSettings) {
            //update
            $AppSettings->banner2 = $banner2_path;
            $AppSettings->banner1 = $banner2_path;
            $AppSettings->save();
        } else {
            AppSettings::create([
                'banner2' => $banner2_path,
                'banner1' => $banner1_path,
            ]);
        }

        session()->flash('good', 'Banner Added Successfully');
        return redirect()->back();
    }

    public function addUrl(Request $request)
    {
        $AppSettings =    AppSettings::first();

        if ($AppSettings) {
            $AppSettings->youtube_url = $request->url;
            $AppSettings->save();
        } else {
            AppSettings::create([
                'youtube_url' => $request->url,
            ]);
        }
        session()->flash('good', 'Url Added Successfully');
        return redirect()->back();
    }


    public function setFeathredServer($id)
    {
        $AppSettings =    AppSettings::first();

        if ($AppSettings) {
            $AppSettings->server_id  = $id;
            $AppSettings->save();
        } else {
            AppSettings::create([
                'youtube_url' => $id,
            ]);
        }
        session()->flash('good', 'Server Set Successfully');
        return redirect()->back();
    }


    public function changeTitle(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);
        $AppSettings =    AppSettings::first();
        if ($AppSettings) {
            $AppSettings->app_title  = $request->title;
            $AppSettings->save();
        } else {
            AppSettings::create([
                'app_title' => $request->title,
            ]);
        }
        session()->flash('good', 'Title  Changed Successfully');
        return redirect()->back();
    }


    public function addMeta(Request $request)
    {
        $request->validate([
            'meta' => 'required'
        ]);
        Meta::create([
            'meta' => $request->meta,
        ]);
        session()->flash('good', 'Meta Added Successfully');
        return redirect()->back();
    }

    public function updateMeta(Request $request, $id)
    {
        $request->validate([
            'meta' => 'required'
        ]);
        $meta =  Meta::findOrFail($id);
        $meta->meta = $request->meta;
        $meta->save();
        session()->flash('good', 'Meta Updated Successfully');
        return redirect()->back();
    }

    public function deleteMeta($id)
    {
        $meta =  Meta::findOrFail($id);
        $meta->delete();
        session()->flash('good', 'Meta Deleted Successfully');
        return redirect()->back();
    }
}
