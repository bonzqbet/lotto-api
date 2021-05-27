<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ScraperController;

class CheckControler extends Controller
{
    //
    protected $scraper;
    public function __construct(ScraperController $scraper)
    {
        $this->scraper = $scraper;
    }

    public function check(Request $code){
        $data = $this->scraper->scraper($code->input()['DateSelect']);
        $arrCode = $code->input();
        if($data->original['status'] == 'success'){
            $arrAPI = $data->original['response']['prizes'];
            $arrID = ['prizeFirst','prizeFirstNear','prizeSecond','prizeThird','prizeForth','prizeFifth'];
            $arrIDsub = ['runningNumberBackThree','runningNumberBackTwo','runningNumberFrontThree'];
            $arrResult = array();
            $resultPrizeSub = array();
            $CodeSub = array();

            // setup
            $arrResult['data']['date'] = $data->original['response']['date'];
            $arrResult['data']['endpoint'] = $data->original['response']['endpoint'];
            foreach ($arrAPI as $key => $valueAPI) {
                    for ($i=0; $i < count($arrCode['code']); $i++) {   // check รางวัลที่ 1-6
                        foreach ($valueAPI['number'] as $keyNumber => $valueNumber) {
                            if($arrCode['code'][$i] == $valueNumber){
                                $arrResult['data'][$valueAPI['id']]['name'] = $valueAPI['name'];              
                                $arrResult['data'][$valueAPI['id']]['reward'] = number_format($valueAPI['reward']);              
                                $arrResult['data'][$valueAPI['id']]['number'][] = $valueNumber;    
                                $arrResult['status'] = 'success';          
                            }
                        }
                    }
                    for ($index_sub=0; $index_sub < count($arrIDsub); $index_sub++) {   // check รางวัลเลขหลัง 3 ตัว และ 2 ตัว
                        if($valueAPI['id'] == 'runningNumberBackThree'){ // รางวัลเลขหลัง 3 ตัว
                            $CodeSub = SubstrCode($arrCode['code'][$index_sub]);
                            if($valueAPI['id'] == 'runningNumberBackThree'){
                                foreach ($valueAPI['number'] as $keyPrize => $valuePrize) {
                                    if($CodeSub == $valuePrize){
                                        $arrResult['data'][$valueAPI['id']]['name'] = $valueAPI['name'];              
                                        $arrResult['data'][$valueAPI['id']]['reward'] = number_format($valueAPI['reward']);              
                                        $arrResult['data'][$valueAPI['id']]['number'][] = $arrCode['code'][$index_sub];
                                        $arrResult['status'] = 'success';          
                                    }
                                }
                            }
                        }
                        if($valueAPI['id'] == 'runningNumberBackTwo'){ //รางวัลเลขหลัง 2 ตัว
                            $CodeSub2Digit = SubstrCode2Digit($arrCode['code'][$index_sub]);
                            foreach ($valueAPI['number'] as $keyPrize => $valuePrize) {
                                if($CodeSub2Digit == $valuePrize){
                                    $arrResult['data'][$valueAPI['id']]['name'] = $valueAPI['name'];              
                                    $arrResult['data'][$valueAPI['id']]['reward'] = number_format($valueAPI['reward']);              
                                    $arrResult['data'][$valueAPI['id']]['number'][] = $arrCode['code'][$index_sub];
                                    $arrResult['status'] = 'success';          
                                }
                            }
                        }
                        if($valueAPI['id'] == 'runningNumberFrontThree'){ //รางวัลเลขหน้า 3 ตัว
                            $CodeSubfront = SubstrCodefront($arrCode['code'][$index_sub]);
                            foreach ($valueAPI['number'] as $keyPrize => $valuePrize) {
                                if($CodeSubfront == $valuePrize){
                                    $arrResult['data'][$valueAPI['id']]['name'] = $valueAPI['name'];              
                                    $arrResult['data'][$valueAPI['id']]['reward'] = number_format($valueAPI['reward']);              
                                    $arrResult['data'][$valueAPI['id']]['number'][] = $arrCode['code'][$index_sub];
                                    $arrResult['status'] = 'success';          
                                }
                            }
                        }
                    }
            }
        }
        return response($arrResult,200);
    }
    

}
