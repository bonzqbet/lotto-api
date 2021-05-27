@extends('layout')

@section('content')
  <div class="container my-5">
    <h2>ตรวจผลสลากกินแบ่งรัฐบาล</h2>
    <p>งวดวันที่</p>
    <form id="form-input">
      <div class="form-group">
        <select name="date" id="date-select" class="form-control select-size" >
        </select>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="usr" name="code[]" maxlength="6" placeholder="กรอกเลขสลาก ใบที่ 1">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="usr1" name="code[]" maxlength="6" placeholder="กรอกเลขสลาก ใบที่ 2">
      </div>
      <div class="form-group">
        <input type="text" class="form-control" id="usr2" name="code[]" maxlength="6" placeholder="กรอกเลขสลาก ใบที่ 3">
      </div>
      <div class="btn btn-primary" onclick="getRequest()">ตรวจสลากฯ ของคุณ</div>
      <div class="btn btn-secondary" onclick="API()">API</div>
    </form>



    <h2 >ผลการตรวจสลากหมายเลข</h2>
    <p class="show-date">งวดวันที่ 2 พฤษภาคม 2564</p>
    <div class="d-flex p-3 gb-color text-white show-status">
      
  </div>

  <div class="text-title mt-5 alight-center hiddenClass">
    <h2>ผลสลากกินแบ่งรัฐบาล</h2>
    <h2 class="textAnoucer font-red"></h2>
  </div>

  <div class="grid-container hiddenClass DivbuttomBorder">
    <div class="grid-item">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><span class="font-red">รางวัลที่ 1</span><br><small>รางวัลละ 6,000,000 บาท</small></th>
          </tr>
        </thead>
        <tbody>
          <tr class="PrizeFirst">
              <td class="SetColer"></td>
          </tr>
        </tbody>
    </table>
    </div>
    <div class="grid-item">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><span class="font-red">เลขหน้า 3 ตัว</span><br><small>2 รางวัลๆละ 4,000 บาท</small></th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td class="PrizeNumberFrontThree SetColer"></td>
          </tr>
        </tbody>
    </table>
    </div>
    <div class="grid-item">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><span class="font-red">เลขท้าย 3 ตัว</span><br><small>2 รางวัลๆละ 4,000 บาท</small></th>
          </tr>
        </thead>
        <tbody >
          <tr>
            <td class="PrizeNumberBackThree SetColer"></td>
          </tr>
        </tbody>
    </table>
    </div>
    <div class="grid-item">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><span class="font-red">เลขท้าย 2 ตัว</span><br><small>1 รางวัลๆละ 2,000 บาท</small></th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td class="PrizeNumberBackTwo SetColer"></td>
          </tr>
        </tbody>
    </table>
    </div> 
    
  </div>

  <div class="grid-container2 hiddenClass">
    <div class="grid-item">
      <span class="font-red"> รางวัลข้างเคียงรางวัลที่ 1</span><br>
      <small>2 รางวัลๆละ 100,000 บาท</small>
    </div>
    <div class="grid-item">
      <span class="PrizeFirstNear1"></span>
    </div>
    <div class="grid-item">
      <span class="PrizeFirstNear2"></span>
    </div>
  </div>

  <p class="PrizeSecondText alight-center font-red"></p>
  <table class="table table-striped alight-center">
    <tbody class="PrizeSecond">
    </tbody>
  </table>

  <p class="PrizeThirdText alight-center font-red"></p>
  <table class="table table-striped alight-center">
    <tbody class="PrizeThird">
    </tbody>
  </table>

  <p class="PrizeForthText alight-center font-red"></p>
  <table class="table table-striped alight-center">
    <tbody class="PrizeForth">
    </tbody>
  </table>

  <p class="PrizeFifthText alight-center font-red"></p>
  <table class="table table-striped alight-center">
    <tbody class="PrizeFifth">
    </tbody>
  </table>

@endsection


