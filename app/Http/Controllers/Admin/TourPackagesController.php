<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PackageImageRequest;
use App\Http\Requests\PackageTypeRequest;
use App\Http\Requests\TourPackageRequest;
use App\Http\Requests\UpdateTourPackageRequest;
use App\PackageType;
use App\TourPackage;

class TourPackagesController extends Controller
{
    public function add_tour_package(TourPackageRequest $request)
    {
        $name = $request->get('name');
        $slug = $request->get('slug');
        $package_image = $request->get('package_image');
        $no_of_days = $request->get('no_of_days');
        $no_of_nights = $request->get('no_of_nights');
        $package_description = $request->get('package_description');
        $selling_day_start = $request->get('selling_day_start');
        $selling_day_end = $request->get('selling_day_end');
        $travel_day_start = $request->get('travel_day_start');
        $travel_day_end = $request->get('travel_day_end');
        $price_starts = $request->get('price_starts');
        $destination = $request->get('destination');
        $package_types = $request->get('package_types');

        $packages = DB::table('tour_packages')->where('slug', $slug)->first();
        if(count($packages) > 0){
            return json_encode(array('type' => 'error', 'title' => 'Unable to Save Tour Package', 'message' => 'Tour package URL has been already taken'));
        } else{
            list($type, $package_image) = explode(';',$package_image);
            list(, $package_image) = explode(',', $package_image);

            $package_image = base64_decode($package_image);
            $newPackageImageName = time().uniqid(rand()).".png";
            $path = public_path() . "/uploads/tour_packages/" . $newPackageImageName;

            if(!file_put_contents($path, $package_image))
                return json_encode(array('type' => 'error', 'title' => 'Unable to Save Tour Package', 'message' => 'Failed to upload tour package image'));
            else{
                $package_image = url('/')."/uploads/tour_packages/".$newPackageImageName;

                $meta_description = $name . " tour package of MBK Travel and Tours";
                $meta_description = strtolower($meta_description);

                $meta_keywords = preg_replace('/[^a-zA-Z0-9-]/', ' ', $name);
                $meta_keywords = str_replace(" ", ", ", $meta_keywords);
                $meta_keywords = rtrim($meta_keywords, ",");
                $meta_keywords .= " package, packages, travel, tour, tours, naga, city, camarines, sur, mbk, madya, biyahe, kita";
                $meta_keywords = strtolower($meta_keywords);

                $package = new TourPackage;
                $package->name = strtoupper($name);
                $package->slug = $slug;
                $package->package_image = $package_image;
                $package->no_of_days = $no_of_days;
                $package->no_of_nights = $no_of_nights;
                $package->package_description = $package_description;
                $package->selling_day_start = date('Y-m-d', strtotime($selling_day_start));
                $package->selling_day_end = date('Y-m-d', strtotime($selling_day_end));
                $package->travel_day_start = date('Y-m-d', strtotime($travel_day_start));
                $package->travel_day_end = date('Y-m-d', strtotime($travel_day_end));
                $package->price_starts = $price_starts;
                $package->meta_description = $meta_description;
                $package->meta_keywords = $meta_keywords;
                $package->destination = $destination;
                $package->save();

                $package_types = json_decode($package_types, true);

                for($i = 0; $i < count($package_types); $i++){
                    $package_type = new PackageType;
                    $package_type->package_id = $package->id;
                    $package_type->type_name = $package_types[$i]['package_type_name'];
                    $package_type->price = $package_types[$i]['package_pax_price'];
                    $package_type->help_info = $package_types[$i]['package_help_desc'];
                    $package_type->save();
                }

                return json_encode(array('type' => 'success', 'title' => 'Tour Package Saved!', 'message' => 'Your new tour package is now available to your clients'));
            }
        }
    }

    public function replace_tour_package_image(PackageImageRequest $request)
    {
        $id = $request->get('id');
        $new_image = $request->get('package_image');

        $tour_package = TourPackage::findOrFail($id);

        if(!$tour_package){
            return json_encode(array('type' => 'error', 'title' => 'Unable to Update Package Image', 'message' => 'Tour package reference not found'));
        } else{
            $package_image = $tour_package->package_image;
            $package_image = str_replace(url('/'), public_path(), $package_image);

            if(unlink($package_image)){
                list($type, $new_image) = explode(';', $new_image);
                list(, $new_image) = explode(',', $new_image);

                $package_image = base64_decode($new_image);
                $newPackageImageName = time().uniqid(rand()).".png";
                $path = public_path() . "/uploads/tour_packages/" . $newPackageImageName;

                if(!file_put_contents($path, $package_image)){
                    return json_encode(array('type' => 'error', 'title' => 'Unable to Update Package Image', 'message' => 'Target upload folder is missing'));
                } else{
                    $package_image = url('/')."/uploads/tour_packages/".$newPackageImageName;

                    $tour_package->package_image = $package_image;
                    $tour_package->save();

                    return json_encode(array('type' => 'success', 'title' => 'Package Image Updated!', 'message' => 'Tour package has been successfully updated'));
                }
            }
        }
    }

