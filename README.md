# Goutte, PHP Web Scraper lotto-API
เว็บตรวจสอบสลากกินแบ่งรัฐบาลใช้เทคโนโลยี Web Scraper ในการตรวจจับและสร้าง API

ทดลอง : https://frozen-lake-31472.herokuapp.com/
# use command

composer require laravel/ui

# set file

สร้างไฟล์ .env extends .env.example


<details>
<summary>JSON API</summary>
<br>
The API is based on HTTPS requests and JSON responses. The stable HTTPS endpoint: https://news.sanook.com/lotto/

</details>

<details>
<summary>Libary</summary>
<br> - Jquery
<br> - Goutte

</details>

# รายละเอียดโปรแกรม

  - เลือกวันที่ต้องการตรวจสอบสลากฯ ได้
  - ตรวจสลากฯ ได้สูงสุด 3 ใบ
  - แสดงผลตรวจสอบสลากฯ
  - แสดงผลสลากฯ ทั้งหมดตามวันที่เลือก
  - แสดง API ตัวอย่าง
