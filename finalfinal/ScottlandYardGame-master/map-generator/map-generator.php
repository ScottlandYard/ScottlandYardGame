<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 3/27/2018
 * Time: 2:01 PM
 */


/*
 * 3d10-map-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$map = array();
$terrain = array ('plains', 'forest', 'swamp', 'hills', 'mountains', 'water');
for ($row = 0; $row < 20; $row++) {
    $map[] = array();
    for ($column = 0; $column < 20; $column++) {
        $pool = $terrain;
        if (isset($map[$row-1])) {
            if (isset($map[$row-1][$column-1])) {
                $pool[] = $map[$row-1][$column-1];
                $pool[] = $map[$row-1][$column-1];
            }
            $pool[] = $map[$row-1][$column];
            $pool[] = $map[$row-1][$column];
            if (isset($map[$row-1][$column+1])) {
                $pool[] = $map[$row-1][$column+1];
                $pool[] = $map[$row-1][$column+1];
            }
        }
        if (isset($map[$row][$column-1])) {
                $pool[] = $map[$row][$column-1];
                $pool[] = $map[$row][$column-1];
        }
        shuffle($pool);
        $map[$row][$column] = $pool[0];
    }
}

?>
<table cellspacing='0' cellpadding='0' border='0'>
<?php foreach ($map as $row) { ?>
<tr>
<?php foreach ($row as $tile) { ?>
<td><img src='tile_<?php echo $tile ?>.png' style='width:50px;height:50px' /></td>
<?php } ?>
</tr>
<?php } ?>
</table>
<?php

/*
 * 3d10-note-taker.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$data = file_get_contents('game_notes.txt');

if ($data) {
    list($masternotes, $counts) = unserialize($data);
} else {
    $masternotes = array();
    $counts = array();
}

$ignore_these_words = array('a','an','the','this','i','with','of','it','if','in');
$note = array('title' => '', 'body' => '');

if (!empty($_POST)) {
    $noteid = count($masternotes);
    $note = array('title' => htmlentities($_POST['title']), 'body' => htmlentities($_POST['body']));
    $masternotes[] = $note;
    $words = preg_split('/\s/', $note['body'] . ' ' . $note['title']);
    foreach ($words as $word) {
        $word = preg_replace('/[^0-9a-z]/', '', strtolower($word));
        if (!in_array($word, $ignore_these_words)) {
            if (isset($counts[$word])) {
                $counts[$word][$noteid] = $noteid;
            } else {
                $counts[$word] = array($noteid => $noteid);
            }
        }
    }
    file_put_contents('game_notes.txt', serialize(array($masternotes, $counts)));
} else if (!empty($_GET)) {
    $note = $masternotes[$_GET['id']];
}
?>
<form method='post'>
    <input name='title' /> <br /> <textarea name='body'></textarea> <br /> <input type='submit' value='save the note' />
</form>
<hr />
<table>
    <tr><td valign='top'>
            <table border='1'>
                <?php
                arsort($counts);
                foreach ($counts as $word => $notes) {
                    ?>
                    <tr><td valign='top'><?php echo $word ?></td><td>
                            <?php foreach ($notes as $id) { ?>
                                <a href='map-generator.php?id=<?php echo $id ?>'><?php echo $masternotes[$id]['title'] ?></a><br />
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </td><td valign='top'>
            Title :  <?php echo $note['title'] ?> <br />
            Note :  <?php echo $note['body'] ?> <br />
        </td></tr></table>