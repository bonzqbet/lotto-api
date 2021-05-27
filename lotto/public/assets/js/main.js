
$(document).ready(function () {
  let url = '/loadDate';
  let element = $('#date-select');
  let valdate = $('#date-select').val();
  $.ajax({
           url:url,
           method:'GET',
           data:{date:valdate},
           success:function(response){
              if(response.status == 'success'){
                element.empty();
                jQuery.each(response['data'], function(index, item) {
                  jQuery.each(item, function(index, itemResult) {
                    element.append('<option value='+index+'>'+itemResult+'</option>')
                  });
                });
              }
           },
        });
});

function getRequest(){
  let data = $('#usr').val();
  let data1 = $('#usr1').val();
  let data2 = $('#usr2').val();
  let DateSelect = $('#date-select').val();
  let arr = [];
  let checkarr = [];
  let checkarrResult = [];
  arr.push(data);
  arr.push(data1);
  arr.push(data2);
  checkarr.push(data);
  checkarr.push(data1);
  checkarr.push(data2);

  
  if(data == '' && data1 == '' && data2 == ''){
    alert('กรุณาตรวจสอบหมายเลขสลากค่ะ');
    return false;
  }

  var arrVariable = [];
  let url = '/check';
  $.ajax({
    url:url,
    method:'GET',
    data:{code:arr,DateSelect:DateSelect},
    success:function(res){
      if(res.status == 'success'){
        let data = res.data;
        let arrVariable = ['prizeFirst','prizeFirstNear','prizeSecond','prizeThird','prizeForth','prizeFifth','runningNumberFrontThree','runningNumberBackThree','runningNumberBackTwo']; 
        $('.show-status').empty();
        for (let index = 0; index < arrVariable.length; index++) { // check หมวดหมูรางวัลที่ถูก
          if(data[arrVariable[index]] != null){ 
            for (let indexsub = 0; indexsub < data[arrVariable[index]]['number'].length; indexsub++) { // append html รางวัลที่ถูก
              $('.show-status').append('<div class="p-2 content"><h4>'+data[arrVariable[index]]['number'][indexsub]+'</h4><br><span>ถูก'+data[arrVariable[index]]['name']+'ค่ะ</span><br><span>มูลค่า '+data[arrVariable[index]]['reward']+' บาท</span></div>')
              removeItem(checkarr, data[arrVariable[index]]['number'][indexsub]); // pop รางวัลที่ถูกออก array
            }
          }
        }
        for (let i = 0; i < checkarr.length; i++) { // check เงื่อนไขไม่ถูกรางวัล
          if(checkarr[i] != ''){
            $('.show-status').append('<div class="p-2 content-danger"><h4>'+checkarr[i]+'</h4><br><span>ไม่ถูกรางวัล</span></div>');
          } 
        }
        $('.show-date').html(data.date); // set date show
        $('.textAnoucer').html(data.date); // set date show

      }else{ // check เงื่อนไขไม่ถูกรางวัล
        $('.show-date').html(res.data.date); // set date show
        $('.textAnoucer').html(res.data.date); // set date show
        $('.show-status').empty(); // set box empty
        for (let i = 0; i < arr.length; i++) {
          if(arr[i] != ''){
            $('.show-status').append('<div class="p-2 content-danger"><h4>'+arr[i]+'</h4><br><span>ไม่ถูกรางวัล</span></div>')
          }
        }
      }
      arr = [];
      checkarr = [];
      arrVariable = [];
    },
  });

  showAPI()
}

