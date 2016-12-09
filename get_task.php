<!DOCTYPE html>
<html>
<head>
<?php
$query = $this->todo_modal->get_all(); 

echo '</font></center> <br>';
echo '<table  border= "3" style = "width:60%" align="center" cellpadding= "10" cellspacing= "0">';
echo '<tr>';
echo '<th><font size = "4">Id</font></th>';
echo '<th><font size = "4">Title</font></th>';
echo '<th><font size = "4">Status</font></th>';
echo '<th><font size = "4">Creation Time</font></th>';

echo '</tr>';
foreach ($query->result_array() as $row)
{
  
  echo '<tr>';

  echo  '<td>';
  echo '<center>';
  echo $row['id'];
  echo "</center>";
  echo '</td>';
  
  echo  '<td>';
  echo '<center>';
  echo $row['title'];
  echo "</center>";
  echo '</td>';

  echo  '<td>';
  echo '<center>';
  echo $row['status'];
  echo "</center>";
  echo '</td>';

  echo  '<td>';
  echo '<center>';
  echo $row['curr_time'];
  echo "</center>";
  echo '</td>';

  echo '</tr>';
}
?>
</body>
</html>