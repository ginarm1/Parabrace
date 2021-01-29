<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use App\Model\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index(){
        return PartnerResource::collection(Partner::all());
    }
    public function show ($id){
        $partner = Partner::findOrFail($id);
        return new PartnerResource($partner);
    }
}
