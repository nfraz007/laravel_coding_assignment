<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class TodoResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        unset($data["deleted_at"]);
        
        $data["status_label"] = $this->status_label;

        return $data;
    }
}
