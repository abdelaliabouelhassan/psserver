<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Http\Request;
use App\Mail\ServerAdmin_active;
use Illuminate\Support\Facades\Mail;
use App\Models\Comment;
use App\Models\Vote;
use Spatie\Browsershot\Browsershot;
class ServerManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::orderBy('vote_amount', 'desc')->where('status', true)->where('admin_active', true)->where('server_owner_active', true)->get();

      
        return view('admin.pages.servers.index',compact('servers'));
    }

    public function get_un_active_servers(){
        $servers = Server::orderBy('vote_amount', 'desc')->where('status', true)->where('admin_active', false)->where('server_owner_active', true)->get();
        return view('admin.pages.servers.index', compact('servers'));
    }

    public function get_un_approve_servers(){
        $servers = Server::orderBy('vote_amount', 'desc')->where('status', false)->get();
        return view('admin.pages.servers.index', compact('servers'));
    }


    public function approve_server(Request $request){

       
        $server =  Server::findOrFail($request->id);
        //take screenshot
        $image_name = uniqid() . '_' . time() . '.png';

        $include_path = trim(shell_exec('npm bin'));
        $delay_in_milliseconds = 15000;
        $node_path = $include_path . DIRECTORY_SEPARATOR . 'node';
        $npm_path = $include_path . DIRECTORY_SEPARATOR . 'npm';
        $path_to_image = public_path('uploads/images/' . $image_name);
        Browsershot::url($server->url)
            ->addChromiumArguments(['no-sandbox'])
            ->setIncludePath($include_path)
            ->setNodeBinary($node_path)
            ->setNpmBinary($npm_path)
            ->waitUntilNetworkIdle()
            ->setDelay($delay_in_milliseconds)
            ->save($path_to_image);

        $server->screen = 'uploads/images/' . $image_name;
        $server->status = true;
        $server->save();
        session()->flash('good', 'Server approved Successfully');

        return redirect()->back();
    }

    public function active_server_deactivate(Request $request){
       $server =  Server::findOrFail($request->id);
       if($server->admin_active){
            $request->validate([
                'description'=>'required'
            ]);
            $server->admin_active = false;
            Mail::to($server->user->email)->send(new ServerAdmin_active($request->description));
           
       }else{
            $server->admin_active = true;
       }
        $server->save();
        session()->flash('good', 'Server Updated Successfully');

        return redirect()->back();
    }

    public function active_comment_deactivate(Request $request){
        $server =  Server::findOrFail($request->id);
        if($server->comment_active){
            $server->comment_active =false;

        }else{
            $server->comment_active = true;
        }
        $server->save();
        session()->flash('good', 'Server Updated Successfully');
        return redirect()->back();
    }

    public function delete_Comment(Request $request){
        Comment::findOrFail($request->id)->delete();
        session()->flash('good', 'Comment Deleted Successfully');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $server =  Server::findOrFail($id)->first();
       return view('admin.pages.servers.show',compact('server'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Server::findOrFail($id)->delete();
        Comment::where('server_id',$id)->delete();
        Vote::where('server_id',$id)->delete();
        session()->flash('good', 'Server Deleted Successfully');
        return redirect()->back();
    }
}
