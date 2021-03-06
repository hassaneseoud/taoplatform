<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
            <script type="text/javascript" src="<?=TAOBASE_WWW?>js/lib/require.js"></script>
            <script type="text/javascript">
            (function(){
                var clientConfigUrl = '<?=get_data('client_config_url')?>';
                requirejs.config({waitSeconds : <?=JS_TIMEOUT?>});
                require([clientConfigUrl], function(){
                    require(['taoItems/controller/runtime/itemRunner'], function(itemRunner){
                        itemRunner.start({
                            resultServer    : {
                                endpoint : <?=json_encode(get_data('resultServerEndpoint'));?>,
                                module   : 'taoQtiItem/QtiResultServerApi'  
                            },
                            itemService     : {
                                module      : 'taoQtiItem/runtime/QtiItemServiceImpl',
                                params  : {
                                    contentVariables: <?=json_encode(get_data('contentVariableElements'))?>,
                                    itemDataPath: <?=json_encode(get_data('itemDataPath'))?>
                                }
                            },
                            itemId          : <?=json_encode(get_data('itemId'));?>,
                            itemPath        : <?=json_encode(get_data('itemPath'))?>,
                            clientConfigUrl : clientConfigUrl,
                            timeout         : <?=JS_TIMEOUT?>
                        });
                    });
                });
            }());
        </script>
	</head>
	<body>
	</body>
</html>
