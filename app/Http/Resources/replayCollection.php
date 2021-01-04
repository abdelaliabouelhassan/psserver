<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class replayCollection extends JsonResource
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
            'comment' => $this->comment,
            'created_at' => \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->diffForHumans(),
            'id' => $this->id,
            'email'=>$this->email, 
            'username' => $this->username,
        ];
    }
}
