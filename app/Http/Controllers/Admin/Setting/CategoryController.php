<?php
/**
 * Created by PhpStorm.
 * User: ssd
 * Date: 1/21/17
 * Time: 2:10 PM
 */
namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\BaseAdminController\CDUAbstractController;
use App\Http\Controllers\BaseAdminController\CDUController;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends CDUAbstractController {

    private $mRouter = ['GET' => 'get_category', 'POST' => 'post_category'];
    private $uniqueFields = array('name');
    private $privateKey = 'id';
    private $validateForm = ['name'=>'required|max:255'];
    private $validateFormUpdate = ['name'=>'required|max:255'];
    private $pagingNumber = 10;
    private $validateMaker;
    public function __construct(){
        $this->validateMaker = Validator(array(),array(),array());
        parent::__construct(new Category(),$this->privateKey,$this->uniqueFields,$this->validateForm,null,$this->validateFormUpdate);
    }

    public function index(Request $request){
        $this->request = $request;
        $this->page = $request->get('page');
        if ($request->isMethod('POST')){
            $active = !empty($request->get('active')) ? 1 : 0 ;
            $progressData = ['active' => $active,'name' => $request->get('name')];
            $this->validateMaker = $this->progressPost($request,$progressData)->parseMessageToValidateMaker();
        }
        if ($request->isMethod('GET')){
            $this->validateMaker = $this->progressGet($request)->parseMessageToValidateMaker();
        }
        return $this->returnView(null);
    }

    public function returnView($data){
        $listData = $this->mainModel->orderBy('created_at')->paginate($this->pagingNumber);
        $view = view('admin/setting/category.categoryIndex',['router' => $this->mRouter,'listData'=>$listData,
            'page'=>$this->page,'isEdit'=>$this->request->get('isEdit'),
            'update_data' =>$this->mUpdateData]);

        if($this->validateMaker!=null && count($this->validateMaker->errors()->toArray())>0){
            $message = $this->validateMaker->errors();
            return $view->withErrors($message);
        }

        return $view;

    }
}