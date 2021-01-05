<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

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
            'is_international' => Str::containsAll($this->language, ['Deutsch,', 'English,', 'Espanol,', 'France,', 'Roman,']),
            'slug'=>$this->slug,
            'realtimeVote'=>$this->vote_amount,
            'viewd'=>$this->viewd,
            'difficulty'=>$this->difficulty,
            'upDown'=>$this->upDown,
            'screen'=>$this->screen,
            'created_at' =>\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans(),
        ];
    }
}
