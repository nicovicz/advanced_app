<?php
namespace common\components;

use Yii;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionMethod;
use FilesystemIterator;
/**
 * Some code are inspired from Yii2-Admin
 * @url https://github.com/mdmsoft/yii2-admin/blob/master/controllers/RouteController.php
 *
 **/
class RouterGenerator
{

	protected $results=[];

	public static function run()
	{
		 $modules = Yii::$app;
		
		 $router = new RouterGenerator();
		 return $router->getAllModules($modules);
	}

	public function getAllModules($modules) 
	{

     
       foreach($modules->getModules() as $moduleId => $moduleProperty){
           //if ($module = $modules->getModule($moduleId) != null)
           		$this->getAllModules($modules->getModule($moduleId));
       }
    
       $listFiles = $this->getControllersFiles($modules);
		
       foreach($listFiles as $name){
			
           $fullNamespace = $this->setNamespace($name, $modules);
          
           if ((substr($fullNamespace, -10) === 'Controller') &&
                class_exists($fullNamespace) &&
                is_subclass_of($fullNamespace, 'yii\base\Controller')
           ){
               
               $exploded_namespace = explode('\\',$fullNamespace);
               $controller_id = str_replace('Controller','',end($exploded_namespace));
               if ($actions = $this->getListActions($fullNamespace)) {
				   $id = \yii\helpers\Inflector::camel2id($controller_id);
                   $this->results['/'.$id]= $actions;
               }
               
           }
       }
       
       return $this->results;
       
    }
    
    public function getControllersFiles($modules){
        $directory = new RecursiveDirectoryIterator($modules->controllerPath, FilesystemIterator::SKIP_DOTS);
        $lists = new RecursiveIteratorIterator($directory); 
        return $lists;
    }
    
    public function setNamespace($fileName, $modules){

    		$controllerPathLength = strlen($modules->controllerPath);

        $file = substr($fileName->getRealpath(),$controllerPathLength);
        $transformToNamespace = str_replace(['/','.php'], ["\\", ''], $file);
        $prefixNamespace = $modules->controllerNamespace;
        $fullNamespace = $prefixNamespace.$transformToNamespace;

        return $fullNamespace;
    }
    
    public function getListActions($namespace)
    {
        $reflectionClass = new ReflectionClass($namespace);
        $methods = $reflectionClass->getMethods(ReflectionMethod::IS_PUBLIC);
        $actions = [];
        foreach($methods as $method){
            
            if (substr($method->name,0,6) === 'action' and strlen($method->name)>7) {
					$action_id = str_replace('action','',$method->name);
                    $actions[] = '/'.\yii\helpers\Inflector::camel2id($action_id);
            }
        }
        
        return $actions;
        
    }
}
