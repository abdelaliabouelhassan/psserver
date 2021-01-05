<?php

namespace App\Console\Commands;

use App\Models\Server;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;
use  \Illuminate\Support\Carbon;
class TakeScreenshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'take:screen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take Screenshot every 2weeks';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $servers =  Server::where('status','true')->where('admin_active', true)->where('hasBacklink', true)->where('server_owner_active', true)->get();
       
        $now = Carbon::now();
       
        foreach($servers as $server){
            $time = $server->updated_at;
            $time =   $time->diff($now)->days;
                
            if($time >= 14){
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
                $server->save();
            }
          
        }

    }
}
