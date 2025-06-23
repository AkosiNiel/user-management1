<?php
// File: classes/Profile.php
require_once 'Database.php';

class Profile {
    public static function findByUserId($user_id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM profiles WHERE user_id = ? LIMIT 1");
        $stmt->execute([$user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($user_id, $data) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO profiles (user_id, firstname, lastname, middlename, address, company, contact_number, position) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $user_id,
            $data['firstname'],
            $data['lastname'],
            $data['middlename'],
            $data['address'],
            $data['company'],
            $data['contact_number'],
            $data['position']
        ]);
    }

    public static function update($user_id, $data) {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE profiles SET firstname = ?, lastname = ?, middlename = ?, address = ?, company = ?, contact_number = ?, position = ? WHERE user_id = ?");
        return $stmt->execute([
            $data['firstname'],
            $data['lastname'],
            $data['middlename'],
            $data['address'],
            $data['company'],
            $data['contact_number'],
            $data['position'],
            $user_id
        ]);
    }
}
