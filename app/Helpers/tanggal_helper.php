<?php
function format_tanggal($tanggal)
{
    $tanggal = date('d F Y', strtotime($tanggal));
    return $tanggal;
}
