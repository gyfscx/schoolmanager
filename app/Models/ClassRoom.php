<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $guarded=[];
    protected $appends =['action', 'dateFormat'];
   
   
    public function getActionAttribute(){
        $var = $this->attributes['id'];
        $action=  '<td><a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#editClassRoomModal" class="link-underlined margin-right-50 btn btn-success btn-sm" onclick="editClassRoom('.$var.')"><i class="fa fa-edit"><!-- --></i></a> 
                        <a href="javascript: void(0);" style ="font-size: 12px;" data-toggle="modal" data-target="#removeClassRoomModal" class="link-ulink-underlined btn btn-danger btn-sm" onclick="removeClassRoom('.$var.')"><i class="fa fa-trash"><!-- --></i></a> 
                         </td>';
        
      
        return $action;
        
    }
     public function getDateFormatAttribute() {
        $date = $this->attributes['created_at']; 
    return \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s');
    }
}
