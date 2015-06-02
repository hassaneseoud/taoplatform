<?php
/**
 * Docs Controller provide actions to manage docs
 * 
 * @author Bertrand Chevrier, <taosupport@tudor.lu>
 * @package taoDocs
 * @subpackage actions
 * @license GPLv2  http://www.opensource.org/licenses/gpl-2.0.php
 * 
 */
namespace oat\taoDocs\actions;


class Browser extends \tao_actions_CommonModule {


	/**
	 * constructor: initialize the service and the default data
	 * @return Docs
	 */
	public function __construct(){
		
		parent::__construct();
		
		//the service is initialized by default
		$this->service = \taoDocs_models_classes_DocsService::singleton();
		$this->defaultData();
	}

	/**
	 * Show the list of documents
	 * @return void
	 */
	public function index(){
		$this->setView('index.tpl');
    }

	/**
	 * @example method used to populate the tree widget
	 * render json data of the documents in the DOCS_PATH
	 * @return void
	 */
	public function getTreeData(){
	
		$data = array(
			'data' 	=> __("My Documents"),
			'attributes' => array(
					'id' => 1,
					'class' => 'node-class'
				),
			'children' => array()
			);
		$index = 2;
		foreach(\taoDocs_helpers_FileUtils::parseFolder(DOCS_PATH, true) as $path => $file){
			$data['children'][] =  array(
				'data' 	=> $file,
				'attributes' => array(
						'id' => substr($path, strlen(DOCS_PATH)),
						'class' => 'node-instance'
					)
			);
			$index++;
		}
		echo json_encode($data);
	}
	/**
	 * this function is TUTOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO!!
	 */
	
	public function delete(){
    $filepath = DOCS_PATH.$this->getRequestParameter('uri');
    $deleted = \taoDocs_helpers_FileUtils::deleteFile($filepath);
    if ($deleted) {
        $this->setView('confirmDel.tpl');
        //remove the current selection from the session
        $this->removeSessionAttribute('uri');
    }
}
	// AFFICHAGE TEST TEST TEST -_-_-_-_-_-_-_-_-----__---___-_--___-__----___--__________________----------__----------------------___------!-----__---

    /**
     *
     */
    public function affiche(){
    $filepath = DOCS_PATH.$this->getRequestParameter('uri');
    echo $filepath ."</br>";
	$ab = strlen($filepath);
	echo $ab."</br>".".xml";
	$monUrl = substr($filepath, ($ab - 15) , $ab)."</br>" ;
	echo $monUrl ;
	$pos = strpos($filepath, "i1");
$monUrl1 = substr ($filepath, $pos, $ab)	;
	 //$monUrl = 'C:\wamp\www\taoplatform\generis\data\taoItems\itemData'.'\i143220487338917\itemContent\en-US\qti.xml';
	$monUrl = 'C:\wamp\www\\taoplatform\\generis\\data\\taoItems\\itemData\\'.$monUrl1.'\itemContent\en-US\testH.xml';
	echo "</br>".$monUrl;
	$fich = file_get_contents($monUrl);
	//print_r ($fich);
	
	$doc = new \DOMDocument();  
	$doc->load( $monUrl );  
  
$nodes = $doc->getElementsByTagName( "Tests" );  
echo "</br>".$nodes->length."</br>";
  
foreach($nodes as $ua) {  
  $string = $ua->nodeValue."</br>";  
  echo $string;
}  
$tag=$doc->getElementsByTagName('Tests')->item(0);

function fore($house)
 { /*
foreach ($house as $mouse )
{
	if ($mouse->hasChildNodes())
	{ echo "helloooooo";
$string = $mouse->nodeName."</br>";
echo  $string;
	$fils = $mouse->childNodes ;
	foreach ($fils as $fil )
		fore($fil);}
	else 
	{$string = $mouse->nodeName."----".$mouse->nodeValue."</br";
	echo 	$string ;}
	
} 


*/
foreach ($house as $mouse)
	{
		if ($mouse->hasChildNodes()){
			echo $mouse->nodeName."</br>"."{";
				$ms = $mouse->childNodes;
				foreach ($ms as $mss)
					fore($ms);
									}
		else echo $mouse->nodeName."</br>";
	}



}
$tag=$doc->getElementsByTagName('Tests');
fore($tag);
echo "-----------"."</br>" ;








$pos = strpos($filepath, "i1");
$monUrl = substr ($filepath, $pos, $ab)	;

	echo $monUrl;

    
}
	
	/**
	 * this function must contain the word edit
	 */
	public function editDocument(){
		$filepath = $this->getRequestParameter('uri');
		
		// send data to the template
		$this->setData('filename', substr($filepath, strrpos($filepath, '/')+1));
		$this->setData('downloadpath', DOCS_URL.$filepath);
		
		// select the template
		$this->setView('editDocument.tpl');
	}
		
	/**
	 * @see TaoModule::getRootClass
	 * @abstract implement the abstract method
	 */
	public function getRootClass(){
		return null;
	}
}
?>
