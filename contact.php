<?php
require_once 'db.php';

class Contact {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createContact($user_id, $name, $phone_number, $email) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contacts (user_id, name, phone_number, email) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $name, $phone_number, $email]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function updateContact($id, $name, $phone_number, $email) {
        try {
            $stmt = $this->pdo->prepare("UPDATE contacts SET name = ?, phone_number = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $phone_number, $email, $id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteContact($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = ?");
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function getContacts($user_id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE user_id = ?");
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
