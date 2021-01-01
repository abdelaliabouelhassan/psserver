<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServersCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'title' => $this->title,
            'banner'=>$this->banner,
            'url'=>$this->url,
            'category'=>$this->category,
            'language'=>$this->language,
            'maxlevel'=>$this->maxlevel,
            'youtube_id'=>$this->youtube_id,
            'rates'=>$this->rates,
            'description'=>$this->description,
            'status'=>$this->status,
            'created_at' => $this->created_at,
        ];
    }
}
