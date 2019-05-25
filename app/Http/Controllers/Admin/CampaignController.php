<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, Exception;
use Hash;
use App\CampaignCard;

class CampaignController extends Controller
{
    // cais que' gi cuxng extends Controller =))
    public function index()
    {
    	$campaigns = DB::table('campaigns')->where('del_flg', 0)->paginate(10);
    	return view('admin.campaign.index',compact('campaigns'));
    }

    public function create(Request $req, $id = '')
    {
		if ($req->isMethod('get')) {
			if ($id) {
    			$campaign = DB::table('campaigns')->where('id', $id)->first();
    			if (!$campaign) {
    				return redirect()->route('campaignIndex');
    			}
    			$cards = DB::table('campaign_cards')->where('campaign_id', $campaign->id)->get();
    		}
			return view('admin.campaign.create', compact('campaign', 'cards'));
		}
		if ($req->isMethod('POST')) {
			$data = $req->only('campaign_name', 'campaign_expired', 'campaign_type', 'campaign_value', 'card_numb');
			$data['created_at'] = date('Y-m-d H:i:s');
			$data['updated_at'] = date('Y-m-d H:i:s');
			if ($id) {
				try {
					DB::beginTransaction();
					if ($req->card_numb > $req->card_numb_old) {
						$newCards = [];
						for ($i=0; $i < $req->card_numb - $req->card_numb_old; $i++) { 
							$newCards[] = [
								'campaign_id' => $id,
								'card_code'   => substr(str_random(rand(1, 1000000)), 0, 13),
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s'),
							];
						}
						DB::table('campaign_cards')->insert($newCards);
					}
					DB::table('campaigns')->where('id', $id)->update($data);
					DB::commit();
				} catch (Exception $e) {
					DB::rollBack();
				}
			} else {
				try {
					DB::beginTransaction();
					$campaignId = DB::table('campaigns')->insertGetId($data);
					$cards = [];
					for ($i=0; $i < $req->card_numb; $i++) { 
						$cards[] = [
							'campaign_id' => $campaignId,
							'card_code'   => substr(str_random(rand(1, 1000000)), 0, 13),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						];
					}
					DB::table('campaign_cards')->insert($cards);
					DB::commit();
				} catch (Exception $e) {
					DB::rollBack();
				}
				
			}
		}
    	return redirect()->route('campaignIndex');
    }

    public function delete($id)
    {
    	try {
    		DB::beginTransaction();
			DB::table('campaign_cards')->where('campaign_id', $id)->update(['del_flg' => 1]);
			DB::table('campaigns')->where('id', $id)->update(['del_flg' => 1]);
			DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();
    	}
    	return redirect()->route('campaignIndex');
    }

    public function getCard(){
    	$data = DB::table('campaign_cards')->get();
    	return view('admin.campaign_cart.index', compact('data'));
    }
    public function getDeleteList($id){
        $listid = explode(",",$id);
        dd($listid);
        foreach($listid as $listid_item){
            $data = CampaignCard::findOrFail($listid_item);
            $data->delete();
        }
        return redirect(route('campaignCardIndex'))->with('status','Xóa thành công');
    }

}
