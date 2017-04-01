<?php
/**
 * Created by PhpStorm.
 * User: ssd
 * Date: 3/1/17
 * Time: 4:07 PM
 */

namespace App\Http\Controllers\Admin\Setting;


use App\Http\Controllers\BaseAdminController\CDUAbstractController;
use App\Models\Category;
use App\Models\FanPage;
use App\Models\News;
use App\Models\NewsPaper;
use App\Models\Post;
use App\Models\SessionDay;
use App\Models\SocialInfo;
use Illuminate\Http\Request;
class NewPostController extends  CDUAbstractController{

    private $mRouter = array('GET' => 'get_new_post','POST' => 'post_new_post');
    private $uniqueFields = array('name');
    private $privateKey = 'id';
    private $fieldFile = array('image');
    private $fieldPath = array('image_path');
    private $foreignData ;
    private $validateForm = ['title'=>'required|max:255',
        'content' => 'required',
        'category_id' => 'required'];
    private $validateFormUpdate = array('title'=>'required|max:255','content' => 'required','category_id' => 'required');
    private $pagingNumber = 10;
    private $validateMaker;
    public function __construct(){
        $this->validateMaker = Validator(array(),array(),array());
        $category = ['fr_id' =>'category_id',
            'fr_data'=>$this->getDataByModel(new Category()),
            'fr_private_id' =>'id',
            'fr_select_field' => 'name',
            'label' => 'Category'
        ];

        $this->foreignData = [$category];
        parent::__construct(new Post(),$this->privateKey,$this->uniqueFields,$this->validateForm,$this->fieldFile,$this->validateFormUpdate,$this->fieldPath);
    }

    public function index(Request $request){
        $this->request = $request;
        $this->page = $request->get('page');
        if ($request->isMethod('POST')){
            $active = !empty($request->get('active')) ? 1 : 0 ;
            $progressData = ['active' => $active,
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'category_id' => $request->get('category_id'),
            ];
            $progressData =  $this->progressFileData($request,$this->fieldFile,$progressData);
            $result = $this->progressPost($request,$progressData);
            $this->validateMaker = $result->parseMessageToValidateMaker();
        }
        if ($request->isMethod('GET')){
            $this->validateMaker = $this->progressGet($request)->parseMessageToValidateMaker();
        }
        return $this->returnView(null);
    }

    public function returnView($data){

        $listData = $this->mainModel->orderBy('created_at')->paginate($this->pagingNumber);
        $view = view('admin/setting/post.postIndex',['router' => $this->mRouter,'listData'=>$listData,
            'page'=>$this->page,'isEdit'=>$this->request->get('isEdit'),
            'update_data' =>$this->mUpdateData,'foreignData' => $this->foreignData]);

        if($this->validateMaker!=null && count($this->validateMaker->errors()->toArray())>0){
            $message = $this->validateMaker->errors();
            return $view->withErrors($message);
        }

        return $view;

    }

}