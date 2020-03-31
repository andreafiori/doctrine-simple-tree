<?php

require_once('vendor/autoload.php');
require_once('bootstrap.php');

use Entity\Categories;
use Models\CategoryFinder;

$categoryFinder = new CategoryFinder($entityManager);
$arrayCategories = $categoryFinder->findArrayCategories();
$recursive_iterator = $categoryFinder->recoverRecursiveIterator( $categoryFinder->recoverRootCategories() );

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Doctrine 2 MySQL tree with a parent \ child structure">
    <meta name="keywords" content="php,doctrine,mysql,parent child,category">

    <title>Doctrine 2 MySQL tree with a parent \ child structure</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

<div class="container">

    <?php if (!empty($arrayCategories)): ?>
    <h2>Doctrine MySQL tree</h2>
    
    <p>A category tree structure with a parent\child relashionship is stored on a MySQL database.<br>
    Here is how a single and standalone Doctrine instance can recover all informations.</p>

    <h3>Categories in a Dropdown</h3>

    <form action="" class="form-inline">
        <div class="form-group">
            <select name="category" id="category" class="form-control mt-2 mb-2">
                <option value="">Select</option>
                <?php
                $options = '';
                foreach ($recursive_iterator as $index => $child_category):
                    $options .= '<option value="' . $child_category->getId() . '">';
                    $options .= str_repeat('&nbsp;&nbsp;', $recursive_iterator->getDepth()) . $child_category->getTitle();
                    $options .= '</option>';
                endforeach;
                
                echo $options;
                ?>
            </select>
        </div>
    </form>

    <h3>Category array</h3>

    <p>Using a <strong>CategoryRecursiveIterator entity</strong> and a PHP <a href="http://php.net/manual/en/class.recursiveiteratoriterator.php" target="_blank" title="RecursiveIteratorIterator guide on php.net [open page in another window]">RecursiveIteratorIterator</a>, I have built an array with the string of all categories and the related parent \ child relationship:</p>

    <pre><?php print_r($arrayCategories) ?></pre>

    <hr>

    <?php else: ?>
        <div class="alert alert-warning mt-4 mb-2">
            <h3 class="alert-heading">No data</h3>
            <p>No categories have been found on the database :(</p>
        </div>
    <?php endif ?>

    <footer>
        <p>&copy; <?php echo date("Y") ?> - <a href="http://www.andreafiori.net" target="_blank" rel="noopener noreferrer">Andrea Fiori</a>.</p>
    </footer>
</div>

</body>
</html>