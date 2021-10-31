<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\DistrictService;
use App\Services\ProvinceService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    public function __construct(
        ProvinceService $provinceService,
        DistrictService $districtService
    )
    {
        $this->provinceService = $provinceService;
        $this->districtService = $districtService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function province($id)
    {
        $province = $this->provinceService->find($id);
        if ($province) {
            $districts = $province->districts;
            $districtOptionsView = view('admin.pages.districts.components.district-options', compact('districts'))->render();
            $province['district-options'] = $districtOptionsView;
            return $this->apiSendSuccess($province, Response::HTTP_OK, 'Tìm tỉnh/thành thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Tìm tỉnh/thành thất bại');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function district($id)
    {
        $district = $this->districtService->find($id);
        if ($district) {
            $wards = $district->wards;
            $wardOptionsView = view('admin.pages.wards.components.ward-options', compact('wards'))->render();
            $district['ward-options'] = $wardOptionsView;
            return $this->apiSendSuccess($district, Response::HTTP_OK, 'Tìm quận/huyện thành công');
        }
        return $this->apiSendError(null, Response::HTTP_BAD_REQUEST, 'Tìm quận/huyện thất bại');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
