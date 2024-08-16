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
use App\Models\FishWeeklyOld;
use App\Services\PHPMailerService;

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
            'name' => strtoupper($family),
            'habitat_id' => $habitat
        ]);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish family added ",$username, "Fish Family Added");

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();
    
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

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();

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

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();

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

    $dashboardController = new \App\Http\Controllers\DashboardController();
    $dashboardController->updateStatus();

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
            'size' => $fish->size,
            'size_cm' => $fish->size_cm,
            'year' => $fish->year,
            'week' => $fish->week,
            'quantity' => $fish->quantity,
            'special_offer' => $fish->special_offer,
            'discount' => $fish->discount,
            'created_at' => $fish->created_at,
            'stock_status' => $fish->stock_status,
            'id' => $fish->id,
            'image' => $fish->variety ? $fish->variety->image : null,
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
                'size' => $fish->size,
                'size_cm' => $fish->size_cm,
                'year' => $fish->year,
                'week' => $fish->week,
                'quantity' => $fish->quantity,
                'special_offer' => $fish->special_offer,
                'discount' => $fish->discount,
                'created_at' => $fish->created_at,
                'id' => $fish->id,
                'image' => $fish->variety ? $fish->variety->image : null,
            ];
    });

        return response()->json($data);
    }

    public function deletefishweekly(Request $request) {
        
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

            $dashboardController = new \App\Http\Controllers\DashboardController();
            $dashboardController->updateStatus();

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

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();

        return response()->json(['status' => 'success', 'message' => 'Fish Habitat deleted successfully!']);

    }

    public function getfishvariety() {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*', 'tbl_fish_species.name as species', 'tbl_fishhabitat.name as habitat', 'tbl_fish_family.name as family', 'tbl_size.name as size')
            ->join('tbl_fish_species', 'tbl_fish_species.id', '=', 'tbl_fish_variety.species_id')
            ->join('tbl_fish_family', 'tbl_fish_family.id', '=', 'tbl_fish_species.family_id')
            ->join('tbl_fishhabitat', 'tbl_fishhabitat.id', '=', 'tbl_fish_family.habitat_id')
            ->leftjoin('tbl_size', 'tbl_fish_variety.size', '=', 'tbl_size.id')
            ->get();
        return $data;    

    }

    public function getvariety($id) {

        $data = DB::table('tbl_fish_variety')
            ->select('tbl_fish_variety.*')
            ->where('id', $id)
            ->first();

        $specieslist = FishSpecies::select('id', 'name')->get();
        $sizelist = Size::select('id', 'name')->get();

        return response()->json([
            'data' => $data,
            'specieslist' => $specieslist,
            'sizelist' => $sizelist,
        ]);  

    }


    public function addfishvariety(Request $request) {
        // Validate input fields
        $validatedData = $request->validate([
            'commonname' => 'required|string|max:255',
            'scientificname' => 'required|string|max:255',
            'species' => 'required|integer',
            'qtyperbag' => 'required|integer',
            'size' => 'nullable|string|max:255',
            'size_cm' => 'nullable|string|max:255',
            'avatar' => 'nullable|file|max:2048',        
        ]);
    
        $commonName = strtoupper($validatedData['commonname']);
        $scientificName = strtolower($validatedData['scientificname']);
        $speciesId = $validatedData['species'];
        $qtyperbag = $validatedData['qtyperbag'];
        $size = strtoupper($validatedData['size']);
        $sizeCm = strtoupper($validatedData['size_cm']);
    
        // Check if fish variety already exists
        $existingname = FishVariety::where('common_name', $commonName)
                                   ->where('scientific_name', $scientificName)
                                   ->where('species_id', $speciesId)
                                   ->where('size', $size)
                                   ->where('size_cm', $sizeCm)
                                   ->first();
    
        if ($existingname) {
            return response()->json(['status' => 'error', 'message' => 'Fish variety already exists!']);
        } else {
            // Generate fish code using Util function
            $fishCode = Util::generateFishCode($speciesId, $size, $sizeCm);
    
    
        // Handle the file upload
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $originalExtension = $avatar->getClientOriginalExtension(); // Get the original file extension
    
            // Generate a new filename using the username and current date/time
            $newFileName = $fishCode . '-' . now()->format('Y-m-d-H-i-s') . '.' . $originalExtension;
    
            $avatarPath = $avatar->storeAs('fishimages', $newFileName, 'public');
        }
    
            // Create new FishVariety record
            FishVariety::create([
                'common_name' => $commonName,
                'scientific_name' => $scientificName,
                'species_id' => $speciesId,
                'size' => $size,
                'size_cm' => $sizeCm,
                'qtyperbag' => $qtyperbag,
                'fish_code' => $fishCode,
                'image' => $avatarPath, // Save the image path
            ]);
    
            // Log the user's action
            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "fish variety added", $username, "Fish Variety Added");
    
            $dashboardController = new \App\Http\Controllers\DashboardController();
            $dashboardController->updateStatus();

            return response()->json(['status' => 'success', 'message' => 'Fish Variety added successfully!']);
        }
    }
    


    public function editfishvariety(Request $request) {
        $id = $request->input('editid');
        $commonName = strtoupper($request->input('commonname-edit'));
        $scientificName = strtolower($request->input('scientificname-edit'));
        $speciesId = $request->input('species-edit');
        $qtyperbag = $request->input('qtyperbag-edit');
        $size = strtoupper($request->input('size-edit'));
        $sizeCm = strtoupper($request->input('size_cm-edit'));
    
        // Validate the input fields including image
        $validatedData = $request->validate([
            'avatar-edit' => 'nullable|file|max:2048',
        ]);
    
        // Check if a variety with the same details already exists (excluding the current record)
        $existingVariety = FishVariety::where('id', '!=', $id)
        ->where('common_name', $commonName)
        ->where('scientific_name', $scientificName)
        ->where('species_id', $speciesId)
        ->where('size', $size)  // Use where for both size and size_cm
        ->where('size_cm', $sizeCm)
        ->first();
    
    
        if ($existingVariety) {
            return response()->json(['status' => 'error', 'message' => 'Fish variety with these details already exists!']);
        } else {
            // Find the fish variety to be edited
            $fishVariety = FishVariety::find($id);
    
            // Check if fields affecting fish code have changed
            $codeRequiresUpdate = $fishVariety->species_id != $speciesId || $fishVariety->size != $size || $fishVariety->size_cm != $sizeCm;
    
            // Update fields
            $fishVariety->common_name = $commonName;
            $fishVariety->scientific_name = $scientificName;
            $fishVariety->species_id = $speciesId;
            $fishVariety->size = $size;
            $fishVariety->size_cm = $sizeCm;
            $fishVariety->qtyperbag = $qtyperbag;
    
            // Handle the fish image upload
        $avatarPath = null;
        if ($request->hasFile('avatar-edit')) {
            $avatar = $request->file('avatar-edit');
            $originalExtension = $avatar->getClientOriginalExtension(); // Get the original file extension
    
            // Generate a new filename using the username and current date/time
            $newFileName = $fishVariety->fish_code . '-' . now()->format('Y-m-d-H-i-s') . '.' . $originalExtension;
    
            // Check if the file already exists in the storage
            if (!Storage::disk('public')->exists('fishimages/' . $newFileName)) {
                $avatarPath = $avatar->storeAs('fishimages', $newFileName, 'public');
            } else {
                // If the file exists, use the existing path
                $avatarPath = 'fishimages/' . $newFileName;
            }
            $fishVariety->image = $avatarPath;
        }
    
            // Regenerate fish code if necessary
            if ($codeRequiresUpdate) {
                $fishVariety->fish_code = Util::generateFishCode($speciesId, $size, $sizeCm);
            }
    
            // Save the changes
            $fishVariety->save();
    
            // Log the user's action
            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "fish variety updated", $username, "Fish Variety Updated");
    
            return response()->json(['status' => 'success', 'message' => 'Fish Variety updated successfully!']);
        }
    }
    


    public function deletefishvariety(Request $request) {

        $id = $request->input('id');

        $fishVariety = FishVariety::with(['fishweekly', 'fishweeklyold'])->find($id);

        if ($fishVariety && $fishVariety->fishweekly->isNotEmpty() && $fishVariety->fishweeklyold->isNotEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Variety because it has related fish weekly records!']);
        }
    
        FishVariety::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish habitat deleted ",$username, "Fish Variety Deleted");

        $dashboardController = new \App\Http\Controllers\DashboardController();
        $dashboardController->updateStatus();

        return response()->json(['status' => 'success', 'message' => 'Fish Variety deleted successfully!']);

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

    public function addfishsize(Request $request){

        $size = strtoupper($request->input('size'));
        $description = $request->input('description');

        $existingSize = Size::whereRaw('LOWER(name) = ?', [strtolower($size)])->first();

        if ($existingSize) {
            return response()->json(['status' => 'error', 'message' => 'Fish Size already exists. Please choose a different fish size.']);

        }             
        
        Size::create([
            'name' => $size,
            'description' => $description,
        ]);


            $username = session()->get('username');
            $ipaddress = Util::get_client_ip();
            Util::user_auth_log($ipaddress, "fish size added", $username, "Fish Size Added");

            return response()->json(['status' => 'success', 'message' => 'Fish Size added successfully!']);

    }



    public function editfishsize(Request $request) {
        $id = $request->input('editid');
        $name = $request->input('size-edit');
        $description = $request->input('description-edit');

        $existingSize = Size::whereRaw('LOWER(name) = ?', [strtolower($name)])
        ->where('id', '!=', $id)
        ->first();

        if ($existingSize) {
            return response()->json(['status' => 'error', 'message' => 'Fish Size already exists. Please choose a different Fish Size.']);
        }

        $fishSize = Size::find($id);
        $fishSize->name = $name;
        $fishSize->description = $description;
        $fishSize->save();

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress, "fish size updated", $username, "Fish Size Updated");

        return response()->json(['status' => 'success', 'message' => 'Fish Size updated successfully!']);

    }



    public function deletefishsize(Request $request) {

        $id = $request->input('id');

        $fishSize = Size::with('variety')->find($id);

        if ($fishSize && $fishSize->variety->isNotEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Cannot delete Fish Size because it has related fish varieties!']);
        }

    
        Size::destroy($id);

        $username = session()->get('username');
        $ipaddress = Util::get_client_ip();
        Util::user_auth_log($ipaddress,"fish size deleted ",$username, "Fish Size Deleted");

        return response()->json(['status' => 'success', 'message' => 'Fish Size deleted successfully!']);

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

public function getfishsizedata(Request $request) {
    $fishCode = $request->input('fish_code');
    
    $fishVariety = DB::table('tbl_fish_variety')
        ->join('tbl_size', 'tbl_fish_variety.size', '=', 'tbl_size.id')
        ->select('tbl_fish_variety.size_cm', 'tbl_size.name as size_name')
        ->where('tbl_fish_variety.fish_code', $fishCode)
        ->first();
    
    if ($fishVariety) {
        return response()->json([
            'status' => 'success',
            'data' => [
                'size' => $fishVariety->size_name, // Use the correct property name
                'size_cm' => $fishVariety->size_cm
            ]
        ]);
    } else {
        return response()->json([
            'status' => 'error',
            'message' => 'Fish code not found.'
        ]);
    }
}



public function downloadSampleExcel()
{
    $filename = 'fishweekly_upload_template.xlsx';

    return Excel::download(new SampleExcelExportFishWeekly, $filename);
}

public function fetchfishweeklyexceldata(Request $request)
{
    $fishCodes = $request->input('fish_codes');

    // Fetch fish data along with size names
    $fishData = FishVariety::select('tbl_fish_variety.fish_code', 'tbl_fish_variety.size', 'tbl_fish_variety.size_cm', 'tbl_fish_variety.common_name', 'sizes.name as size_name')
        ->leftjoin('tbl_size as sizes', 'tbl_fish_variety.size', '=', 'sizes.id') // Join with tbl_size table to get size name
        ->whereIn('tbl_fish_variety.fish_code', $fishCodes)
        ->get()
        ->keyBy('fish_code');

    // Map the size ID to the size name
    $fishData = $fishData->map(function ($item) {
        $item->size = $item->size_name; // Map size to the name
        unset($item->size_name); // Remove the size_name field
        return $item;
    });

    return response()->json($fishData);
}


public function fishweeklyuploadform(Request $request)
{
    // Validate the fish_week input
    $request->validate([
        'fish_week' => 'required|string',
        'table_data' => 'required|array',
        'table_data.*.fish_code' => 'required|string',
        'table_data.*.size' => 'required|string',
        'table_data.*.size_in_cm' => 'required|string',
        'table_data.*.gross_price' => 'required|numeric',
        'table_data.*.quantity' => 'required|integer',
        'table_data.*.special_offer' => 'required|string',
        'table_data.*.discount' => 'nullable|numeric'
    ]);

    // Log the received data for debugging purposes
    \Log::info('Received data for fish weekly upload:', $request->all());


    try {
        if ($request->fish_week === 'newweek') {
            \Log::info('Handling new week logic.');
            
            // Fetch all records from tbl_fishweekly, excluding the 'id' field
            $fishWeeklyRecords = DB::table('tbl_fishweekly')->get()->map(function($record) {
                $recordArray = (array) $record; // Convert stdClass object to array
                unset($recordArray['id']); // Remove the 'id' field
                return $recordArray;
            })->toArray();

            // Insert the converted records into tbl_fishweekly_old
            DB::table('tbl_fishweekly_old')->insert($fishWeeklyRecords);
            \Log::info('Old records inserted into tbl_fishweekly_old.');

            // Delete current records in tbl_fishweekly
            DB::table('tbl_fishweekly')->truncate();
            \Log::info('tbl_fishweekly truncated.');


            try {
                $activeUsers = User::where('active_status', 1)->get();
        
                if ($activeUsers->isEmpty()) {

                }else{

                    $subject = "Weekly Fish Stock List - " . now()->weekOfYear;
                    $body = 'Hi, <br><br>New Fish Weekly Stock List Added';
            
                    foreach ($activeUsers as $user) {
                        // Insert notification for each user
                        DB::table('tbl_notifications')->insert([
                            'user_id' => $user->id,
                            'notification' => 'New Fish Weekly Stock List Added',
                            'seen_status' => 0,
                            'created_at' => now(),
                        ]);
            
                        // Send email to each user
                        try {
                            $mailerService = new PHPMailerService();
                            $mailerService->sendEmail($user->email, $subject, nl2br($body));
                            Log::info('Email sent to: ' . $user->email);
                        } catch (\Exception $e) {
                            Log::error('Email sending failed for ' . $user->email . '. Error: ' . $e->getMessage());
                        }
                    }

                }
        

        
        
            } catch (\Exception $e) {
                Log::error('Failed to send notifications and emails. Error: ' . $e->getMessage());
            }



        }

        // Insert the new data into tbl_fishweekly
        foreach ($request->table_data as $record) {
            DB::table('tbl_fishweekly')->insert([
                'fish_code' => $record['fish_code'],
                'year' => now()->year,
                'month' => now()->month,
                'week' => now()->weekOfYear,
                'size' => $record['size'],
                'size_cm' => $record['size_in_cm'],
                'gross_price' => round($record['gross_price'], 2), // Round to 2 decimal places
                'quantity' => $record['quantity'],
                'special_offer' => $record['special_offer'],
                'discount' => round($record['discount'], 2), // Round to 2 decimal places
                'stock_status' => 'in-stock', // Assuming default value is 'in-stock'
                'created_at' => now(),
                'updated_at' => now()
            ]);
            \Log::info('New record inserted into tbl_fishweekly.');
        }


        \Log::info('Transaction committed successfully.');

        return response()->json(['status' => 'success', 'message' => 'Fish weekly list uploaded successfully!']);
    } catch (\Exception $e) {

        \Log::error('Error during transaction rollback: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString(),
        ]);
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

    // DB::beginTransaction();

    try {
        // Load the uploaded file
        $file = $request->file('excel_input');
        $data = Excel::toArray([], $file)[0]; // Load the first sheet

        // Skip the header row
        $rows = array_slice($data, 1);

        // Fetch sizes for fish codes
        $fishCodes = array_map('trim', array_column($rows, 0)); // Extract fish codes from rows
        $fishVarieties = DB::table('tbl_fish_variety')
            ->whereIn(DB::raw('TRIM(fish_code)'), $fishCodes) // Trim fish_code from DB
            ->get()
            ->keyBy(function ($item) {
                return trim($item->fish_code); // Trim the fish_code key
            }); // Key by fish_code for quick lookup

        // Validate fish codes and retrieve size and size_cm
        $insertData = [];
        foreach ($rows as $index => $row) {
            $fishCode = trim($row[0]);
            if (!isset($fishVarieties[$fishCode])) {
                // Rollback transaction and return error with line number (index + 2 because of header)
                // DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => "Fish code '{$fishCode}' not found in tbl_fish_variety on line " . ($index + 2) . ". Please correct the Excel file."
                ]);
            }

            $fishDetails = $fishVarieties[$fishCode];
            $insertData[] = [
                'fish_code' => $fishCode,
                'year' => now()->year,
                'month' => now()->month,
                'week' => now()->weekOfYear,
                'size' => $fishDetails->size, // Ensure this is a string or properly formatted value
                'size_cm' => $fishDetails->size_cm, // Ensure this is a string or properly formatted value
                'gross_price' => $row[1],
                'quantity' => $row[2],
                'special_offer' => $row[3],
                'discount' => $row[4],
                'stock_status' => 'in-stock',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Handle new week logic
        if ($request->fish_week === 'newweek') {
            // Move all current records to tbl_fishweekly_old, ignoring the primary key
            $currentRecords = DB::table('tbl_fishweekly')
                ->select('fish_code', 'year', 'month', 'week', 'size', 'size_cm', 'gross_price', 'quantity', 'special_offer', 'discount', 'stock_status', 'created_at', 'updated_at')
                ->get();

            // Debug the current records
            \Log::info('Current records:', $currentRecords->toArray());

            // Convert objects to arrays
            $formattedRecords = $currentRecords->map(function ($record) {
                return (array) $record; // Convert object to array
            })->toArray();

            DB::table('tbl_fishweekly_old')->insert($formattedRecords);

            // Delete current records in tbl_fishweekly
            DB::table('tbl_fishweekly')->truncate();
        }

        // Insert new data into tbl_fishweekly
        DB::table('tbl_fishweekly')->insert($insertData);

        // DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Fish weekly list uploaded successfully!']);
    } catch (\Exception $e) {
        // DB::rollBack();
        \Log::error('Error during fishweeklyuploadexcel:', ['exception' => $e]);
        return response()->json(['status' => 'error', 'message' => 'Cannot upload fish weekly list!']);
    }
}



}
