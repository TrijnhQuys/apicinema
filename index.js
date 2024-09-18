const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const con = mysql.createConnection({
    host: 'localhost',
    database: 'qlvexemphim',
    user: 'root',
    password: '',
});
con.connect();
app.use(bodyParser.json());

app.post('/dang-nhap', (req, res) => {
    let sql = `SELECT * FROM users WHERE USERNAME = '${req.body.name}' AND PASSWORD = '${req.body.pass}'`;
    con.query(sql, (e, r, f) => {
      if (!e) {
        if (r.length === 1) {
          const user = r[0];
          const { IDUSER, EMAIL, USERNAME } = user;
          res.json({ log: true, info: { IDUSER, EMAIL, USERNAME } });
        } else {
          res.json({ log: false, message: 'Sai tên truy cập hoặc mật khẩu' });
        }
      } else {
        res.json({ log: false, message: 'Sai tên truy cập hoặc mật khẩu' });
      }
    });
  });
app.post('/dang-ky', (req, res)=>{
    let sql = `INSERT INTO users VALUES(NULL, '${req.body.email}', '${req.body.name}', '${req.body.pass}') `;
    con.query(sql, (e, r, f)=>{
        if(!e){
            if(r.insertId > 0)
                res.json({insert: true});
            else
                res.json({insert: false});
        }
        else
            res.json({insert: false});
    });
});
app.post('/dat-ve', (req, res)=>{
  let seatsJSON = JSON.stringify(req.body.seats);
  let sql = `INSERT INTO don_hang VALUES(NULL,'${req.body.idphim}','${req.body.iduser}',
  '${req.body.timestartwatching}','${req.body.dateview}','${req.body.namerap}','${req.body.namefilm}',
  '${req.body.name}','${req.body.email}','${seatsJSON}','${req.body.combofood}','${req.body.totalmoney}')`;
  con.query(sql, (e, r, f)=>{
      if(!e){
          if(r.insertId > 0)
              res.json({insert: true});
          else{
            res.json({insert: false});
          }  
      }
      else{
        console.log(e); 
        res.json({insert: false});
      }
    
  });
});
  app.post('/load-ghe', (req, res) => {
    let loadSql = `SELECT SEATS FROM don_hang WHERE IDPHIM = '${req.body.idphim}' AND NAMERAP='${req.body.namerap}' AND TIMESTARTWATCHING='${req.body.timestartwatching}' AND DATEVIEW='${req.body.dateview}'`;
    con.query(loadSql, (e, r, f) => {
      if (!e) {
        let selectedSeats = [];
        for (let i = 0; i < r.length; i++) {
          const seatsString = r[i].SEATS; // Lấy giá trị chuỗi SEATS từ kết quả truy vấn
          const cleanedSeatsString = seatsString.replace(/"/g, ''); // Loại bỏ cặp ký tự "" trong chuỗi-thay thế các ký tự "" bằng khoảng trống ' '
          const seatsArray = JSON.parse(cleanedSeatsString); // Chuyển đổi chuỗi thành mảng json
          selectedSeats = selectedSeats.concat(seatsArray); // Gộp mảng ghế đã chọn vào mảng selectedSeats
        }
        
        res.json({ selectedSeats });
      } else {
        console.error(e);
        res.json({ selectedSeats: [] });
      }
    });
  });
app.listen(process.env.PORT || 3000);