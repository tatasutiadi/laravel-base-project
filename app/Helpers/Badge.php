<?php

function getActiveMenu($segment, $values) {
    if (in_array(request()->segment($segment), $values)) {
        return 'nav-item-expanded nav-item-open';
    } else {
        return '';
    }    
}