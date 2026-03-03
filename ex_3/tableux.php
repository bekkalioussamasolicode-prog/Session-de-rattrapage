<?php
$students = [

  ['nom' => 'Alami', 'prénom' => 'Ali', 'notes' => [12, 7, 14.5]],

  ['nom' => 'Serraj', 'prénom' => 'Sara', 'notes' => [10, 17, 12]],

  ['nom' => 'Kamili', 'prénom' => 'Ilham', 'notes' => [9, 15, 16.5]]

];
// function calcMoyen($n1, $n2, $n3)
// {
//   $sum = $n1 + $n2 + $n3;
//   return $sum / 3;
// };
function calcMoyen($notes)
{
  $sum = array_sum($notes);
  $avg = $sum / count($notes);
  return $avg;
}
$tab = "<table border='1'>
<tr>
<th>Nom</th>
<th>Prenom</th>
<th>Note 1</th>
<th>Note 2</th>
<th>Note 3</th>
<th>Moyen</th>
</tr>
";
foreach ($students as $student) {
  $n1 = $student['notes'][0];
  $n2 = $student['notes'][1];
  $n3 = $student['notes'][2];
  $Moyen = calcMoyen($student["notes"]);
  $tab .= "
  <tr>
  <td>{$student['nom']}</td>
  <td>{$student['prénom']}</td>
  <td>$n1</td>
  <td>$n2</td>
  <td>$n3</td>
  <td>$Moyen</td>
  </tr>
";
}
$tab .= "</table>";
echo $tab;
