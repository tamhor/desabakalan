<?php
function formatRp($angka){
    return "Rp " . number_format($angka,0,',','.');
}