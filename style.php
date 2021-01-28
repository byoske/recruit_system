<!DOCTYPE>
<html lang="ja">
<head>
<!--
<title>お問い合わせフォーム</title>
-->
<style rel="stylesheet" type="text/css">


body {
	padding: 10px;
	text-align: center;
}


/*
h1 {
	margin-bottom: 20px;
	padding: 20px 0;
	color: #209eff;
	font-size: 122%;
	border-top: 1px solid #999;
	border-bottom: 1px solid #999;
}
*/

input[type=text] ,
input[type=password],
input[type=tel],
input[type=date]{
	padding: 5px 10px;
	font-size: 86%;
	border: none;
	border-radius: 3px;
	background: #ddf0ff;
	width:200px;
}

/*
input[name=btn_confirm],
input[name=btn_submit],
input[name=btn_back],
input[name=reset],
button[name=submit],
input[name=back]
{

    text-align: center;
	padding: 5px 20px;
	font-size: 100%;
	color: #fff;
	cursor: pointer;
	border: none;
	border-radius: 3px;
	box-shadow: 0 3px 0 #2887d1;
	background: #4eaaf1;
}
*/
select{
    padding: 5px 10px;
	font-size: 86%;
	border: none;
	border-radius: 3px;
	background: #ddf0ff;
	width:58px;
}



select[name=purpose1],
select[name=purpose2],
select[name=purpose3],
select[name=stat]{
    padding: 5px 10px;
	font-size: 86%;
	border: none;
	border-radius: 3px;
	background: #ddf0ff;
	width:100px;
}

input[name=btn_back] {
	margin-right: 20px;
	box-shadow: 0 3px 0 #777;
	background: #999;
}

.element_wrap {
	margin-bottom: 10px;
	padding: 10px 0;
	border-bottom: 1px solid #ccc;
	text-align: left;



}
label [calss=合格]{
	coler:#ff4300
}
label {
	display: inline-block;
	margin-bottom: 10px;
	font-weight: bold;
	width: 150px;
	vertical-align:middle;
}
label[for=i_contents]{
    display: inline-block;
	margin-bottom: 10px;
	font-weight: bold;
	width: 150px;
	vertical-align:middle;
}
.date-edit {
	display: inline-block;
	margin-bottom: 10px;
	font-weight: bold;
	width: 150px;
}
.date-edit::before {
  background:  url(../img/now.png) no-repeat center center / cover #F7D94C;
    border:1px solid #ccc;
    top: -15px;
    right: -65px;
    border-radius: 28px;

    margin-bottom: 10px;
	padding: 10px 0;
	text-align: left;

}
.date-edit p{
    	display: inline-block;
	margin:  0;
	text-align: left;
}
.element_wrap p {
	display: inline-block;
	margin:  0;
	text-align: left;
}
textarea{
    margin-bottom: 10px;
	padding: 10px 0;
	background: #ddf0ff;
	text-align: left;
	vertical-align:middle;
	width:300px;
}
.button {
text-decoration: none;
  display       : inline-block;
  border-radius : 6%;          /* 角丸       */
  /*font-size     : 18pt;        /* 文字サイズ */
  text-align    : center;      /* 文字位置   */
  cursor        : pointer;     /* カーソル   */
  padding       : 3px 45px;   /* 余白       */
  background    : #eeeeee;     /* 背景色     */
  color         : #000000;     /* 文字色     */
  line-height   : 1em;         /* 1行の高さ  */
  transition    : .3s;         /* なめらか変化 */
  border:1px solid;
  bgcolor:#444444;
border-color:#444444 #444444;
}
.button:hover {
}


</style>
</head>
</html>