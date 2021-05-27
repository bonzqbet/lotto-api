<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
class ScraperController extends Controller
{
    //
    private $states = array();
    private $prizeFirst = array();
    private $prizeFirstNear = array();
    private $prizeSecond = array();
    private $prizeThird = array();
    private $prizeForth = array();
    private $prizeFifth = array();
    private $runningNumberFrontThree = array();
    private $runningNumberBackThree = array();
    private $runningNumberBackTwo = array();
    private $dateseclecter = array();

    public function scraper($DateSelect){ // check lottery 
        $client = new Client();
        // $page = $client->request('GET','https://news.sanook.com/lotto/check/16052500/');
        $page = $client->request('GET','https://news.sanook.com/lotto/check/'.$DateSelect.'/');
        $url = 'https://news.sanook.com/lotto/check/'.$DateSelect.'/';
        
        $this->states['status'] = 'success';
        $this->states['response']['date'] = $page->filter('#contentPrint > header > h2')->text();
        $this->states['response']['endpoint'] = $url;
        //ราลวัลที่ 1
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(1) > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirst['id'] = 'prizeFirst';
            $this->prizeFirst['name'] = 'รางวัลที่ 1';
            $this->prizeFirst['reward'] = '6000000';
            $this->prizeFirst['amount'] = $i+=1;
            $this->prizeFirst['number'][] = $item->text();
        });
        //ราลวัลเลขข้างเคียงรางวัลที่ 1 
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__sec--nearby > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirstNear['id'] = 'prizeFirstNear';
            $this->prizeFirstNear['name'] = 'รางวัลข้างเคียงรางวัลที่ 1';
            $this->prizeFirstNear['reward'] = '100000';
            $this->prizeFirstNear['amount'] = $i+=1;
            $this->prizeFirstNear['number'][] = $item->text();
        });
        //ราลวัลที่ 2
        $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(2) > div > span.lotto__number')->each(function($item,$i){
            $this->prizeSecond['id'] = 'prizeSecond';
            $this->prizeSecond['name'] = 'รางวัลที่ 2';
            $this->prizeSecond['reward'] = '200000';
            $this->prizeSecond['amount'] = $i+=1;
            $this->prizeSecond['number'][] = $item->text();
        });
        //ราลวัลที่ 3
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(3) > div > span')->each(function($item,$i){
            $this->prizeThird['id'] = 'prizeThird';
            $this->prizeThird['name'] = 'รางวัลที่ 3';
            $this->prizeThird['reward'] = '80000';
            $this->prizeThird['amount'] = $i+=1;
            $this->prizeThird['number'][] = $item->text();
        });
        //ราลวัลที่ 4
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--font-mini.lottocheck__sec--bdnoneads > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeForth['id'] = 'prizeForth';
            $this->prizeForth['name'] = 'รางวัลที่ 4';
            $this->prizeForth['reward'] = '40000';
            $this->prizeForth['amount'] = $i+=1;
            $this->prizeForth['number'][] = $item->text();
        });
        //ราลวัลที่ 5
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(6) > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeFifth['id'] = 'prizeFifth';
            $this->prizeFifth['name'] = 'รางวัลที่ 5';
            $this->prizeFifth['reward'] = '20000';
            $this->prizeFifth['amount'] = $i+=1;
            $this->prizeFifth['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(2) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberFrontThree['id'] = 'runningNumberFrontThree';
            $this->runningNumberFrontThree['name'] = 'รางวัลเลขหน้า 3 ตัว';
            $this->runningNumberFrontThree['reward'] = '4000';
            $this->runningNumberFrontThree['amount'] = $i+=1;
            $this->runningNumberFrontThree['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
          $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(3) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackThree['id'] = 'runningNumberBackThree';
            $this->runningNumberBackThree['name'] = 'รางวัลเลขหลัง 3 ตัว';
            $this->runningNumberBackThree['reward'] = '4000';
            $this->runningNumberBackThree['amount'] = $i+=1;
            $this->runningNumberBackThree['number'][] = $item->text();
        });
         //รางวัลเลขท้าย 2 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(4) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackTwo['id'] = 'runningNumberBackTwo';
            $this->runningNumberBackTwo['name'] = 'รางวัลเลขท้าย 2 ตัว';
            $this->runningNumberBackTwo['reward'] = '2000';
            $this->runningNumberBackTwo['amount'] = $i+=1;
            $this->runningNumberBackTwo['number'][] = $item->text();
        });

        $this->states['response']['prizes'][] =  $this->prizeFirst;
        $this->states['response']['prizes'][] =  $this->prizeFirstNear;
        $this->states['response']['prizes'][] =  $this->prizeSecond;
        $this->states['response']['prizes'][] =  $this->prizeThird;
        $this->states['response']['prizes'][] =  $this->prizeForth;
        $this->states['response']['prizes'][] =  $this->prizeFifth;
        $this->states['response']['prizes'][] =  $this->runningNumberFrontThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackTwo;
        return response($this->states,200);
    }

    public function scraperShow(Request $DateSelect){ // show All value in table
        $dateSeclectd = $DateSelect->input()['DateSelect'];
        $client = new Client();
        $page = $client->request('GET','https://news.sanook.com/lotto/check/'.$dateSeclectd.'/');
        $url = 'https://news.sanook.com/lotto/check/'.$dateSeclectd.'/';
        
        $this->states['status'] = 'success';
        $this->states['response']['date'] = $page->filter('#contentPrint > header > h2')->text();
        $this->states['response']['endpoint'] = $url;
        //ราลวัลที่ 1
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(1) > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirst['id'] = 'prizeFirst';
            $this->prizeFirst['name'] = 'รางวัลที่ 1';
            $this->prizeFirst['reward'] = '6000000';
            $this->prizeFirst['amount'] = $i+=1;
            $this->prizeFirst['number'][] = $item->text();
        });
        //ราลวัลเลขข้างเคียงรางวัลที่ 1 
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__sec--nearby > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirstNear['id'] = 'prizeFirstNear';
            $this->prizeFirstNear['name'] = 'รางวัลข้างเคียงรางวัลที่ 1';
            $this->prizeFirstNear['reward'] = '100000';
            $this->prizeFirstNear['amount'] = $i+=1;
            $this->prizeFirstNear['number'][] = $item->text();
        });
        //ราลวัลที่ 2
        $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(2) > div > span.lotto__number')->each(function($item,$i){
            $this->prizeSecond['id'] = 'prizeSecond';
            $this->prizeSecond['name'] = 'รางวัลที่ 2';
            $this->prizeSecond['reward'] = '200000';
            $this->prizeSecond['amount'] = $i+=1;
            $this->prizeSecond['number'][] = $item->text();
        });
        //ราลวัลที่ 3
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(3) > div > span')->each(function($item,$i){
            $this->prizeThird['id'] = 'prizeThird';
            $this->prizeThird['name'] = 'รางวัลที่ 3';
            $this->prizeThird['reward'] = '80000';
            $this->prizeThird['amount'] = $i+=1;
            $this->prizeThird['number'][] = $item->text();
        });
        //ราลวัลที่ 4
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--font-mini.lottocheck__sec--bdnoneads > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeForth['id'] = 'prizeForth';
            $this->prizeForth['name'] = 'รางวัลที่ 4';
            $this->prizeForth['reward'] = '40000';
            $this->prizeForth['amount'] = $i+=1;
            $this->prizeForth['number'][] = $item->text();
        });
        //ราลวัลที่ 5
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(6) > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeFifth['id'] = 'prizeFifth';
            $this->prizeFifth['name'] = 'รางวัลที่ 5';
            $this->prizeFifth['reward'] = '20000';
            $this->prizeFifth['amount'] = $i+=1;
            $this->prizeFifth['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(2) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberFrontThree['id'] = 'runningNumberFrontThree';
            $this->runningNumberFrontThree['name'] = 'รางวัลเลขหน้า 3 ตัว';
            $this->runningNumberFrontThree['reward'] = '4000';
            $this->runningNumberFrontThree['amount'] = $i+=1;
            $this->runningNumberFrontThree['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
          $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(3) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackThree['id'] = 'runningNumberBackThree';
            $this->runningNumberBackThree['name'] = 'รางวัลเลขหลัง 3 ตัว';
            $this->runningNumberBackThree['reward'] = '4000';
            $this->runningNumberBackThree['amount'] = $i+=1;
            $this->runningNumberBackThree['number'][] = $item->text();
        });
         //รางวัลเลขท้าย 2 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(4) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackTwo['id'] = 'runningNumberBackTwo';
            $this->runningNumberBackTwo['name'] = 'รางวัลเลขท้าย 2 ตัว';
            $this->runningNumberBackTwo['reward'] = '2000';
            $this->runningNumberBackTwo['amount'] = $i+=1;
            $this->runningNumberBackTwo['number'][] = $item->text();
        });

        $this->states['response']['prizes'][] =  $this->prizeFirst;
        $this->states['response']['prizes'][] =  $this->prizeFirstNear;
        $this->states['response']['prizes'][] =  $this->prizeSecond;
        $this->states['response']['prizes'][] =  $this->prizeThird;
        $this->states['response']['prizes'][] =  $this->prizeForth;
        $this->states['response']['prizes'][] =  $this->prizeFifth;
        $this->states['response']['prizes'][] =  $this->runningNumberFrontThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackTwo;
        return response($this->states,200);
    }

    public function viewAPI(Request $req){ // show API
        $datepick = $req->input()['date'];
        $client = new Client();
        $page = $client->request('GET','https://news.sanook.com/lotto/check/'.$datepick.'/');
        $url = 'https://news.sanook.com/lotto/check/'.$datepick.'/';
        
        $this->states['status'] = 'success';
        $this->states['response']['date'] = $page->filter('#contentPrint > header > h2')->text();
        $this->states['response']['endpoint'] = $url;
        //ราลวัลที่ 1
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(1) > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirst['id'] = 'prizeFirst';
            $this->prizeFirst['name'] = 'รางวัลที่ 1';
            $this->prizeFirst['reward'] = '6000000';
            $this->prizeFirst['amount'] = $i+=1;
            $this->prizeFirst['number'][] = $item->text();
        });
        //ราลวัลเลขข้างเคียงรางวัลที่ 1 
        $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__sec--nearby > strong.lotto__number')->each(function($item,$i){
            $this->prizeFirstNear['id'] = 'prizeFirstNear';
            $this->prizeFirstNear['name'] = 'รางวัลข้างเคียงรางวัลที่ 1';
            $this->prizeFirstNear['reward'] = '100000';
            $this->prizeFirstNear['amount'] = $i+=1;
            $this->prizeFirstNear['number'][] = $item->text();
        });
        //ราลวัลที่ 2
        $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(2) > div > span.lotto__number')->each(function($item,$i){
            $this->prizeSecond['id'] = 'prizeSecond';
            $this->prizeSecond['name'] = 'รางวัลที่ 2';
            $this->prizeSecond['reward'] = '200000';
            $this->prizeSecond['amount'] = $i+=1;
            $this->prizeSecond['number'][] = $item->text();
        });
        //ราลวัลที่ 3
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(3) > div > span')->each(function($item,$i){
            $this->prizeThird['id'] = 'prizeThird';
            $this->prizeThird['name'] = 'รางวัลที่ 3';
            $this->prizeThird['reward'] = '80000';
            $this->prizeThird['amount'] = $i+=1;
            $this->prizeThird['number'][] = $item->text();
        });
        //ราลวัลที่ 4
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--font-mini.lottocheck__sec--bdnoneads > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeForth['id'] = 'prizeForth';
            $this->prizeForth['name'] = 'รางวัลที่ 4';
            $this->prizeForth['reward'] = '40000';
            $this->prizeForth['amount'] = $i+=1;
            $this->prizeForth['number'][] = $item->text();
        });
        //ราลวัลที่ 5
         $page->filter('#contentPrint > div.lottocheck__resize > div:nth-child(6) > div.lottocheck__box-item > span.lotto__number')->each(function($item,$i){
            $this->prizeFifth['id'] = 'prizeFifth';
            $this->prizeFifth['name'] = 'รางวัลที่ 5';
            $this->prizeFifth['reward'] = '20000';
            $this->prizeFifth['amount'] = $i+=1;
            $this->prizeFifth['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(2) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberFrontThree['id'] = 'runningNumberFrontThree';
            $this->runningNumberFrontThree['name'] = 'รางวัลเลขหน้า 3 ตัว';
            $this->runningNumberFrontThree['reward'] = '4000';
            $this->runningNumberFrontThree['amount'] = $i+=1;
            $this->runningNumberFrontThree['number'][] = $item->text();
        });
        //รางวัลเลขหน้า 3 ตัว
          $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(3) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackThree['id'] = 'runningNumberBackThree';
            $this->runningNumberBackThree['name'] = 'รางวัลเลขหลัง 3 ตัว';
            $this->runningNumberBackThree['reward'] = '4000';
            $this->runningNumberBackThree['amount'] = $i+=1;
            $this->runningNumberBackThree['number'][] = $item->text();
        });
         //รางวัลเลขท้าย 2 ตัว
         $page->filter('#contentPrint > div.lottocheck__resize > div.lottocheck__sec.lottocheck__sec--bdnone > div.lottocheck__table > div:nth-child(4) > strong.lotto__number')->each(function($item,$i){
            $this->runningNumberBackTwo['id'] = 'runningNumberBackTwo';
            $this->runningNumberBackTwo['name'] = 'รางวัลเลขท้าย 2 ตัว';
            $this->runningNumberBackTwo['reward'] = '2000';
            $this->runningNumberBackTwo['amount'] = $i+=1;
            $this->runningNumberBackTwo['number'][] = $item->text();
        });

        $this->states['response']['prizes'][] =  $this->prizeFirst;
        $this->states['response']['prizes'][] =  $this->prizeFirstNear;
        $this->states['response']['prizes'][] =  $this->prizeSecond;
        $this->states['response']['prizes'][] =  $this->prizeThird;
        $this->states['response']['prizes'][] =  $this->prizeForth;
        $this->states['response']['prizes'][] =  $this->prizeFifth;
        $this->states['response']['prizes'][] =  $this->runningNumberFrontThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackThree;
        $this->states['response']['prizes'][] =  $this->runningNumberBackTwo;
        echo '<pre>';
        print_r($this->states);
    }

    public function screaperDate(Request $req){ //get date in selected form
        // dd($req->input());
        $client = new Client();
        $page = $client->request('GET','https://news.sanook.com/lotto/');
        $url = 'https://news.sanook.com/lotto/';
        
        $page->filter('div.lotto-form > form#lotto-checkbox > select#lotto-checkbox-date > option')->each(function($item,$i){
            $this->dateseclecter['data'][][$item->attr('value')] = $item->text();
            $this->dateseclecter['status'] = 'success';
        });
        return response($this->dateseclecter,200);
    }

}
