<?php

class fluid_image {

    public function __construct() {

    }

    public static function config() {
        $file = CM_PATH . '/fluid-image/fluid.php';
        //add_action('wp_footer', fluid_image::load_script());
        include_once $file;
    }

    public static function load_script() {
        ?>
        <script type="text/javascript">
            var imgSizer = {
                Config : {
                    imgCache : []
                    ,spacer : "<?php echo CM_URL ?>/fluid-images/images/blank.gif"
                }

                ,collate : function(aScope) {
                    var isOldIE = (document.all && !window.opera && !window.XDomainRequest) ? 1 : 0;
                    if (isOldIE && document.getElementsByTagName) {
                        var c = imgSizer;
                        var imgCache = c.Config.imgCache;

                        var images = (aScope && aScope.length) ? aScope : document.getElementsByTagName("img");
                        for (var i = 0; i < images.length; i++) {
                            images[i].origWidth = images[i].offsetWidth;
                            images[i].origHeight = images[i].offsetHeight;

                            imgCache.push(images[i]);
                            c.ieAlpha(images[i]);
                            images[i].style.width = "100%";
                        }

                        if (imgCache.length) {
                            c.resize(function() {
                                for (var i = 0; i < imgCache.length; i++) {
                                    var ratio = (imgCache[i].offsetWidth / imgCache[i].origWidth);
                                    imgCache[i].style.height = (imgCache[i].origHeight * ratio) + "px";
                                }
                            });
                        }
                    }
                }

                ,ieAlpha : function(img) {
                    var c = imgSizer;
                    if (img.oldSrc) {
                        img.src = img.oldSrc;
                    }
                    var src = img.src;
                    img.style.width = img.offsetWidth + "px";
                    img.style.height = img.offsetHeight + "px";
                    img.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + src + "', sizingMethod='scale')"
                    img.oldSrc = src;
                    img.src = c.Config.spacer;
                }

                // Ghettomodified version of Simon Willison's addLoadEvent() -- http://simonwillison.net/2004/May/26/addLoadEvent/
                ,resize : function(func) {
                    var oldonresize = window.onresize;
                    if (typeof window.onresize != 'function') {
                        window.onresize = func;
                    } else {
                        window.onresize = function() {
                            if (oldonresize) {
                                oldonresize();
                            }
                            func();
                        }
                    }
                }
            }

            addLoadEvent(function() {
                imgSizer.collate();
            });

            function addLoadEvent(func) {
                var oldonload = window.onload;
                if (typeof window.onload != 'function') {
                    window.onload = func;
                } else {
                    window.onload = function() {
                        if (oldonload) {
                            oldonload();
                        }
                        func();
                    }
                }
            }

        </script>
        <?php
    }

}
?>



