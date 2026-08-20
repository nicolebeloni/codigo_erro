<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "crud_aula";

$conn = mysqli_connect($host, $user, $password, $database);

if ($conn->connect_error) {
    die("erro na conexão: " . $conn->connect_error);
}

if (isset($_POST['cadastrar'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("ss", $nome, $email);
    $stmt->execute();

    header("Location: index.php");
    exit;

}

   if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];

    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: index.php");
    exit;

   }

   if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nome, $email, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
   }

   $sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud de usuarios</title>
</head>

<body>
    <h1>cadastro de usuarios</h1>
    <form method="POST">
       <label>Nome:</label>
       <input type="text" name="nome" required>
       <br><br>
         <label>Email:</label>
         <input type="email" name="email" required>
         <br><br>
         <input type="submit" name="cadastrar" value="Cadastrar">
</button>

    </form>

    <h2>Lista de usuarios</h2>
    <table border="1">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>

    <?php while ($usuario = $resultado->fetch_assoc()) { ?>
        <tr>
            <td>
                <?php echo $usuario['id']; ?>
            </td>

            <td>
                <?php echo $usuario['nome']; ?>
            </td>
            <td>
                <?php echo $usuario['email']; ?>
            </td>

            <td>
                <a href="index.php?excluir=<?= $usuario ['id'] ?>">
             Excluir
                </a>

            </td>
        </tr>

    <?php } ?>
    </table>
</body>
</html>






?>