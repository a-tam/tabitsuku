<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
        <title>
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <style>
          html, body {
            width: 100%;
            }
        </style>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
        <script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/spot_smartphone.js"></script>
        <script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/tag-it.js"></script>
      </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-role="content" style="padding: 15px">
                <form id="search-map">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textarea1">
                            検索
                            </label>
                            <input type="text" id="search-address" value="" />
                            <span id="falledMessage" style="color:red; display:none;">見つかりませんでした。</span>
                            <div id="mapArea" style="width:100%; height:200px;"></div>
                            
                        </fieldset>
                    </div>
                </form>
                <input type="hidden" name="lat" id="spot-lat" value="35.6894875" readonly="readonly" />
                <input type="hidden" name="lng" id="spot-lng" value="139.69170639999993" readonly="readonly" />
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput1">
                        </label>
                        <input name="name" id="textinput1" placeholder="スポット名" value="" type="text" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textarea1">
                        </label>
                        <textarea name="" id="textarea1" placeholder="詳細" data-mini="true">
                        </textarea>
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput2">
                        </label>
                        <input name="" id="textinput2" placeholder="画像" value="" type="text" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput4">
                        </label>
                        <input name="" id="textinput4" placeholder="滞在時間" value="" type="number" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput5">
                        </label>
                        <input name="" id="textinput5" placeholder="カテゴリ１" value="" type="number" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput6">
                        </label>
                        <input name="" id="textinput6" placeholder="カテゴリ２" value="" type="number" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup" data-mini="true">
                        <label for="textinput7">
                        </label>
                        <input name="" id="textinput7" placeholder="カテゴリ３" value="" type="number" />
                    </fieldset>
                </div>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textarea2">
                        </label>
                        <textarea name="" id="textarea2" placeholder="タグ" data-mini="true">
                        </textarea>
                    </fieldset>
                </div>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>