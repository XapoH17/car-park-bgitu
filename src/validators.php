<?php
function validateRequired($data, $key) {
    if (!array_key_exists($key, $data) || trim($data[$key]) === '') {
        throw new Error($key . ' is required.');
    }
}