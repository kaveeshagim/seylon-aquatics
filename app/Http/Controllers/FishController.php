<?php

namespace App\Http\Controllers;

use App\Http\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\Response;
use App\Exports\SampleExcelExportFishWeekly;
use App\Models\Fish;
use App\Models\Size;
use App\Models\FishHabitat;
use App\Models\FishVariety;
use App\Models\FishFamily;
use App\Models\FishSpecies;
use App\Models\FishWeekly;

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

public function getfishfamilies() {

    $data = FishFamily::with(['habitat'])->get();
    
    $data = $data->map(function ($fish) {
        return [
            'name' => $fish->name,
            'fish_habitat' => $fish->habitat ? $fish->habitat->name : null,
            'id' => $fish->id,
        ];
    });

    return response()->json($data);
}

public function getfamily($id) {
    $data = DB::table('tbl_fish_family')
        ->select('tbl_fish_family.*')
        ->where('id', $id)
        ->first();

    $habitatlist = FishHabitat::select('id', 'name')->get();

    return response()->json([
        'data' => $data,
        'habitatlist' => $habitatlist
    ]);
}


public function addfishfamily(Request $request) {

    $family = $request->input('family');
    $habitat = $request->input('habitat');

    // Check if a record with the same title (case insensitive) already exists
    $existingRecord = FishFamily::whereRaw('LOWER(name) = ?', [strtolower($family)])->first();

    if ($existingRecord) {
        // If a duplicate is found, return an error response
        return response()->json(['status' => 'error', 'message' => 'Fish Family already exists. Please choose a different fish family.']);
    }

        FishFamily::create([
            'name' => $name,
            'habitat-id' => $habitat
        ]);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish family added ",$username, "Fish Family Added");

    
        return response()->json(['status' => 'success', 'message' => 'Fish Family added successfully!']);
}

public function editfishfamily(Request $request) {

    $id = $request->input('editid');
    $family = $request->input('family-edit');
    $habitat = $request->input('habitat-edit');

    // Check if there's any other record with the same title but a different ID (case-insensitive)
    $existingRecord = FishFamily::whereRaw('LOWER(name) = ?', [strtolower($family)])
    ->where('id', '!=', $id)
    ->first();

    if ($existingRecord) {
        return response()->json(['status' => 'error', 'message' => 'Fish Family already exists. Please choose a different Fish Family.']);
    }


    $fishHabitat = FishFamily::find($id);
    $fishHabitat->name = $family;
    $fishHabitat->habitat_id = $habitat;
    $fishHabitat->save();

    $username = session()->get('username');
    $ipaddress = Util::get_client_ip();
    Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Family Updated");

    return response()->json(['status' => 'success', 'message' => 'Fish Family updated successfully!']);

}




public function deletefishfamily(Request $request) {

    $id = $request->input('id');

    $fishFamily = FishFamily::with('species')->find($id);

    if ($fishFamily && $fishFamily->species->isNotEmpty()) {
        return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Family because it has related species!']);
    }

    FishFamily::destroy($id);

    $username = session()->get('username');
    $ipaddress = Util::get_client_ip();
    Util::user_auth_log($ipaddress,"fish habitat deleted ",$username, "Fish Habitat Deleted");

    return response()->json(['status' => 'success', 'message' => 'Fish Habitat deleted successfully!']);

}



public function getfishspecies() {

    $data = FishSpecies::with(['family.habitat'])->get();
    
    $data = $data->map(function ($fish) {
        return [
            'species_code' => $fish->species_code,
            'commonname' => $fish->name,
            'scientificname' => $fish->scientific_name,
            'fish_family' => $fish->family ? $fish->family->name : null,
            'fish_habitat' => $fish->family && $fish->family->habitat ? $fish->family->habitat->name : null,
            'id' => $fish->id,
        ];
    });

    return response()->json($data);
}

public function getspecies($id) {
    $data = DB::table('tbl_fish_species')
        ->select('tbl_fish_species.*')
        ->where('id', $id)
        ->first();

    $familylist = FishFamily::select('id', 'name')->get();

    return response()->json([
        'data' => $data,
        'familylist' => $familylist
    ]);
}


public function addfishspecies(Request $request) {

    $commonname = $request->input('common-name');
    $scientificname = $request->input('scientific-name');
    $family = $request->input('family');

    // Check if a record with the same title (case insensitive) already exists
    $existingRecord = FishSpecies::whereRaw('LOWER(name) = ?', [strtolower($commonname)])->first();

    if ($existingRecord) {
        // If a duplicate is found, return an error response
        return response()->json(['status' => 'error', 'message' => 'Fish Species already exists. Please choose a different fish species.']);
    }

    FishSpecies::create([
        'name' => $commonname,
        'scientific_name' => $scientificname,
        'family_id' => $family
    ]);

    $username = session()->get('username');
    $ipaddress = Util::get_client_ip();
    Util::user_auth_log($ipaddress,"fish species added ",$username, "Fish Species Added");

    
    return response()->json(['status' => 'success', 'message' => 'Fish Species added successfully!']);
}

