<?php 
    
if(isset($_GET['id'])) {
    $conn = mysqli_connect("localhost", "root", "", "bootsrap_page");
    if(!$conn) {
        header('Location: page_500.php');
    }
    $id = $_GET['id'];
    $sql = "DELETE FROM posts WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    header('Location: yourPosts.php');
    mysqli_close();
}
?>

