<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Fish;
use App\Models\Size;
use App\Models\FishHabitat;
use App\Models\FishVariety;
use App\Models\FishFamily;
use App\Models\FishSpecies;

class FishController extends Controller
{

public function getFish() {

    $data = Fish::with(['habitat', 'variety', 'size'])->get();
    
    $data = $data->map(function ($fish) {
        return [
            'fish_code' => $fish->fish_code,
            'scientific_name' => $fish->scientific_name,
            'common_name' => $fish->common_name,
            'fishhabitat' => $fish->habitat ? $fish->habitat->name : null,
            'fishvariety' => $fish->variety ? $fish->variety->name : null,
            'fishsize' => $fish->size_cm, // Assuming size is a relationship with a size_cm field
            'id' => $fish->id,
        ];
    });

    return response()->json($data);
}

    

    public function addfish(Request $request) {

        $name = $request->input('name');

        Fish::create([
            'fish_code' => $request->input('fish_code'),
            'fish_habitat' => $request->input('fishhabitat'),
            'fish_variety' => $request->input('fishvariety'),
            'scientific_name' => $request->input('scientific_name'),
            'common_name' => $request->input('common_name'),
            'pack_A' => $request->input('pack_A'),
            'pack_B' => $request->input('pack_B'),
            'avatar' => $request->input('avatar'),

        ]);

        $result = "success";

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish added ",$username, "Fish Added");

        return $result;

    }

    public function editfish(Request $request) {

        $id = $request->input('fishid');
        $name = $request->input('name');

        $fish = Fish::find($id);
        $fish->name = $name;
        $fish->save();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish added ",$username, "Fish Updated");

        return "success";
    }



    public function deletefish(Request $request) {

        $id = session()->get('id');

        Fish::where('id', $request->input('id'))->delete();

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish deleted ",$username, "Fish Deleted");

        return "deleted";

    }

    public function getfishhabitat() {

        $data = DB::table('tbl_fishhabitat')
            ->select('tbl_fishhabitat.*')
            ->get();

        return $data;    

    }

    public function gethabitat($id) {

        $data = DB::table('tbl_fishhabitat')
            ->select('tbl_fishhabitat.*')
            ->where('id', $id)
            ->first();

        return $data;    

    }


    public function addfishhabitat(Request $request) {

        $name = strtolower($request->input('name'));

        $existingHabitat = FishHabitat::where('name', $name)->first();

        
        if ($existingSize) {
            $result = "fail";
        } else {
            FishHabitat::create([
                'name' => $name,
            ]);

             $result = "success";

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Habitat Added");


        }
        
        return $result;
    }

    public function editfishhabitat(Request $request) {

        $id = $request->input('editid');
        $name = $request->input('habitat-edit');

        $existingHabitat = FishHabitat::where('name', $name)->where('id', '!=', $id)->first();

        if ($existingHabitat) {
            $result = "fail";
        } else {
            $fishHabitat = FishHabitat::find($id);
            $fishHabitat->name = $name;
            $fishHabitat->save();
        
            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Habitat Updated");

            $result = "success";
        }

        return $result;

    }



    public function deletefishhabitat(Request $request) {

        $id = session()->get('id');

        FishHabitat::where('id', $request->input('id'))->delete();

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish habitat deleted ",$username, "Fish Habitat Deleted");

        return "deleted";

    }

    public function getfishvariety() {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*', 'tbl_fishhabitat.name as habitat')
            ->join('tbl_fishhabitat', 'tbl_fishhabitat.id', '=', 'tbl_fish_variety.habitat_id')
            ->get();

        return $data;    

    }

    public function getvariety($id) {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*')
            ->where('id', $id)
            ->first();

        return $data;    

    }


    public function addfishvariety(Request $request) {

        $name = strtolower($request->input('variety'));

        $existingname = FishVariety::where('name', $name)->first();

        if ($existingname) {
            $result = "fail";
        } else {
            $lastVarietyCode = FishVariety::orderBy('code', 'desc')->value('code');
            $nextVarietyCode = Util::getNextVarietyCode($lastVarietyCode);

            FishVariety::create([
                'name' => $name,
                'code' => $nextVarietyCode,
            ]);

            $result = "success";

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress,"fish variety added ",$username, "Fish Variety Added");
        }

        return $result;
        
    }

    public function editfishvariety(Request $request) {

        $id = $request->input('editid');
        $name = $request->input('variety-edit');
        $code = $request->input('code-edit');

        $existingVarietyName = FishVariety::where('name', $name)->where('id', '!=', $id)->first();
        $existingVarietyCode = FishVariety::where('code', $code)->where('id', '!=', $id)->first();

        if ($existingVarietyName || $existingVarietyCode) {
            $result = "fail";
        } else {

            $fishVariety = FishVariety::find($id);
            $fishVariety->name = $name;
            $fishVariety->save();

            $result = "success";

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Habitat Updated");

        }

        return $result;
    }



    public function deletefishvariety(Request $request) {

        $id = session()->get('id');

        FishVariety::where('id', $request->input('id'))->delete();

        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish variety deleted ",$username, "Fish Variety Deleted");

        return "deleted";

    }

    public function genfishcode(Request $request){
        $varietyId = $request->input('fishvariety');

        // Retrieve FishVariety record by id
        $fishVariety = FishVariety::findOrFail($varietyId);

        // Increment the count field
        $fishVariety->count += 1;
        $fishVariety->save();

        // Generate fish code
        $fishCode = $fishVariety->code . '-' . $fishVariety->count;

        return $fishCode;
    }


    public function fishweeklyupload(Request $request){
    $file = $request->file('excel_file');

    $rows = Excel::toArray([], $file);

    // Remove the first row (header row)
    array_shift($rows[0]);

    foreach ($rows[0] as $row) {
        // Assuming your Excel columns are in the order: id, name, month
        DB::table('tbl_fish_variety')->insert([
            'id' => $row[0],
            'code' => $row[1],
            'habitat_id' => $row[2],
            'name' => $row[3],
            'scientific_name' => $row[4],
            'created_at' => $row[5],
            'updated_at' => $row[6],
        ]);
    }

    return redirect()->back()->with('success', 'Excel file uploaded successfully.');
}

    public function getfishsize() {

        $data = DB::table('tbl_size')
            ->select('tbl_size.*')
            ->get();

        return $data;    

    }

    public function getsize($id) {

        $data = DB::table('tbl_size')
            ->select('tbl_size.*')
            ->where('id', $id)
            ->first();

        return $data;    

    }

    public function addFishSize(Request $request){

        $size = strtoupper($request->input('size'));
        $description = $request->input('description');

        $existingSize = Size::where('name', $size)->first();

        if ($existingSize) {
            $result = "fail";
        } else {
            Size::create([
                'name' => $size,
                'description' => $description,
            ]);

            $result = "success";

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "fish size added", $username, "Fish Size Added");
        }

        return $result;
    }



    public function editfishsize(Request $request) {
        $id = $request->input('editid');
        $name = $request->input('size-edit');
        $description = $request->input('description-edit');

        $existingSize = Size::where('name', $name)->where('id', '!=', $id)->first();

        if ($existingSize) {
            return "fail";
        } else {
            $fishSize = Size::find($id);
            $fishSize->name = $name;
            $fishSize->description = $description;
            $fishSize->save();

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "fish size updated", $username, "Fish Size Updated");

            return "success";
        }
    }



    public function deletefishsize(Request $request) {

        $id = session()->get('id');

        Size::where('id', $request->input('id'))->delete();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish size deleted ",$username, "Fish Size Deleted");

        return "deleted";

    }

}
