<?php

try {
    $conn = mysqli_connect('localhost', 'root', '', 'box');
} catch (mysqli_sql_exception) {
    echo "not connected";
}
