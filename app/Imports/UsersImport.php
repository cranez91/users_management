<?php
  
namespace App\Imports;
  
use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
  
class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'last_name' =>$row[1],
            'age' =>$row[2],
            'phone' =>$row[3],
            'admission_date' => date("Y-m-d H:i:s"),
            'photo' => "no-photo.jpg"
        ]);
    }
}