    public function edit_tour_package(UpdateTourPackageRequest $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $slug = $request->get('slug');
        $package_description = $request->get('package_description');
        $no_of_days = $request->get('no_of_days');
        $no_of_nights = $request->get('no_of_nights');
        $selling_day_start = $request->get('selling_day_start');
        $selling_day_end = $request->get('selling_day_end');
        $travel_day_start = $request->get('travel_day_start');
        $travel_day_end = $request->get('travel_day_end');
        $price_starts = $request->get('price_starts');
        $destination = $request->get('destination');

        $package = DB::table('tour_packages')->where('slug', $slug)->first();
        $flag = false;
        if(count($package) > 0){
            if($package->id != $id){
                return json_encode(array('type' => 'error', 'title' => 'Unable to Update Tour Package!', 'message' => 'Tour package URL is already taken try another one'));
                exit();
            } else $flag = true;
        } else $flag = true;

        if($flag == true){
            $package = TourPackage::findOrFail($id);

            $package->name = strtoupper($name);
            $package->slug = $slug;
            $package->package_description = $package_description;
            $package->no_of_days = $no_of_days;
            $package->no_of_nights = $no_of_nights;
            $package->selling_day_start = date('Y-m-d', strtotime($selling_day_start));
            $package->selling_day_end = date('Y-m-d', strtotime($selling_day_end));
            $package->travel_day_start = date('Y-m-d', strtotime($travel_day_start));
            $package->travel_day_end = date('Y-m-d', strtotime($travel_day_end));
            $package->price_starts = $price_starts;
            $package->destination = $destination;

            $package->save();
            return json_encode(array('type' => 'success', 'title' => 'Tour Package Updated!', 'message' => 'Tour package has been successfully updated'));
        }
    }

    public function get_package_type_info($slug, $id)
    {
        $package_type = PackageType::whereId($id)->firstOrFail();

        $data = null;
        if(count($package_type) > 0){
            $data = array(  'type' => 'success',
                'type_name' => $package_type->type_name,
                'price' => $package_type->price,
                'help_info' => $package_type->help_info );
        } else{
            $data = array(  'title' => 'Unable to Update Package Type',
                'message' => 'Package type reference not found' );
        }

        return json_encode($data);
    }

    public function update_package_type($slug, $id, PackageTypeRequest $request)
    {
        $id = $request->id;
        $type_name = $request->type_name;
        $price = $request->price;
        $help_info = $request->help_info;

        if($id != 0){
            $package_type = PackageType::whereId($id)->firstOrFail();

            if(count($package_type) == 0)
                return json_encode(array('type' => 'error', 'title' => 'Unable to Update Package Type', 'message' => 'Package type reference not found'));
            else{
                $package_type->type_name = $type_name;
                $package_type->price = $price;
                $package_type->help_info = $help_info;
                $package_type->save();

                return json_encode(array('type' => 'success', 'title' => 'Package Type Updated', 'message' => 'New package type information has been saved'));
            }
        } else{
            $tour_package = TourPackage::whereSlug($slug)->firstOrFail();

            if(count($tour_package) == 0)
                return json_encode(array('type' => 'error', 'title' => 'Unable to Update Package Type', 'message' => 'Tour package reference not found'));
            else{
                $package_type = new PackageType;
                $package_type->package_id = $tour_package->id;
                $package_type->type_name = $type_name;
                $package_type->price = $price;
                $package_type->help_info = $help_info;
                $package_type->save();

                return json_encode(array('type' => 'success', 'title' => 'New Package Type Saved', 'message' => 'New package type information has been saved'));
            }
        }
    }

    public function delete_package_type($slug, $id)
    {
        DB::table('package_types')->delete($id);
    }

    public function delete_tour_package($id)
    {
        DB::table('package_types')->where('package_id', $id)->delete();
        DB::table('tour_packages')->delete($id);
    }
}
