<?php require_once('library/model.php');

$model = new \Capistrano\Blog\Model();

$users = $model->actionFetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staging</title>
</head>
<body>
<h1>Staging</h1>

<ul>
    <?php foreach ($users AS $user) : ?>

        <li><?php echo $user['name'] ?></li>

    <?php endforeach ?>

    <?php if (!count($users)): ?>

        <li>There are currently no users</li>
    <?php endif ?>
</ul>
</body>
</html>