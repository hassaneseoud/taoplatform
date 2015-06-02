/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2013 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 *
 */
define(
    [
        'module',
        'jquery',
        'lodash',
        'serviceApi/ServiceApi',
        'serviceApi/PseudoStorage',
        'serviceApi/UserInfoService',
        'taoItems/runtime/ItemServiceImpl',
        'taoItems/preview-console',
        'urlParser',
        'iframeResizer'
    ],
    function (
        module,
        $,
        _,
        ServiceApi,
        PseudoStorage,
        UserInfoService,
        ItemServiceImpl,
        previewConsole,
        UrlParser,
        iframeResizer
        ) {

        var previewItemRunner = {

            start: function (options) {

                var conf = _.merge(module.config(), options || {});

                if (conf.previewUrl) {

                    previewConsole.setup();

                    var resultServer = _.defaults(conf.resultServer, {
                        module: 'taoResultServer/ResultServerApi',
                        endpoint: '',
                        params: {}
                    });

                    //load dynamically the right ResultServerApi
                    require([resultServer.module], function (ResultServerApi) {

                        var resultServerApi = new ResultServerApi(
                            resultServer.endpoint,
                            resultServer.params
                        );

                        var serviceApi = new ServiceApi(
                            conf.previewUrl,
                            {},
                            'preview',
                            new PseudoStorage(),
                            new UserInfoService(conf.userInfoServiceRequestUrl, {})
                        );

                        var itemApi = new ItemServiceImpl({
                            serviceApi: serviceApi,
                            resultApi: resultServerApi
                        });

                        var callUrl = new UrlParser(serviceApi.getCallUrl());
                        var isCORSAllowed = callUrl.checkCORS();
                        callUrl.addParam('clientConfigUrl', conf.clientConfigUrl);

                        var $frame = $('#preview-container');

                        iframeResizer.autoHeight($frame, 'body', 10);



                        $frame.on('load', function () {
                            var frame = this;

                            //1st try to connect the api on frame load
                            itemApi.connect(frame);

                            //if we are  in the same domain, we add a variable
                            //to the frame window, so the frame knows it can communicate
                            //with the parent
                            if (isCORSAllowed === true) {
                                frame.contentWindow.__knownParent__ = true;
                            }
                            //then we can wait a specific event triggered from the item
                            $(document).on('itemready', function () {
                                itemApi.connect(frame);
                            });

                        });
                        $('#preview-container').attr('src', callUrl.getUrl());

                        $('#finishButton').click(function () {
                            itemApi.finish();
                        });
                    });
                }
            }
        };

        return previewItemRunner;
    });