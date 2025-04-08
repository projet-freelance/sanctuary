<?php

if (!function_exists('fakePrayerName')) {
    function fakePrayerName($userId) {
        $names = [
            'Anonyme en prière',
            'Frère en Christ',
            'Sœur en prière',
            'Serviteur de Dieu',
            'Cœur fidèle',
            'Ame en méditation',
            'Enfant de lumière',
            'Marcheur dans la foi',
            'Pèlerin en prière',
            'Témoin silencieux',
        ];

        return $names[$userId % count($names)];
    }
}
