<?php

class A2_Autocomplete_Block_Jsinit extends Mage_Core_Block_Text
{

    protected function _toHtml()
    {
        $html = '';

        $html .= 
            "<script type=\"text/javascript\">
            //<![CDATA[
                (function(){
                    document.addEventListener(\"DOMContentLoaded\", function(event) { 
                        var searchInput = document.querySelector('#search,form input[name=\"q\"]');
                        searchInput.addEventListener('input', function(event){
                            var q = event.target.value;
                            new Ajax.Request('/autocomplete/index/index', {
                                method: 'get',
                                parameters: {
                                    q: q
                                },
                                onSuccess: function(response) {
                                }
                            });
                        });
                    });
                }());
            //]]>
        </script>
        ";
        return $html;
    }
}
