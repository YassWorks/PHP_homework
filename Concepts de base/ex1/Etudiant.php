<?php

class Etudiant {
    private $nom;
    private $notes;

    public function __construct($nom, $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotes() {
        $html = '';
        $moyenne = (float)$this->calculerMoyenne();

        foreach ($this->notes as $note) {
            $bgColor = $note < 10 ? "danger" : ($note > 10 ? "success" : "warning");
            $html .= "<li class='list-group-item bg-$bgColor text-white'>$note</li>";
        }

        return $html;
        
    }

    public function calculerMoyenne() {
        return round(count($this->notes) ? array_sum($this->notes) / count($this->notes) : 0,2);
    }

    public function estAdmis() {
        return $this->calculerMoyenne() >= 10 ? "Admis" : "Non Admis";
    }

    public function afficherEtudiant() {
        echo "<ul class='list-group'>";
        echo "<li class='list-group-item active' aria-current='true'>$this->nom</li>";
        echo $this->afficherNotes();
        echo "<li class='list-group-item list-group-item-info'>" . $this->calculerMoyenne() . " - " . $this->estAdmis() . "</li>";
        echo "</ul>";

    }
}



?>