function showAPI(){
  $('.grid-container').removeClass('hiddenClass');
  $('.grid-container2').removeClass('hiddenClass');
  $('.text-title').removeClass('hiddenClass');
  let DateSelect = $('#date-select').val();
  let url = '/scraperShow';
  $.ajax({
    url:url,
    method:'GET',
    data:{DateSelect:DateSelect},
    success:function(respones){
      let arrVariable = ['prizeFirst','prizeFirstNear','prizeSecond','prizeThird','prizeForth','prizeFifth','runningNumberFrontThree','runningNumberBackThree','runningNumberBackTwo']; 
      let value = respones.response.prizes;
      if(respones.status = 'success'){
        for (let index = 0; index < arrVariable.length; index++) {
          let arrNumberSet10 = ['5','10'];
          let arrNumberSet50 = ['5','10','15','20','25','30','35','40','45','50'];
          let arrNumberSet100 = ['5','10','15','20','25','30','35','40','45','50','55','60','65','70','75','80','85','90','95','100'];

          if(value[index]['id'] == 'prizeForth'){ // show prizeForth
            $('.PrizeForthText').html('ผลสลากกินแบ่งรัฐบาล รางวัลที่ 4 มี 50 รางวัลๆละ 40,000 บาท');  // set value td 
            $('.PrizeForth').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box td
              for (let inOfsub = 0; inOfsub < arrNumberSet50.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet50[inOfsub]){ // set box tr
                  $('.PrizeForth').append('<tr>');  // set box tr
                  removeItem(arrNumberSet50, indexOf); // pop รางวัลที่ถูกออก array
                  break;
                }
              }

              $('.PrizeForth').append('<td>'+ value[index]['number'][indexOf]+'</td>');  // set value td

              for (let inOfsub = 0; inOfsub < arrNumberSet50.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet50[inOfsub]){ // set box tr
                  $('.PrizeForth').append('</tr>');  // set box tr
                  break;
                }
              }
            }
          }

          if(value[index]['id'] == 'prizeFifth'){ // show prizeFifth
            $('.PrizeFifthText').html('ผลสลากกินแบ่งรัฐบาล รางวัลที่ 5 มี 100 รางวัลๆละ 20,000 บาท');  // set value td 
            $('.PrizeFifth').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box td
              for (let inOfsub = 0; inOfsub < arrNumberSet100.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet100[inOfsub]){ // set box tr
                  $('.PrizeFifth').append('<tr>');  // set box tr
                  removeItem(arrNumberSet100, indexOf); // pop รางวัลที่ถูกออก array
                  break;
                }
              }

              $('.PrizeFifth').append('<td>'+ value[index]['number'][indexOf]+'</td>');  // set value td

              for (let inOfsub = 0; inOfsub < arrNumberSet100.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet100[inOfsub]){ // set box tr
                  $('.PrizeFifth').append('</tr>');  // set box tr
                  break;
                }
              }
            }
          }  

          if(value[index]['id'] == 'prizeThird'){ // show prizeThird
            $('.PrizeThirdText').html('ผลสลากกินแบ่งรัฐบาล รางวัลที่ 3 มี 10 รางวัลๆละ 80,000 บาท');  // set value td 
            $('.PrizeThird').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box td
              for (let inOfsub = 0; inOfsub < arrNumberSet10.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet10[inOfsub]){ // set box tr
                  $('.PrizeThird').append('<tr>');  // set box tr
                  removeItem(arrNumberSet10, indexOf); // pop รางวัลที่ถูกออก array
                  break;
                }
              }

              $('.PrizeThird').append('<td>'+ value[index]['number'][indexOf]+'</td>');  // set value td

              for (let inOfsub = 0; inOfsub < arrNumberSet10.length; inOfsub++) { // set box tr
                if(indexOf==arrNumberSet10[inOfsub]){ // set box tr
                  $('.PrizeThird').append('</tr>');  // set box tr
                  break;
                }
              }
            }
          }
          
          if(value[index]['id'] == 'prizeSecond'){ // show prizeSecond
            $('.PrizeSecondText').html('ผลสลากกินแบ่งรัฐบาล รางวัลที่ 2 มี 5 รางวัลๆละ 200,000 บาท');  // set value td 
            $('.PrizeSecond').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box td
              $('.PrizeSecond').append('<td>'+ value[index]['number'][indexOf]+'</td>');  // set value td
            }
          } 

          if(value[index]['id'] == 'runningNumberBackTwo'){ // show runningNumberBackTwo
            $('.PrizeNumberBackTwo').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box span
              $('.PrizeNumberBackTwo').append('<span>'+ value[index]['number'][indexOf]+'</span>');  // set value span
            }
          } 

          if(value[index]['id'] == 'runningNumberBackThree'){ // show runningNumberBackThree
            $('.PrizeNumberBackThree').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box span
              $('.PrizeNumberBackThree').append('<span class="ml-2">'+ value[index]['number'][indexOf]+'</span>');  // set value span
            }
          } 

          if(value[index]['id'] == 'runningNumberFrontThree'){ // show runningNumberFrontThree
            $('.PrizeNumberFrontThree').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box span
              $('.PrizeNumberFrontThree').append('<span class="ml-2">'+ value[index]['number'][indexOf]+'</span>');  // set value span
            }
          } 

          if(value[index]['id'] == 'prizeFirst'){ // show prizeFirst
            $('.PrizeFirst').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box span
              $('.PrizeFirst').append('<td class="ml-2 SetColer">'+ value[index]['number'][indexOf]+'</td>');  // set value span
            }
          } 

          if(value[index]['id'] == 'prizeFirstNear'){ // show prizeFirst
            $('.PrizeFirstNear1').empty(); // set box empty
            $('.PrizeFirstNear2').empty(); // set box empty
            for (let indexOf = 0; indexOf < value[index]['number'].length; indexOf++) { // set box span
              let id = '.PrizeFirstNear'+(indexOf+1);
              $(id).append('<span>'+ value[index]['number'][indexOf]+'</span>');  // set value span
            }
          } 

        }
      }
    }   
  });
}

function removeItem(array, item){ // pop array function
    for(var i in array){
        if(array[i]==item){
            array.splice(i,1);
            break;
        }
    }
}

function API(){
  let datepick = $('#date-select').val();
  window.open('/api/view?date=' + datepick, '_blank');
}
