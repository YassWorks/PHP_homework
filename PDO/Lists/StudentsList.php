<!DOCTYPE html>
<html lang="en">

<body>
    

<?php

include "../header.html";
require_once "../Classes/ConnectionDB.php";
require_once "../Classes/SessionManagerClass.php";
require_once "../Classes/UserClass.php";
require_once "../Classes/StudentClass.php";
require_once "../Classes/SectionClass.php";
require_once "../Classes/Repository.php";
require_once "../functions/Modal.php";

$sess = new SessionManager();
$SessionID = $sess->getValueByKey("SuccessfulLogin");
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    $(document).ready(function () {
        var table = $('#example').DataTable({
            responsive: true
        });
    });
</script>
<?php
if(isset($SessionID)){
    /*
    $userArray = $sess->getValueByKey("user");
    $user = User::fromArray($userArray);
    $userRepository = new Repository($user);
    $allUsers = $userRepository->findAll();
    */
    /*
    $pdo = ConnectionDB::getInstance();
    $Students = $pdo->query(
            "SELECT U.id, U.username, Stud.name, U.email, Stud.birthdate, S.designation, U.role
            FROM student Stud, user U, sections S 
            WHERE( (U.role='Student') 
                AND (Stud.section = S.id) 
                AND (Stud.id=U.id))
            "
        );
    $Students = $Students->fetchAll(PDO::FETCH_ASSOC);
    print_r($Students);
    */
    $Students = Student::fetchAll();

?>
<div class ='d-flex justify-content-center' style="width:100%">
    <table id="example" class="table table-striped">
        <thead>
            <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Username</th>
                <th scope='col'>name</th>
                <th scope='col'>Email</th>
                <th scope='col'>Birthday</th>
                <th scope='col'>Section</th>
                <th scope='col'>Role</th>
                <th scope='col'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Students as $Stud): ?>
                <tr>
                    <td><?= htmlspecialchars($Stud["id"]) ?></td>
                    <td><?= htmlspecialchars($Stud["username"]) ?></td>
                    <td><?= htmlspecialchars($Stud["name"]) ?></td>
                    <td><?= htmlspecialchars($Stud["email"]) ?></td>
                    <td><?= htmlspecialchars($Stud["birthdate"]) ?></td>
                    <td><?= htmlspecialchars($Stud["designation"]) ?></td>
                    <td><?= htmlspecialchars($Stud["role"]) ?></td>
                    <td>
                        <a href="?action=view&id=<?= urlencode($Stud['id']) ?>">
                            <img src="../assets/info-circle.svg" alt="info" style="color: blue; width:20px" />
                        </a>
                        <a href="#" data-toggle="modal" data-target="#deleteModal<?= $Stud['id'] ?>">
                            <img src="../assets/trash.svg" alt="delete" style="width:20px" />
                        </a>
                        <a href="?action=edit&id=<?= urlencode($Stud['id']) ?>">
                            <img src="../assets/pencil-square.svg" alt="edit" style="width:20px" />
                        </a>

                        <?php

                        echo ModalComponent(
                            '
                            <p>Are you sure you want to delete <strong>' . htmlspecialchars($Stud['name']) . '</strong>?</p>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a href="?action=delete&id=' . urlencode($Stud['id']) . '" class="btn btn-danger">Delete</a>
                            </div>
                            ',
                            'Delete Student',
                            'deleteModal' . $Stud['id'],
                            'deleteModalLabel' . $Stud['id']
                        );
                        ?>

                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
    if(isset($_GET['action']) && isset($_GET['id'])){
        $action = $_GET['action'];
        $id = $_GET['id'];
        if ($action == 'view') {
            $student = Student::findById($id);
            $body = '
                    <div class="d-flex flex-row justify-content-around">
                            <div class="d-flex">
            ';
            $body .= '
                                <img src="'.$student['imgUrl'].'" alt="'.$student['name'].'" class="img-thumbnail">
                            </div>
                ';
            $body .= '
                            <div class="d-flex">
                                <div class="d-flex flex-column justify-content-around">


            ';
            $body .= "<h3>Student Information</h3>";
            $body .= "<p><strong>ID:</strong> " . htmlspecialchars($student['id']) . "</p>";
            $body .= "<p><strong>Username:</strong> " . htmlspecialchars($student['username']) . "</p>";
            $body .= "<p><strong>Name:</strong> " . htmlspecialchars($student['name']) . "</p>";
            $body .= "<p><strong>Email:</strong> " . htmlspecialchars($student['email']) . "</p>";
            $body .= "<p><strong>Birthdate:</strong> " . htmlspecialchars($student['birthdate']) . "</p>";
            $body .= "<p><strong>Section:</strong> " . htmlspecialchars($student['designation']) . "</p>";
            $body .= "<p><strong>Role:</strong> " . htmlspecialchars($student['role']) . "</p>";

            $body .= '
                        </div>
                    </div>
                </div>
                    ';
            $body .= '
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            ';
            echo ModalComponent($body, 'Profile');

            ?>
            <script>
                window.onload = function () {
                    $('#exampleModal').modal('show');
                }
            </script>
            
            <?php
        } elseif ($action == 'delete') {
            Student::removeFromDB($id); 
            echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
            exit();
        } elseif ($action == 'edit') {
            $student = Student::findById($id);
            $sec = new Sections();
            $sectionRepo = new Repository($sec);
            $sections = $sectionRepo->findAll();
            $userSec = $sectionRepo->findById($student["sec"]);

            $body = '
    <form method="POST" action="'.$_SERVER['PHP_SELF'].'">
        <input type="hidden" name="action" value="submit_edit">
        <input type="hidden" name="id" value="'.htmlspecialchars($student['id']).'">

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="'.htmlspecialchars($student['name']).'" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="'.htmlspecialchars($student['email']).'" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="'.htmlspecialchars($student['username']).'" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Birthday</label>
            <input type="date" name="birthdate" value="'.htmlspecialchars($student['birthdate']).'" class="form-control" required>
        </div>
        <div class="form-group">
            <select class="form-select" name="section">
        ';
        foreach ($sections as $sect) {
            $selected = ($sect->id == $userSec->id) ? 'selected' : '';
            $designation = htmlspecialchars($sect->designation);
            $body .= "<option value=\"{$sect->id}\" {$selected}>{$designation}</option>";
        }
        
        $body .= '

            </select>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </form>';
            ?>
            
            <script>
                window.onload = function () {
                    $('#exampleModal').modal('show');
                }
            </script>

            <?php
            
        echo ModalComponent($body, 'Update Student', 'exampleModal','exampleModalLabel');

        }
    }

?>

<?php
}else{
    header("Location: index.php");
    exit();
}
?>
<?php
    if (isset($SessionID) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $id = htmlspecialchars(trim($_POST['id']));
        $username = htmlspecialchars(trim($_POST['username']));
        $name = htmlspecialchars(trim($_POST['name']));
        $birthdate = htmlspecialchars(trim($_POST['birthdate']));
        $section = htmlspecialchars(trim($_POST['section']));
    
    
    }
?>
</body>
</html>