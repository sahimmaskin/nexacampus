<?php

namespace App\Controllers;

use App\Models\ProductCategoriesModel;
use App\Models\ProductTypesModel;

class HomeController extends BaseController
{
	public function __construct()
    {        
        helper(['form', 'url', 'custom']);
    }

    public function index()
    {
    	return redirect()->to('admin/login');
    }

    // public function checkQrCode($encodedValue='')
    // {
    // 	$code = 'AgroVishalQr';
    	
    // 	//print $encodedValue;

    // 	$decodedValue = (!empty($encodedValue)) ? decrypt_url_safe($encodedValue) : null;
    	
    // 	//exit;

    // 	if ($decodedValue == $code) {

    //         session()->set([
    //             'isQrcode'   => true,
    //         ]);

    // 		return redirect()->to('know-your-seed');
    // 	} else {
    // 		return redirect()->to('');
    // 	}
    // }

    // public function seedDetails($value='')
    // {
    //     /*if (!session()->get('isQrcode')) {
    //         return redirect()->to('');
    //     }*/
    // 	$productCategoriesModel = new ProductCategoriesModel();
    // 	$productTypesModel = new ProductTypesModel();

    // 	$data = [
    // 		'catList'       => $productCategoriesModel->where('status','Active')->where('parent_id',NULL)->findAll(),
    //         'typeList'      => $productTypesModel->where('status','Active')->findAll(),
    // 	];

    // 	return view('front/seedDetails', $data);
    // }
}
