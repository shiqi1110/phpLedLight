<?php

$conn = mysqli_connect("localhost","root","root") or die('链接失败');

mysqli_select_db($conn,'future');

mysqli_query($conn,"SET NAMES UTF8");


//查询

//无条件
$sql = "SELECT * FROM pre_cate";

//带有条件
$sql = "SELECT * FROM pre_cate WHERE cate_name = '科技'";

//带有限制条数的 Limit

//只查询2条数据
$sql = "SELECT * FROM pre_cate LIMIT 2";

//从第几条开始查 查询多少个 从1开始查 查询两条
$sql = "SELECT * FROM pre_cate  LIMIT 1,2";


//ORDER BY 排序 ASC 升序 DESC 降序

//降序
$sql = "SELECT * FROM pre_cate ORDER BY cate_id DESC";

//升序 默认
$sql = "SELECT * FROM pre_cate ORDER BY cate_id ASC";

$sql = "SELECT * FROM pre_cate ORDER BY cate_id DESC LIMIT 1,2";

$sql = "SELECT * FROM pre_cate WHERE cate_id > 1 ORDER BY cate_id DESC LIMIT 1,2";


//连表查询 连多张表进行数据统一查询

//AS 别名

//AND &&  两个要同时为真才返回true
//OR || 只要有一个为真就返回true
//not 真变假 假变真

//左链接 left join on 两个表成立的条件   主表(文章表) 附加表(关系表)
$sql = "SELECT * FROM pre_article AS art LEFT JOIN pre_article_data AS data ON art.art_id = data.art_id WHERE art.cate_id = 1 AND data.tag_id = 1";


//右链接 right join on 两个表成立的条件
$sql = "SELECT * FROM pre_"

//内链接 inner join on 两个表成立的条件


//统计 是一个函数 count();
$sql = "SELECT count(art_id) AS c FROM pre_article";

//between and 两者之间
$sql = "SELECT * FROM pre_article WHERE BETWEEN 1 AND 5";

//
$sql = "SELECT * FROM pre_article WHERE art_id IN(1,3,5)";

$sql = "SELECT * FROM pre_articel WHERE art_id NOT IN(1,3,5)";

//
$sql = "SELECT * FROM pre_article GROUP BY art_title";

$sql = "SELECT cate_id FROM pre_article UNION SELECT cate_id FROM pre_cate";

$sql = "SELECT cate_id FROM pre_article UNION ALL SELECT cate_id FROM pre_cate";

$sql = "SELECT Customer SUM(OrdersPrice) FROM Order GROUP BY Customer HAVING SUM(OrdersPrice)";

$sql = "INSERT INTO pre_article_backup(art_id,art_title) SELECT art_id,art_title FROM pre_article";

$sql = "SELECT min(art_id) FROM pre_article";

$sql = "SELECT max(art_id) FROM pre_article";

$sql = "SELECT sum(art_id) FROM pre_article";

$sql = "SELECT avg(art_id) FROM pre_article";

//插入INSERT INTO 表名（字段1）values 修改的内容
$sql= "INSERT INTO pre_cate(cate_name) VALUES('医疗')";

$sql = "INSERT INTO pre_cate(cate_name) VALUES('医疗'),('医疗2')";

//更新 update 表明 SET 字段名=“内容” 
$sql = "UPDATE pre_caate SET cate_name = '新闻' WHERE cate_id=6";

//删除
$sql = "DELETE FROM pre_cate WHERE cate_id = 7";

//模糊查询 like

$sql = "SELECT * FROM pre_article WHERE art_title LIKE '%小明%'";



echo $sql;





?>