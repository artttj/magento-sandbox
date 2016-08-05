<?php

class A2_Autocomplete_Block_Jsinit extends Mage_Core_Block_Text
{

    protected function _toHtml()
    {
        $html = '';
        $html .= 
            "<script type=\"text/javascript\">
            //<![CDATA[
                console.log(1);
            //]]>
        </script>
        ";
        return $html;
    }
}