public function editfishspecies(Request $request) {

    $id = $request->input('editid');
    $commonname = $request->input('commonname-edit');
    $scientificname = $request->input('scientificname-edit');
    $family = $request->input('family-edit');

    // Check if there's any other record with the same title but a different ID (case-insensitive)
    $existingRecord = FishSpecies::whereRaw('LOWER(name) = ?', [strtolower($commonname)])
    ->where('id', '!=', $id)
    ->first();

    if ($existingRecord) {
        return response()->json(['status' => 'error', 'message' => 'Fish Species already exists. Please choose a different Fish Species.']);
    }


    $fishSpecies = FishSpecies::find($id);
    $fishSpecies->name = $commonname;
    $fishSpecies->scientific_name = $scientificname;
    $fishSpecies->family_id = $family;
    $fishSpecies->save();

    $username = session()->get('username');
    $ipaddress = Util::get_client_ip();
    Util::user_auth_log($ipaddress,"fish species added ",$username, "Fish Species Updated");

    return response()->json(['status' => 'success', 'message' => 'Fish Species updated successfully!']);

}




public function deletefishspecies(Request $request) {

    $id = $request->input('id');

    $fishSpecies = FishSpecies::with('variety')->find($id);

    if ($fishSpecies && $fishSpecies->variety->isNotEmpty()) {
        return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Species because it has related variety!']);
    }

    FishSpecies::destroy($id);

    $username = session()->get('username');
    $ipaddress = Util::get_client_ip();
    Util::user_auth_log($ipaddress,"fish species deleted ",$username, "Fish Species Deleted");

    return response()->json(['status' => 'success', 'message' => 'Fish Species deleted successfully!']);

}

    public function getfishweekly() {

        $data = FishWeekly::with(['variety'])->get();

          $data = $data->map(function ($fish) {
        return [
            'fish_code' => $fish->fish_code,
            'common_name' => $fish->variety ? $fish->variety->common_name : null,
            'scientific_name' => $fish->variety ? $fish->variety->scientific_name : null,
            'gross_price' => $fish->gross_price,
            'quantity' => $fish->quantity,
            'special_offer' => $fish->special_offer,
            'discount' => $fish->discount,
            'created_at' => $fish->created_at,
            'id' => $fish->id,
        ];
    });

        return response()->json($data);
    }

    public function getfishweeklyhistory() {

        $data = FishWeeklyOld::with(['variety'])->get();

          $data = $data->map(function ($fish) {
        return [
            'fish_code' => $fish->fish_code,
            'common_name' => $fish->variety ? $fish->variety->common_name : null,
            'scientific_name' => $fish->variety ? $fish->variety->scientific_name : null,
            'gross_price' => $fish->gross_price,
            'quantity' => $fish->quantity,
            'special_offer' => $fish->special_offer,
            'discount' => $fish->discount,
            'created_at' => $fish->created_at,
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

        $name = $request->input('habitat');

        // Check if a record with the same title (case insensitive) already exists
        $existingRecord = FishHabitat::whereRaw('LOWER(name) = ?', [strtolower($name)])->first();
    
        if ($existingRecord) {
            // If a duplicate is found, return an error response
            return response()->json(['status' => 'error', 'message' => 'Fish Habitat already exists. Please choose a different fish habitat.']);
        }

            FishHabitat::create([
                'name' => $name,
            ]);

            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Habitat Added");

        
            return response()->json(['status' => 'success', 'message' => 'Fish Habitat added successfully!']);
        }

    public function editfishhabitat(Request $request) {

        $id = $request->input('editid');
        $name = $request->input('habitat-edit');

        // Check if there's any other record with the same title but a different ID (case-insensitive)
        $existingRecord = FishHabitat::whereRaw('LOWER(name) = ?', [strtolower($name)])
        ->where('id', '!=', $id)
        ->first();

        if ($existingRecord) {
            return response()->json(['status' => 'error', 'message' => 'Fish Habitat already exists. Please choose a different Fish Habitat.']);
        }


        $fishHabitat = FishHabitat::find($id);
        $fishHabitat->name = $name;
        $fishHabitat->save();
    
        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish habitat added ",$username, "Fish Habitat Updated");

        return response()->json(['status' => 'success', 'message' => 'Fish Habitat updated successfully!']);

    }




    public function deletefishhabitat(Request $request) {

        $id = $request->input('id');

        $fishHabitat = FishHabitat::with('fishFamilies')->find($id);

        if ($fishHabitat && $fishHabitat->fishFamilies->isNotEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Habitat because it has related fish families!']);
        }
    
        FishHabitat::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish habitat deleted ",$username, "Fish Habitat Deleted");

        return response()->json(['status' => 'success', 'message' => 'Fish Habitat deleted successfully!']);

    }

    public function getfishvariety() {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*', 'tbl_fish_species.name as species', 'tbl_fishhabitat.name as habitat', 'tbl_fish_family.name as family')
            ->join('tbl_fish_species', 'tbl_fish_species.id', '=', 'tbl_fish_variety.species_id')
            ->join('tbl_fish_family', 'tbl_fish_family.id', '=', 'tbl_fish_species.family_id')
            ->join('tbl_fishhabitat', 'tbl_fishhabitat.id', '=', 'tbl_fish_family.habitat_id')
            ->get();
        return $data;    

    }

    public function getvariety($id) {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*')
            ->where('id', $id)
            ->first();

        $specieslist = FishSpecies::select('id', 'name')->get();

        return response()->json([
            'data' => $data,
            'specieslist' => $specieslist
        ]);  

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

        $varietycode = DB::table('tbl_fish_variety')->select('fish_code')->where('id', $id)->first();

        $fishVariety = FishVariety::with('fishweekly')->find($varietycode->varietycode);

        if ($fishVariety && $fishVariety->fishFamilies->isNotEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Variety because it has related fish weekly list!']);
        }

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
public function addfishweekly(Request $request) {
    // Validate the incoming request
    $request->validate([
        'excel_input' => 'required|file|mimes:xlsx,xls,csv',
    ]);

    // Get the uploaded file
    $file = $request->file('excel_input');

    try {
        // Load the file into an array
        $rows = Excel::toArray([], $file);

        // Remove the first row (header row)
        array_shift($rows[0]);

        // Insert data into the database
        foreach ($rows[0] as $row) {
            DB::table('tbl_fishweekly')->insert([
                'fish_code' => $row[0] ?? null,
                'year' => null,
                'month' => null,
                'week' => null,
                'gross_price' => $row[1] ?? null,
                'quantity' => $row[2] ?? null,
                'special_offer' => $row[3] ?? null,
                'discount' => $row[4] ?? null,
                'stock_status' => 'in stock',
            ]);
        }

        // Return a JSON response for AJAX success
        return response()->json(['success' => true]);

    } catch (\Exception $e) {
        // Handle the exception and return a JSON response for AJAX error
        return response()->json(['success' => false, 'message' => 'An error occurred while processing the file: ' . $e->getMessage()]);
    }
}

public function downloadSampleExcel()
{
    $filename = 'fishweekly_upload_template.xlsx';

    return Excel::download(new SampleExcelExportFishWeekly, $filename);
}

public function fishweeklyuploadform(Request $request)
{
    // Validate input data
    $request->validate([
        'fish_code' => 'required',
        'gross_price' => 'required|numeric',
        'quantity' => 'required|integer',
        'special_offer' => 'required',
        'discount' => 'nullable|numeric',
        'fish_week' => 'required|string'
    ]);

    DB::beginTransaction();

    try {
        if ($request->fish_week === 'newweek') {
            // Move all current records to tbl_fishweekly_old
            DB::table('tbl_fishweekly_old')->insert(
                DB::table('tbl_fishweekly')->get()->toArray()
            );

            // Delete current records in tbl_fishweekly
            DB::table('tbl_fishweekly')->truncate();
        }

        // Insert the new data to tbl_fishweekly
        DB::table('tbl_fishweekly')->insert([
            'fish_code' => $request->fish_code,
            'gross_price' => $request->gross_price,
            'quantity' => $request->quantity,
            'special_offer' => $request->special_offer,
            'discount' => $request->discount,
            'stock_status' => $request->input('stock_status', 'in-stock'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Fish weekly list uploaded successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Cannot upload fish weekly list!']);
    }
}


public function fishweeklyuploadexcel(Request $request)
{
    // Validate that a file was uploaded
    $request->validate([
        'excel_input' => 'required|file|mimes:xlsx,xls',
        'fish_week' => 'required|string'
    ]);

    DB::beginTransaction();

    try {
        // Load the uploaded file
        $file = $request->file('excel_input');
        $data = Excel::toArray([], $file)[0]; // Load the first sheet

        // Skip the header row
        $rows = array_slice($data, 1);

        // Validate fish_code against tbl_fish_variety
        foreach ($rows as $index => $row) {
            $fishCode = $row[0];
            $exists = DB::table('tbl_fish_variety')->where('fish_code', $fishCode)->exists();

            if (!$exists) {
                // Rollback transaction and return error with line number (index + 2 because of header)
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => "Fish code '{$fishCode}' not found in tbl_fish_variety on line " . ($index + 2) . ". Please correct the Excel file."
                ]);
            }
        }

        if ($request->fish_week === 'newweek') {
            // Move all current records to tbl_fishweekly_old
            DB::table('tbl_fishweekly_old')->insert(
                DB::table('tbl_fishweekly')->get()->toArray()
            );

            // Delete current records in tbl_fishweekly
            DB::table('tbl_fishweekly')->truncate();
        }

        // Prepare data for insertion
        $insertData = [];
        $now = now();

        foreach ($rows as $row) {
            $insertData[] = [
                'fish_code' => $row[0],
                'year' => $now->year,
                'month' => $now->month,
                'week' => $now->weekOfMonth,
                'gross_price' => $row[1],
                'quantity' => $row[2],
                'special_offer' => $row[3],
                'discount' => $row[4],
                'stock_status' => 'in-stock', // Assuming default is 'in-stock'
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert new data into tbl_fishweekly
        DB::table('tbl_fishweekly')->insert($insertData);

        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Fish weekly list uploaded successfully!']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['status' => 'error', 'message' => 'Cannot upload fish weekly list!']);
    }
}



}
