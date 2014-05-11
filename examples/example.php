<?php
include '../env.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 101 Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Bootstrap-3.0.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
            $Form = new \PHPStrap\Form\Form("#", "POST", \PHPStrap\Form\FormType::Normal);
            $Form->setWidths(2, 10); //Horizontal forms only
            $Form->hidden(array(
                array('name' => 'hidden1'),
                array('name' => 'hidden2')
            ));

            $Form->group($Form->label('User'), new \PHPStrap\Form\Text(array('id' => 'test', 'class' => 'sd')));
            $Form->group($Form->label('Pass'), new \PHPStrap\Form\Password(array('id' => 'hello')));
            $Form->group(
                $Form->checkbox("Checkbox text", true),
                $Form->checkbox("More Text", true)
            );
            $Form->group($Form->label('Textarea'), new \PHPStrap\Form\Textarea('', array('disabled' => true)));
            $Form->group($Form->label('Select'), new \PHPStrap\Form\Select(array('one' => 1, 'two' => 2, 'three' => 3), 'two', array('multiple' => true)));
            $Form->group($Form->label('Static Text'), new \PHPStrap\Form\StaticText('weee'));
            $Form->group($Form->label('File'), new \PHPStrap\Form\File(), "Help Text");

            echo $Form;
            ?>
        </div>
    </div>
</div>
</body>
</html>


