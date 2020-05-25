<?php

//函数库文件
//跳转的提示信息
//跳转的地址

function show_msg($msg,$url)
{
    header("Content-Type:text/html;charset=utf-8");
$str = <<<DOF
<script>
    alert('$msg');
    location.href = '$url';
</script>
DOF;

    echo $str;
}


//上传图片的方法
function upload_file($input_name,$path)
{
    $error = $_FILES[$input_name]['error'];

    if($error > 0)
    {
        switch ($error)
        {
            case 1:
                echo "超过php.ini上传大小的限制";
                break;
            case 2:
                echo "超过了表单隐藏域的限制";
                break;
            case 3:
                echo "网络中断";
                break;
            case 4:
                echo "没有文件上传";
                break;
            default:
                echo "其他情况";
                break;
        }
    }

    //组装新的文件名称
    $ext = PATHINFO($_FILES[$input_name]['name'],PATHINFO_EXTENSION);

    $filename = date("YmdHis").mt_rand(1,9999999).".".$ext;

    //判断文件是否是通过http post上传
    if(is_uploaded_file($_FILES[$input_name]['tmp_name']))
    {
        $res = move_uploaded_file($_FILES[$input_name]['tmp_name'],$path.'/'.$filename);

        if($res)
        {
            return $filename;
        }else{
            return false;
        }
    }
}


//得到当前网址
function get_url(){
    $str = $_SERVER['PHP_SELF'].'?'; //http://localhost/future/index.php?
    if($_GET){
        foreach ($_GET as $k=>$v){  //$_GET['page']
            if($k!='page'){
                $str .= $k.'='.$v.'&';
            }
        }
    }
    return $str;
}

//分页函数
/**
 *@pargam $current  当前页
 *@pargam $count    记录总数
 *@pargam $limit    每页显示多少条
 *@pargam $size     中间显示多少条
 *@pargam $class    样式
 */
function page($current,$count,$limit,$size,$class='sabrosus'){
    $str='';
    if($count>$limit){
        $pages = ceil($count/$limit);//算出总页数
        $url = get_url();//获取当前页面的URL地址（包含参数）

        $str.='<div class="'.$class.'">';
        //开始
        if($current==1){
            $str.='<span class="disabled">首&nbsp;&nbsp;页</span>';
            $str.='<span class="disabled">  &lt;上一页 </span>';
        }else{
            $str.='<a href="'.$url.'page=1">首&nbsp;&nbsp;页 </a>';
            $str.='<a href="'.$url.'page='.($current-1).'">  &lt;上一页 </a>';
        }
        //中间
        //判断得出star与end

        if($current<=floor($size/2)){ //情况1
            $star=1;
            $end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
        }else if($current>=$pages - floor($size/2)){ // 情况2

            $star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数

            $end=$pages;
        }else{ //情况3

            $d=floor($size/2);
            $star=$current-$d;
            $end=$current+$d;
        }

        for($i=$star;$i<=$end;$i++){
            if($i==$current){
                $str.='<span class="current">'.$i.'</span>';
            }else{
                $str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
            }
        }
        //最后
        if($pages==$current){
            $str .='<span class="disabled">  下一页&gt; </span>';
            $str.='<span class="disabled">尾&nbsp;&nbsp;页  </span>';
        }else{
            $str.='<a href="'.$url.'page='.($current+1).'">下一页&gt; </a>';
            $str.='<a href="'.$url.'page='.$pages.'">尾&nbsp;&nbsp;页 </a>';
        }
        $str.='</div>';
    }

    return $str;
}


//查询一条的方法
function findOne($table,$where)
{
    global $pre_;
    global $conn;
    $sql = "SELECT * FROM {$pre_}$table WHERE $where";
    $res = mysqli_query($conn,$sql);   //返回一个对象
    if(!$res) //当语句执行失败的时候
    {
        echo "执行失败:".$sql."<br />".mysqli_error($conn);
        exit;
    }

    return mysqli_fetch_assoc($res);   //返回一个关联数组
}

//查询多条的方法
function findAll($table,$where=1,$limit=0,$order=false,$orderBy="ASC")
{
    global $pre_;
    global $conn;
    $sql = "SELECT * FROM {$pre_}$table WHERE $where";

    //排序
    if($order)
    {
        $sql .= " ORDER BY $order $orderBy";
    }

    if($limit)   //当传参数不为0的时候就执行判断 限制输出条数
    {
        $sql .= " LIMIT $limit";
    }
    $res = mysqli_query($conn,$sql);  //返回一个查询的对象
    if(!$res)
    {
        echo "执行失败:".$sql."<br />".mysqli_error($conn);
        exit;
    }

    $data = array();
    while($row = mysqli_fetch_assoc($res))  //从返回的对象里面获取数据
    {
        $data[] = $row;
    }

    return $data;
}


//自定义语句查询
function sqlOne($sql)
{
    global $conn;
    $res = mysqli_query($conn,$sql);
    return mysqli_fetch_assoc($res);
}

//自定义语句查询多条
function sqlAll($sql)
{
    global $conn;
    $res = mysqli_query($conn,$sql);
    $arr = array();
    while($row = mysqli_fetch_assoc($res))
    {
        $arr[] = $row;
    }

    return $arr;

}


//插入方法 INSERT INTO pre_article(art_id,art_title,art_author....)VALUES('basdas','asdasd');

function insertData($table,$data)
{
    global $conn;
    global $pre_;

    //将数组当中的索引抽离出来放到一个新的数组里面
    $k = '`'.implode('`,`',array_keys($data)).'`';
    $v = "'".implode("','",$data)."'";
    //封装sql语句
    $sql = "INSERT INTO {$pre_}$table($k)VALUES($v)";
    $res = mysqli_query($conn,$sql);

    //mysqli_insert_id 如果插入成功返回最新的id 否则返回0
    return mysqli_insert_id($conn);  //返回上一条语句插入之后的新增id值 最新的主键id
}


//更新方法
//UPDATE pre_article SET art_title='asdasdsad',art_time=123123123 WHERE
function updateData($table,$data,$where)
{

    global $conn;
    global $pre_;

    $str = '';
    foreach($data as $k=>$v)
    {
        $str .= "$k = '$v',";
    }
    $str = rtrim($str,',');

    $sql = "UPDATE {$pre_}$table SET $str WHERE $where";
    mysqli_query($conn,$sql);
    return mysqli_affected_rows($conn);  //返回一个影响行数
}


//删除方法
function deleteData($table,$where)
{
    global $conn;
    global $pre_;

    $sql = "DELETE FROM {$pre_}$table WHERE $where";
    mysqli_query($conn,$sql);
    return mysqli_affected_rows($conn);  //影响函数
}


?>