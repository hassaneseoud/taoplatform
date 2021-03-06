<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=PRODUCT_NAME?> <?=TAO_VERSION?></title>
       
        <!--link rel="stylesheet" type="text/css" href="<?=TAOBASE_WWW?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?=TAOBASE_WWW?>css/custom-theme/jquery-ui-1.8.22.custom.css" /-->
        <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>taoItems/views/css/preview.css" />
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>tao/views/css/tao-main-style.css" />
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>taoQtiItem/views/css/qti.css" />
    <link rel="stylesheet" type="text/css" href="<?=ROOT_URL?>taoItems/views/css/quick-preview.css" />

        <?if(has_data('previewUrl')):?>
         <script type="text/javascript" src="<?=TAOBASE_WWW?>js/lib/require.js"></script>
            <script type="text/javascript">
            (function(){
                var clientConfigUrl = '<?=get_data('client_config_url')?>';
                requirejs.config({waitSeconds : <?=JS_TIMEOUT?>});
                require([clientConfigUrl], function(){
                    require(['taoItems/controller/preview/itemRunner'], function(itemRunner){
                        itemRunner.start({
                             <?if(has_data('resultServer')):?>
                            resultServer : <?=json_encode(get_data('resultServer'))?>,
                            <?endif?>
                            previewUrl : <?=json_encode(get_data('previewUrl'))?>,
                            clientConfigUrl : clientConfigUrl,
                            timeout : <?=JS_TIMEOUT?>
                        });
                    });
                });
            }());
        </script>
        <?endif?>

</head>
<body class='fullScreen'>
	
	<?if(has_data('previewUrl')):?>
		
            <iframe id='preview-container' name="preview-container"></iframe>
            <!-- to emulate wf navigaton: <button id='finishButton' ><?=__('Finish')?></button> -->

            <div id='preview-console' class="ui-widget">
                    <div class="console-control">
                            <span class="ui-icon ui-icon-circle-close" title="<?=__('close')?>"></span>
                            <span class="ui-icon ui-icon-circle-plus toggler" title="<?=__('show/hide')?>"></span>
                            <span class="ui-icon ui-icon-trash" title="<?=__('clean up')?>"></span>
                            <?=__('Preview Console')?> 
                    </div>
                    <div class="console-content"><ul></ul></div>
            </div>
       <?else:?>
            <h3><?=__('PREVIEW BOX')?></h3>
            <p><?=__("Not yet available")?></p>
	<?endif?>

</body>
</html>
