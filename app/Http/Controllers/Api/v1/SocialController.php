<?php
/**
 * Created by PhpStorm.
 * User: ssd
 * Date: 8/26/16
 * Time: 5:10 PM
 */

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseAdminController\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SocialController extends Controller{

    private $number_row = 10;
    public function getSocial(Request $request){
        sleep(5);
        $page = $request->get('page');
        $sessionMessage = "";
        $returnData = array();

//      $yesterday = date('d.m.Y',strtotime("-1 days"));
        $currentHours  = (int)date("H");
        $type = 1;
        if($currentHours>0 && $currentHours < 18){
            $type = 1;
            $sessionMessage = "";
        }else{
            $type = 2;
            $sessionMessage = "";
        }
        $message = array();
        $message['welcome_message'] = "";
        $message['event_message'] = "";
        $msgData = array();
        if($page == 0) {
            $today = date("d/m/Y");
            if($type == 1){
                $msgData = DB::table("welcome_message")
                    ->select('welcome_msg','event_msg','avatar_morning as avatar')
                    ->where([['type','=',2],['active','=',1]])->get();
            }else{
                $msgData = DB::table("welcome_message")
                    ->select('welcome_msg','event_msg','avatar_night as avatar')
                    ->where([['type','=',2],['active','=',1]])->get();
            }

            $message['welcome_message'] = count($msgData) > 0 ?$msgData[0]['welcome_msg']." ".$sessionMessage." ".$today : "Xu hướng hôm nay"." ".$today;
            $message['event_message'] = count($msgData) > 0 ? $msgData[0]['event_msg'] : "";
            $message['avatar'] = count($msgData) > 0 ?$msgData[0]['avatar'] : "empty avatar";
        }
        $returnData = $this->querySimpleData($page);
        $returnData = $this->addAdvertisementData($returnData,$page);
        $data['message'] = $message;
        $data['data'] = $returnData;
        return response(json_encode($data),200);
    }
    public function querySimpleData($page){

        $social_media ='social_media';
        $fan_page ='fan_page';
        $social_content_type = "social_content_type";
        $social_info = 'social_info';
        $data = DB::table($social_media)->join($fan_page,$social_media.'.fan_page_id','=',$fan_page.'.id')
            ->join($social_content_type,$social_content_type.'.id','=',$social_media.'.social_content_type_id')
            ->join($social_info,$social_info.'.id','=',$fan_page.'.social_info_id')
            ->select($social_media.'.id',$social_media.'.title',$social_media.'.post_image_url',$social_media.'.separate_image_tag'
                ,$social_media.'.full_link',$fan_page.'.name as fanpage_name',$social_content_type.'.type as social_content_type_id',$social_media.'.is_ads',$social_media.'.ads_code'
                ,$fan_page.'.logo as fanpage_logo',
                $social_info.'.name as social_name',$social_info.'.logo as social_logo',$social_info.'.color_tag',$social_info.'.video_tag')
            ->where([['social_media.active',1],['fan_page.active',1],['social_info.active',1],['social_content_type.active',1]])
            ->offset($page*$this->number_row)->limit($this->number_row)->orderBy('social_media.created_at','desc')->get();
        return $data;
    }
    public function addAdvertisementData(Array $data,$page){

        $fakeArray = array('id' => 0,'title' => ' ','post_image_url' => ' ',
            'separate_image_tag' => ' ','full_link' => ' ','fanpage_name' => ' ','social_content_type_id' => 4,
            'fanpage_logo' => ' ','social_name'=>'Facebook','social_logo'=>' ',
            'color_tag' => '#7ED321','video_tag' => '','is_ads' => 1,'ads_code' => ' ');
        $adsData = DB::table('advertisement')->select('post_image','full_link','at_page','at_position','ads_code')
            ->where('active','=','1')->get();
        if(count($adsData) > 0) {
            foreach ($adsData as $value){
                if($value['at_page'] == $page){
                    $countData = count($data);
                    $value['at_position'] = $value['at_position'] >= $countData?$countData-1 : $value['at_position'];
                    $fakeArray['post_image'] = $value['post_image'];
                    $fakeArray['full_link'] = $value['full_link'];
                    $fakeArray['ads_code'] = $value['ads_code'];
                    array_splice($data,$value['at_position'],0,array($fakeArray));
                }
            }
        }
        return $data;

    }

    public function getSocial2($page){
        $number_row = 10;
        $social_media ='social_media';
        $fan_page ='fan_page';
        $social_content_type = "social_content_type";
        $social_info = 'social_info';
        $data = DB::table($social_media)->join($fan_page,$social_media.'.fan_page_id','=',$fan_page.'.id')
            ->join($social_content_type,$social_content_type.'.id','=',$social_media.'.social_content_type_id')
            ->join($social_info,$social_info.'.id','=',$fan_page.'.social_info_id')
            ->select($social_media.'.title',$social_media.'.post_image_url',$social_media.'.separate_image_tag'
                ,$social_media.'.full_link',$fan_page.'.name as fanpage_name',$social_media.'.social_content_type_id'
                ,$fan_page.'.logo as fanpage_logo',
                $social_info.'.name as social_name',$social_info.'.logo as social_logo',$social_info.'.color_tag',$social_info.'.video_tag')
            ->where([['social_media.active',1],['fan_page.active',1],['social_info.active',1],['social_content_type.active',1]])
            ->offset($page*$number_row)->limit($number_row)->orderBy('social_media.created_at','desc')->get();
         return response(json_encode($data),200);
    }

}