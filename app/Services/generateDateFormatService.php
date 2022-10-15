<?php

namespace services;

class generateDateFormatService
{
    public function format($date)
    {
        return date("l, jS F Y", strtotime($date));
    }
}
