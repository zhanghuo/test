<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

//公共ajax调用控制器
class Common extends Controller
{
    //验证字段是否存在--解决所有表和字段的验证
	public function validonly()
	{
		$valid = true;
		if (Request::instance()->isPOST())
		{ 
			$table = Request::instance()->param('table');//使用传来的表名

			$param = Request::instance()->except(['id'],'post');

			$param['id'] = ['not in',Request::instance()->post('id')];
			
			$isexist = db::name($table)->field('id')->where($param)->find();
			if($isexist){
				 $valid = false;
			}
		}
		else{
            $valid = false;
		}
		$data['valid'] = $valid;
		echo json_encode($data);
		exit;
	}
    //上传图片
	public function upload(){
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('file_data');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
			$date = date('Ymd');
			$data['code'] = 0;
			$data['img'] = 'uploads/'.$date.'/'.$info->getFilename();
			// 成功上传后 获取上传信息
			// 输出 jpg
			//echo $info->getExtension();
			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			//echo $info->getSaveName();
			// 输出 42a79759f284b767dfcb2a0197904287.jpg
			//echo $info->getFilename(); 
		}else{
			// 上传失败获取错误信息
			//echo $file->getError();
			$data['code'] = -1;
			$data['error'] = $info->getError();
		}
		
		return json_encode($data);

	}

	//删除图片
	public function updel(){
		$filename = input('filename');
			if (!empty($filename)) {
				unlink(ROOT_PATH . 'public'.DS.$filename);
				$data['code']=1;
			} else {
				$data['code']=2;
			}
		return json_encode($data);

	}
    /**
     * 配置管理头部排序
     * @return [type] [description]
     */
	public function sortable(){
		if (Request::instance()->isPOST())
		{ 
			$sort = Request::instance()->post('sort/a');//使用传来的表名
			for($i=0;$i<count($sort);$i++){
				Db::name('webtype')->where('id', $sort[$i])->update(['orderid' => ($i+1)]);
			}
			$data['code']=1;
		}
		else{
            $data['code']=0;
		}
		echo json_encode($data);
		exit;

	}
    /**
     * 配置管理内容排序
     * @return [type] [description]
     */
	public function sortConfig(){
		if (Request::instance()->isPOST())
		{ 
			$sort = Request::instance()->post('sort/a');//使用传来的表名
			for($i=0;$i<count($sort);$i++){
				Db::name('webconfig')->where('varname', $sort[$i])->update(['orderid' => ($i+1)]);
			}
			$data['code']=1;
		}
		else{
            $data['code']=0;
		}
		echo json_encode($data);
		exit;

	}
    /**
     * 更新配置内容
     * @return [type] [description]
     */
	public function editable(){
		$data = Request::instance()->param();
		Db::name('webconfig')->where('varname', $data['pk'])->update(['varvalue' => $data['value']]);
        $value = Db::name('webconfig')->field('varname,varvalue')->select();
        $arr = [];
        foreach($value as $v){
            $arr[$v['varname']] = $v['varvalue'];
        }
		// 文件路径
        $path = APP_PATH . "common" . DS . "common" . DS . "web.inc.php";
        file_put_contents($path, serialize($arr));
        return true;
	}

}